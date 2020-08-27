<?php
include_once("wp-load.php");
include_once("wp_config.php");
global $wpdb;
if(!empty($_FILES)){

	$user_id = $_POST['user_id'];
	$post_id = $_POST['post_id'];
	$meta_id = $_POST['meta_id'];

	$exist_check = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uploaded_doc WHERE meta_id = $meta_id");
	//~ if(empty($exist_check)){
		//~ print_r($_POST);
		$file_meta = $_FILES['file'];
		unset($file_meta['tmp_name']);
		unset($file_meta['error']);

		//~ echo $fileName = $_FILES['file']['name'];

		$temp = explode(".", $_FILES["file"]["name"]);
		$type = explode("/", $_FILES["file"]["type"]);


		$wp_upload_dir = wp_upload_dir();

		//~ $newfilename = round(microtime(true)) . '.' . end($temp);
		if($meta_id == ''){
			$newfilename = $temp[0] . '.' . end($temp);
		} else {
			$newfilename = $temp[0] . '_done.' . end($temp);
		}

		$uploaded_file_path = $wp_upload_dir['path'].'/'.$newfilename;
		$uploaded_file_url = $wp_upload_dir['url'].$newfilename;
		if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file_path)){

			$attachment = array(
				'guid' => $uploaded_file_url,
				'post_mime_type' => $_FILES["file"]["type"],
				'post_title' => preg_replace( '/\.[^.]+$/', '', $newfilename ),
				'post_content' => '',
				'post_status' => 'inherit'
			);

			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			$attach_id = '';
			$attach_id = wp_insert_attachment( $attachment, $uploaded_file_path );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_file_path );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			$insertQuery = $wpdb->insert($wpdb->prefix.'uploaded_doc', array(
				'user_id' => $user_id,
				'post_id' => $post_id,
				'meta_id' => $meta_id,
				'file_name' => $newfilename,
				'file_type' => $type['1'],
				'file_id' => $attach_id,
				'upload_date' => date("Y-m-d H:i:s"),
				'status' => 1,

			));
			if($insertQuery){
				update_user_meta($user_id,'last_selected_file','');
				$blogusers = get_users('role=Administrator');

				foreach ($blogusers as $user) {
					$admin_email = $user->user_email;
					$admin_ID = $user->ID;
				}

				$user_info = get_user_by( 'email', $admin_email );
				$header = "MIME-Version: 1.0\n";
				$header .= "Content-Type: text/html; charset=utf-8\n";
				$header .= "From: Little Fish <no-reply@littlefishproperties.com.au>";

				$message = "Hi ".$user_info->first_name.",<br><br>";
				if($meta_id == ''){
					$message .= "A new file has been uploaded to <a href='' style='text-decoration:none;color: #222222;'>".get_the_title($post_id)."</a>, click the link below to view and download the file.<br><br>
					<a href='".get_the_permalink($post_id)."#file-uploaded' target='_blank'>".get_the_permalink($post_id)."#file-uploaded</a><br><br>";
					$subject = '[File Uploaded] ' . get_the_title($post_id);
				} else {
					$user_name = "";
					$user_name = get_user_meta($user_id,'first_name',true);
					if(get_user_meta($user_id,'last_name',true)){
						$user_name .= ' '.get_user_meta($user_id,'last_name',true);
					}

					$message .= "The action you requested  $user_name to completed for <a href='' style='text-decoration:none;color: #222222;'>".get_the_title($post_id)."</a> has been done and uploaded as requested.<br><br>
					<a href='".get_the_permalink($post_id)."#request-completed' target='_blank'>".get_the_permalink($post_id)."#request-completed</a><br><br>";
					$subject = '[Action Completed] ' . get_the_title($post_id);
				}
				$message .= "-<br>
					Regards,<br>
					Team Little Fish";
				$to = $admin_email;

				if($user_id != $admin_ID){
					// send the email
					wp_mail($to, $subject, $message, $header);
				}

				/* Mails to all subscriber [START] */
				//~ $subscribed_users = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = $post_id AND `meta_key` LIKE 'legal_files_2_%_doc_uploaded_for' GROUP BY meta_value ");
				$subscribed_users = get_post_meta($post_id,'client_id',true);
				foreach($subscribed_users as $subscriber){
					//~ $subscriber_info = get_user_by( 'ID', $subscriber->meta_value );
					$subscriber_info = get_user_by( 'ID', $subscriber);
					$name = get_user_meta($subscriber,'first_name',true);
					$message = "Hi $name,<br><br>
					A new file has been uploaded to <a href='' style='text-decoration:none;color: #222222;'>".get_the_title($post_id)."</a>, click the link below to view and download the file.<br><br>
					<a href='".get_the_permalink($post_id)."#file-uploaded' target='_blank'>".get_the_permalink($post_id)."#file-uploaded</a><br>
					-<br>Regards,<br>
					Team Little Fish";
					$subject = '[File Uploaded] ' . get_the_title($post_id);
					$to_mail = $subscriber_info->user_email;

					if($meta_id == ''){
						if($user_id != $subscriber_info->ID && $subscriber_info->ID != $admin_ID){
							wp_mail($to_mail, $subject, $message, $header);
						}
					}

				}

				/* Mails to all subscriber [END] */

				echo $wpdb->insert_id;
			} else {
				echo "0";
			}
			die();
		} else {
			echo "Error in image uploading";
			 die();
		}
	//~ }
}
