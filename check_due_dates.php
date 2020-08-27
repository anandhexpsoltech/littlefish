<?php
include_once("wp-load.php");
include_once("wp-config.php");
global $wpdb;

/* Code to check due date of file [START] */
$get_added_files =  $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `meta_key` LIKE 'legal_files_2_%_legal_name' GROUP BY post_id");
$last_ids = get_option('reminder_notn_sent_to');


foreach($get_added_files as $added_file){
	$get_added_files_due_date =  $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$added_file->post_id." AND `meta_key` LIKE 'legal_files_2_%_due_date' ORDER BY meta_id ");
	$f = 0;
	foreach($get_added_files_due_date as $due_date_file){
		if($due_date_file->meta_value != ''){

			$time = strtotime($due_date_file->meta_value);
			$duedate = date('Y-m-d H:i:s',$time);
			$ndate = date('Y-m-d H:i:s');

			if(get_post_meta($due_date_file->post_id,'legal_files_2_'.$f.'_action_required',true) == 'Yes'){
				if((strtotime($duedate) - strtotime($ndate)) <= 43200 && (strtotime($duedate) - strtotime($ndate)) >= 0){

					$get_assigned_user =  $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$due_date_file->post_id." AND `meta_key` LIKE 'legal_files_2_".$f."_doc_uploaded_for' ");

					$check_filled = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."uploaded_doc` WHERE `post_id` = ".$due_date_file->post_id." AND `meta_id` = ".$due_date_file->meta_id." AND user_id = ".$get_assigned_user[0]->meta_value);

					if(empty($check_filled)){

						$last_ids = array();
						$last_ids = get_option('reminder_notn_sent_to');

						if(!in_array($get_assigned_user[0]->meta_id, $last_ids)){

							$user_info = get_userdata($get_assigned_user[0]->meta_value);

							$header = "MIME-Version: 1.0\n";
							$header .= "Content-Type: text/html; charset=utf-8\n";
							$name = get_user_meta($user_info->ID,'first_name',true);
							$duedate = date('d-m-Y',strtotime($duedate));

							$Message = "
							Hi $name,<br><br>
								This is just a friendly reminder that you still have an action that needs to be completed by $duedate.<br><br>
								If you could please complete the action at your earliest convenience that would be greatly appreciated.<br><br>
								<a href='".get_the_permalink($added_file->post_id)."#action-required'>".get_the_permalink($added_file->post_id)."#action-required</a><br><br>
								-<br>
								Regards,<br>
								Team Little Fish
							";

							$subject = '[Urgent Action Required]' . get_the_title($due_date_file->post_id);
							$to = $user_info->data->user_email;

							// send the email
							wp_mail($to, $subject, $Message, $header);

							// Admin due date reminder email [START]
							$blogusers = get_users('role=Administrator');
							foreach ($blogusers as $admminuser) {
								$admin_email = $admminuser->user_email;
								$adminname = get_user_meta($admminuser->ID,'first_name',true);
							}

							//Adding last name in name of user to send in email body.
							if(get_user_meta($user_info->ID,'last_name',true)){
								$name .= ' '.get_user_meta($user_info->ID,'last_name',true);
							}

							$subject_admin = '[Non Action Reminder]' . get_the_title($due_date_file->post_id);
							$Message_admin = "
							Hi $adminname,<br><br>
								This is just a friendly reminder to let you know $name has not completed the requested action which is due $duedate.<br><br>
								<a href='".get_the_permalink($added_file->post_id)."#action-required'>".get_the_permalink($added_file->post_id)."#action-required</a><br><br>
								-<br>
								Regards,<br>
								Team Little Fish
							";

							$mailsent = wp_mail($admin_email, $subject_admin, $Message_admin, $header);

							// Admin due date reminder email [END]
							echo "Mail Sent";

						}

						$mail_sent_ids = array();
						if($last_ids === false || $last_ids === null || $last_ids == ''){
							$mail_sent_ids[] = $get_assigned_user[0]->meta_id;
						} else {
							foreach($last_ids as $key=>$value){
								if($value != $get_assigned_user[0]->meta_id){
									$mail_sent_ids[] = $value;
								}
							}
							//~ $mail_sent_ids[] = $due_date_file->meta_id;
							$mail_sent_ids[] = $get_assigned_user[0]->meta_id;
						}
						update_option('reminder_notn_sent_to',$mail_sent_ids);
					}
				}
			}
		}
		$f++;
	}
}
/* Code to check due date of file [END] */
?>
