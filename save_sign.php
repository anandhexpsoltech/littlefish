<?php use setasign\Fpdi\Fpdi;
	$baseroot = $_SERVER['DOCUMENT_ROOT'].'/littlefishproperties';
	require($baseroot.'/wp-load.php');
	require($baseroot.'/fpdf181/fpdf.php');
	require($baseroot.'/fpdi/src/autoload.php');
	global $wpdb;

	$result = array();
	$imagedata = base64_decode($_POST['img_data']);
	$filepath = $_POST['filepath'];
	if($filepath != ''){
		chmod($filepath, 0777);
		$pos = strpos($filepath, '/');
		if ($pos !== false) {
			$filepatharr = explode("/",$filepath);
			$pdfname = $filepatharr[count($filepatharr) - 1];
		}
	}

	$filename = md5(date("dmYhisA"));
	//Location to where you want to created sign image
	$file_name = 'docsign/'.$filename.'.png';
	file_put_contents($file_name,$imagedata);
	$result['status'] = 1;
	$result['file_name'] = $file_name;
	$file_name_full = $baseroot.'/docsign/'.$filename.'.png';

	// initiate FPDI
	$pdf = new Fpdi();
	// add a page
	$pdf->AddPage();// set the sourcefile
	$pdf->setSourceFile($filepath);

	$template = $pdf->importPage(1);
	$pdf->useTemplate($template);
	$pdf->Image($file_name_full, 150, 250, 60, 20);

	$wp_upload_dir = wp_upload_dir();
	//~ $newfilename = round(microtime(true)) . '.' . end($temp);
	//~ $uploaded_file_path = $wp_upload_dir['path'].$newfilename;


	chmod($wp_upload_dir['path'], 0777);
	$ext = explode('.',$pdfname);
	//~ $pdf_name = rand().'.'.$ext['1'];
	$pdf_name = $ext['0'].'_done.'.$ext['1'];
	$newfile = $wp_upload_dir['path'].'/'.$pdf_name;
	$pdf->Output($newfile,'F');

	$uploaded_file_url = $wp_upload_dir['url'].$pdf_name;

	$fileType = $_POST['fileType'];
	$user_id = $_POST['userId'];
	$post_id = $_POST['post_id'];
	$meta_id = $_POST['metaId'];
	$type = explode('/',$fileType);
	$attachment = array(
		'guid' => $uploaded_file_url,
		'post_mime_type' => $fileType,
		'post_title' => preg_replace( '/\.[^.]+$/', '', $pdf_name ),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	$attach_id = '';
	$attach_id = wp_insert_attachment( $attachment, $newfile );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $newfile );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	//echo $attach_id;

	$sign_image_url = get_site_url().'docsign/'.$filename.'.png';



	//~ echo json_encode($result);
	$insertQuery = $wpdb->insert($wpdb->prefix.'uploaded_doc', array(
		'user_id' => $user_id,
		'post_id' => $post_id,
		'meta_id' => $meta_id,
		'file_name' => $pdf_name,
		'file_type' => $type['1'],
		'file_id' => $attach_id,
		'upload_date' => date("Y-m-d H:i:s"),
		'status' => 1,
	));

	if($insertQuery){

		$blogusers = get_users('role=Administrator');
		//print_r($blogusers);
		foreach ($blogusers as $user) {
			$admin_email = $user->user_email;
		}
		$user_info = get_user_by( 'email', $admin_email );
		//~ $user_info = get_userdata($user_id);
		$header = "MIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=utf-8\n";
		$header .= "From: Little Fish <no-reply@littlefishproperties.com.au>";

		$newMessage = 'A new document(s) has been uploaded to the '.get_the_title($post_id).' project. ';
		$message = "Hi ".$user_info->first_name.",<br><br>
		$newMessage<br><br>
		<a href='".get_the_permalink($post_id)."#document-uploaded' target='_blank'>".get_the_permalink($post_id)."#document-uploaded</a><br><br>
		-<br>
		Regards,<br>
		Team Little Fish";

		/*<br><img src='".get_field('website_logo', 'option')."' width='150'>*/
		$subject = '[File Uploaded] ' . get_the_title($post_id);
		//~ $to = $user_info->data->user_email;
		$to = $admin_email;
		// send the email
		wp_mail($to, $subject, $message, $header);

		echo $wpdb->insert_id;
	} else {
		wp_delete_attachment( $attach_id );
		echo "0";
	}
	die();
?>
