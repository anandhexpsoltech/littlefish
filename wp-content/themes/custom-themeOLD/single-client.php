<?php get_header(); ?>
	<?php if( get_field('client_id') ): ?>
		<?php
			global $current_custom_user;

			$clients = get_field('client_id');
		?>

		<?php if (!in_array_r($current_custom_user, $clients)) : ?>
			<script type="text/javascript">
				window.location = "<?php bloginfo('url'); ?>/login/";
			</script>
		<?php endif; ?>
	<?php endif; ?>

	<?php
		$curr_clientid = get_the_ID();
		$clientid = get_field('client_id_task',$curr_clientid);
		$last_selected_file = get_user_meta(get_current_user_id(),'last_selected_file',true);

		if($last_selected_file === false || $last_selected_file === null){
			$last_selected_file = '';
		}

		$currentuserid = get_current_user_id();
	?>

	<!-- Code to add color classes if any file required action [START] -->
	<?php
		$tab_4_class = '';
		$get_added_files =  $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$curr_clientid." AND `meta_key` LIKE 'legal_files_2_%_legal_name' ");

		$tf = 0;
		foreach($get_added_files as $added_file){
			if(is_super_admin($currentuserid)) { $tf++; continue; }
				$assigned_to = get_post_meta($curr_clientid,'legal_files_2_'.$tf.'_doc_uploaded_for',true);
				$due_date = get_post_meta($curr_clientid,'legal_files_2_'.$tf.'_due_date',true);
				$file_id = get_post_meta($curr_clientid,'legal_files_2_'.$tf.'_legal_file',true);
				$name = get_post_meta($curr_clientid,'legal_files_2_'.$tf.'_legal_name',true);
				$type = get_post_meta($curr_clientid,'legal_files_2_'.$tf.'_legal_type',true);
				$type = get_post_meta($curr_clientid,'legal_files_2_'.$tf.'_legal_type',true);
				$action_required = get_post_meta($curr_clientid,'legal_files_2_'.$tf.'_action_required',true);
				$url = wp_get_attachment_url($file_id);
				$fullsize_path = get_attached_file($file_id);

				$meta_id =  $wpdb->get_results("SELECT meta_id FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$curr_clientid." AND `meta_key` LIKE 'legal_files_2_".$tf."_doc_uploaded_for' ");

				if($action_required == 'Yes'){
					$exist_check = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uploaded_doc WHERE meta_id = ".$meta_id[0]->meta_id);
				} else {
					$exist_check = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uploaded_doc WHERE meta_id = ".$meta_id[0]->meta_id." AND user_id = ".$currentuserid);
				}
				if(!$exist_check){
					if(is_user_logged_in()){
						$currentuserid = get_current_user_id();
						if($action_required == 'Yes' && $assigned_to == $currentuserid){
							if($last_selected_file != $meta_id[0]->meta_id){
								if($last_selected_file !=''){
									$tab_4_class = 'tabpurple';
								} else {
									if($action_required == 'Yes'){
										$tab_4_class = 'tabpurple';
									}  else {
										$tab_4_class = 'tabblue';
									}
								}

							} else if($last_selected_file !=''){
								$tab_4_class = 'tabpurple';
							}
						} else if($assigned_to == $currentuserid || $assigned_to == ''){
							$tab_4_class = 'tabblue';
						}
						if($last_selected_file != ''){
							$tab_4_class = 'tabpurple';
						}
					}
				}
			$tf++;
		}
	?>

	<!-- Code to add color classes if any file required action [END] -->

	<div class="main-container overflow" data-user-id="<?php echo get_current_user_id(); ?>" data-post-id="<?php echo get_the_id(); ?>">
		<div class="wrapper">
			<?php if( get_field('toggle_form') ): ?>
				<?php $form_status = get_field('toggle_form'); ?>
			<?php endif; ?>

			<main role="main" class="<?php echo $form_status; ?>">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="title">
							<a href="<?php bloginfo('url'); ?>/my-projects/">
								<span></span>
							</a>

							<span>
								<?php the_title(); ?>
							</span>

							<?php if( get_field('custom_link') ): ?>
								<a class="planning" href="<?php the_field('custom_link'); ?>" target="_blank"></a>
							<?php endif; ?>

							<?php if( get_field('custom_link_2') ): ?>
								<a class="build" href="<?php the_field('custom_link_2'); ?>" target="_blank"></a>
							<?php endif; ?>
						</h1>

						<div class="project-status overflow">
							<div class="project-column first">
								<div class="project-title">
									<?php _e( 'Project Tracker', 'html5blank' ); ?>
								</div>

								<div class="project-address">
									<?php if( get_field('project_address') ): ?>
										<?php the_field('project_address'); ?><?php if( get_field('project_suburb') ): ?>, <?php the_field('project_suburb'); ?><?php endif; ?>
									<?php endif; ?>
								</div>
							</div>

							<?php if( get_field('status_prepurchase') ): ?>
								<?php
									$status = get_field_object('status_prepurchase');
									$value = $status['value'];
									$label = $status['choices'][$value];
								?>

								<div class="project-column">
									<div class="stage">
										<?php _e( 'Pre-Purchase', 'html5blank' );?>
									</div>

									<div class="status <?php echo $value; ?>">
										<?php echo $label; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if( get_field('status_settlement_period') ): ?>
								<?php
									$status = get_field_object('status_settlement_period');
									$value = $status['value'];
									$label = $status['choices'][$value];
								?>

								<div class="project-column">
									<div class="stage">
										<?php _e( 'Settlement', 'html5blank' ); ?>

										<span>
											<?php _e( 'Period', 'html5blank' );?>
										</span>
									</div>

									<div class="status <?php echo $value; ?>">
										<?php echo $label; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if( get_field('status_post_settlement') ): ?>
								<?php
									$status = get_field_object('status_post_settlement');
									$value = $status['value'];
									$label = $status['choices'][$value];
								?>

								<div class="project-column">
									<div class="stage">
										Post Set<span class="hide">tlement</span>
									</div>

									<div class="status <?php echo $value; ?>">
										<?php echo $label; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if( get_field('status_tp_demo') ): ?>
								<?php
									$status = get_field_object('status_tp_demo');
									$value = $status['value'];
									$label = $status['choices'][$value];
								?>

								<div class="project-column">
									<div class="stage">
										<?php _e( 'TP & Demo', 'html5blank' );?>
									</div>

									<div class="status <?php echo $value; ?>">
										<?php echo $label; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if( get_field('status_engineering') ): ?>
								<?php
									$status = get_field_object('status_engineering');
									$value = $status['value'];
									$label = $status['choices'][$value];
								?>

								<div class="project-column">
									<div class="stage">
										<?php _e( 'Engineering', 'html5blank' );?>
									</div>

									<div class="status <?php echo $value; ?>">
										<?php echo $label; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if( get_field('status_build') ): ?>
								<?php
									$status = get_field_object('status_build');
									$value = $status['value'];
									$label = $status['choices'][$value];
								?>

								<div class="project-column">
									<div class="stage">
										<?php _e( 'Build', 'html5blank' );?>
									</div>

									<div class="status <?php echo $value; ?>">
										<?php echo $label; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<div class="tabs tabs_default">
							<ul class="horizontal">
								<li>
									<a href="#tab-1">
										<span class="dash-icon"></span>

										<?php _e( 'Chat', 'html5blank' );?>
									</a>
								</li>

								<li>
									<a href="#tab-2">
										<span class="plans-icon"></span>

										<?php _e( 'Files', 'html5blank' );?>
									</a>
								</li>

								<li>
									<a href="#tab-3">
										<span class="money-icon"></span>

										<?php _e( 'Money', 'html5blank' );?>
									</a>
								</li>

								<li>
									<a href="#tab-6">
										<span class="gantt-icon"></span>

										<?php _e( 'Gantt', 'html5blank' );?>
									</a>
								</li>

								<li>
									<a href="#tab-4" class="<?php echo $tab_4_class; ?>">
										<span class="legal-icon"></span>

										<?php _e( 'Tasks', 'html5blank' );?>
									</a>
								</li>

								<li>
									<a href="#tab-5">
										<span class="admin-icon"></span>

										<?php _e( 'Score', 'html5blank' );?>
									</a>
								</li>
							</ul>

							<div id="tab-1" class="tab">
								<?php get_template_part('loop-comments-featured'); ?>

								<?php comments_template(); ?>
							</div>

							<div id="tab-2" class="tab active">
								<?php if( have_rows('plan_folders') || have_rows('plan_files_2') ): ?>
							        <ul class="plan-list container">
							            <?php while ( have_rows('plan_folders') ) : the_row(); ?>
							                <li class="list-title mix">
							                    <?php the_sub_field('plan_folders_name'); ?>
							                </li>

											<div class="sub">
												<?php while ( have_rows('plan_files') ) : the_row();?>
													<?php
														$name = get_sub_field('plan_name');
														$file = get_sub_field('plan_file');
														$type = get_sub_field('plan_type');
														$url = $file['url'];
													?>

													<li class="mix <?php echo strtolower($name); ?>">
														<?php if($type == 'pdf'): ?>
															<a href="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true" data-iframe="true" class="doc">
																<?php echo $name; ?>
															</a>
														<?php endif; ?>

														<?php if($type == 'image'): ?>
															<a class="doc" href="<?php echo $url; ?>">
																<?php echo $name; ?>
															</a>
														<?php endif; ?>

														<?php if($type == 'document'): ?>
															<a class="doc" data-iframe="true" href="<?php the_sub_field('plan_document_url'); ?>?embedded=true">
																<?php echo $name; ?>
															</a>
														<?php endif; ?>
													</li>
												<?php endwhile; ?>
											</div>
										<?php endwhile; ?>

										<?php while ( have_rows('plan_files_2') ) : the_row();?>
											<?php
												$name = get_sub_field('plan_name');
												$file = get_sub_field('plan_file');
												$type = get_sub_field('plan_type');
												$url = $file['url'];
											?>

											<li class="mix <?php echo strtolower($name); ?>">
												<?php if($type == 'pdf'): ?>
													<a href="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true" data-iframe="true" class="doc">
														<?php echo $name; ?>
													</a>
												<?php endif; ?>

												<?php if($type == 'image'): ?>
													<a class="doc" href="<?php echo $url; ?>">
														<?php echo $name; ?>
													</a>
												<?php endif; ?>

												<?php if($type == 'document'): ?>
													<a class="doc" data-iframe="true" href="<?php the_sub_field('plan_document_url'); ?>?embedded=true">
														<?php echo $name; ?>
													</a>
												<?php endif; ?>
											</li>
										<?php endwhile; ?>
									</ul>
								<?php else : ?>
									<div class="no-plans">
										<?php _e( 'There are no files uploaded.', 'html5blank' ); ?>
									</div>
								<?php endif; ?>
							</div>

							<div id="tab-3" class="tab">
								<?php if( have_rows('money_folders') || have_rows('money_files_2') ): ?>
							        <ul class="plan-list container">
							            <?php while ( have_rows('money_folders') ) : the_row(); ?>
							                <li class="list-title mix">
							                    <?php the_sub_field('money_folders_name'); ?>
							                </li>

											<div class="sub">
												<?php while ( have_rows('money_files') ) : the_row();?>
													<?php
														$name = get_sub_field('money_name');
														$file = get_sub_field('money_file');
														$type = get_sub_field('money_type');
														$url = $file['url'];
													?>

													<li class="mix <?php echo strtolower($name); ?>">
														<?php if($type == 'pdf'): ?>
															<a href="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true" data-iframe="true" class="doc">
																<?php echo $name; ?>
															</a>
														<?php endif; ?>

														<?php if($type == 'image'): ?>
															<a class="doc" href="<?php echo $url; ?>">
																<?php echo $name; ?>
															</a>
														<?php endif; ?>

														<?php if($type == 'document'): ?>
															<a class="doc" data-iframe="true" href="<?php the_sub_field('money_document_url'); ?>?embedded=true">
																<?php echo $name; ?>
															</a>
														<?php endif; ?>
													</li>
												<?php endwhile; ?>
											</div>
										<?php endwhile; ?>

										<?php while ( have_rows('money_files_2') ) : the_row();?>
											<?php
												$name = get_sub_field('money_name');
												$file = get_sub_field('money_file');
												$type = get_sub_field('money_type');
												$url = $file['url'];
											?>

											<li class="mix <?php echo strtolower($name); ?>">
												<?php if($type == 'pdf'): ?>
													<a href="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true" data-iframe="true" class="doc">
														<?php echo $name; ?>
													</a>
												<?php endif; ?>

												<?php if($type == 'image'): ?>
													<a class="doc" href="<?php echo $url; ?>">
														<?php echo $name; ?>
													</a>
												<?php endif; ?>

												<?php if($type == 'document'): ?>
													<a class="doc" data-iframe="true" href="<?php the_sub_field('money_document_url'); ?>?embedded=true">
														<?php echo $name; ?>
													</a>
												<?php endif; ?>
											</li>
										<?php endwhile; ?>
									</ul>
								<?php endif; ?>

								<?php if(get_field('google_document')): ?>
									<iframe style="height: <?php the_field('google_document_height'); ?>px;" src="<?php the_field('google_document'); ?>?widget=true&headers=false"></iframe>
								<?php endif; ?>
							</div>

							<div id="tab-6" class="tab">
								<?php if(get_field('gantt_document')): ?>
									<div>
										<iframe style="height: <?php the_field('gantt_document_height'); ?>px;" src="<?php the_field('gantt_document'); ?>"></iframe>

										<a class="hide" href='http://teamgantt.com' target='_blank'>Online Gantt Chart</a>
									</div>
								<?php endif; ?>
							</div>

							<div id="tab-4" class="tab">
								<?php
									$dropzoneclass = 'greydrop';

									if($last_selected_file != ''){
										$dropzoneclass = 'purpleForm';
								} ?>

								<div class="taskSubSection">
									<div class="leftUpload">
										<div class="uploadDragnDrop <?php echo $dropzoneclass; ?>">
											<form action="<?php echo site_url();?>/file_upload.php" method="post" class="dropzone dz-clickable">
												<input name="meta_id" id="meta_id" value="<?php echo $last_selected_file; ?>" type="hidden">
												<input name="user_id" value="<?php echo get_current_user_id(); ?>" type="hidden">
												<input name="post_id" value="<?php echo $curr_clientid; ?>" type="hidden">
												<div class="dz-default dz-message">
													<div class="dzMidleCont">
														<?php if($last_selected_file == ''){ ?>
															<i class="dropIcon"></i>
															<span>Drop files here to upload</span>
														<?php } else { ?>
															<i class="dropIcon"></i>
															<p class="coloredText"><strong>Important:</strong> Please only upload this file; </p>
															<?php $filename = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `meta_id` = $last_selected_file");
															$metaKey = str_replace("legal_files_2_","",(str_replace("_doc_uploaded_for","",$filename[0]->meta_key)));
															$fileID = get_post_meta($filename[0]->post_id,'legal_files_2_'.$metaKey.'_legal_file',true);
															//~ echo "<pre>"; print_r($filename); echo "</pre>";
															$filename_url = wp_get_attachment_url($fileID);
															$filename_type = wp_check_filetype( $filename_url );

															?>
															<p class="coloredText"><?php echo get_the_title($fileID).'.'.$filename_type['ext']; ?></p>
															<p>* All other files can be uploaded after you have uploaded the requested file.</p>
														<?php } ?>
													</div>
												</div>
											</form>
										</div>

										<?php if( have_rows('legal_files_2')): ?>
											<ul class="taskDownloadList">
												<?php /*************Code to fetch legal files [START]*************/
												$get_added_files =  $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$curr_clientid." AND `meta_key` LIKE 'legal_files_2_%_legal_name' ");
												$assigned_doc = '';
												$f = 0;
												foreach($get_added_files as $added_file){
													if(is_super_admin($currentuserid)) { $f++; continue; }

													$meta_id =  $wpdb->get_results("SELECT meta_id FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$curr_clientid." AND `meta_key` LIKE 'legal_files_2_".$f."_doc_uploaded_for' ");
													if($last_selected_file == $meta_id[0]->meta_id){ $f++; continue; }

													$assigned_to = get_post_meta($curr_clientid,'legal_files_2_'.$f.'_doc_uploaded_for',true);
													$due_date = get_post_meta($curr_clientid,'legal_files_2_'.$f.'_due_date',true);
													$file_id = get_post_meta($curr_clientid,'legal_files_2_'.$f.'_legal_file',true);
													$name = get_post_meta($curr_clientid,'legal_files_2_'.$f.'_legal_name',true);
													$type = get_post_meta($curr_clientid,'legal_files_2_'.$f.'_legal_type',true);
													$action_required = get_post_meta($curr_clientid,'legal_files_2_'.$f.'_action_required',true);

													$fullsize_path = get_attached_file($file_id);

													$url = wp_get_attachment_url($file_id);
													$filetype = wp_check_filetype( $url );
													$fileName = get_the_title($file_id).'.'.$filetype['ext'];


													if($type == 'document'){
														$ft = 'doc_file';
													}else{
														$ft = 'pdf_file';
													}
													if($action_required == 'Yes'){
														$exist_check = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uploaded_doc WHERE meta_id = ".$meta_id[0]->meta_id);
													} else {
														$exist_check = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uploaded_doc WHERE meta_id = ".$meta_id[0]->meta_id." AND user_id = ".$currentuserid);
													}
													//~ echo "<pre>"; print_r($exist_check); echo "</pre>";
													if(!$exist_check){
														//~ echo $f;

														if($last_selected_file != $meta_id[0]->meta_id){

															if($action_required == 'Yes'){
																if($assigned_to == $currentuserid){
																	$liclass="purpuleDownList";
																} else {
																	$f++; continue;
																}
															} else {
																$liclass="BlueDownList noaction ";
															}

															if($action_required == 'Yes' && $assigned_to == $currentuserid){
																$assigned_doc .= "<li  class='$liclass ".strtolower($name)."' metaid='".$meta_id[0]->meta_id."' postId='".$curr_clientid."'>";
																	$manualSign = 'manualSign';

																	$assigned_doc .= "<a href='$url' class='taskURL $manualSign' download meta-data='".$meta_id[0]->meta_id."' file-name='$fileName' meta-post-id='$curr_clientid' meta-user-id='".get_current_user_id()."' type='application/octet-stream'>
																		<i  class='TaskIcons downloadActionBtn' download title='Download'></i>
																		<span>$name</span>
																	</a>";
																$assigned_doc .= " </li>";
															} else if($assigned_to == $currentuserid || $assigned_to == ''){
																$assigned_doc .= "<li  class='$liclass ".strtolower($name)." meta".$meta_id[0]->meta_id."' metaid='".$meta_id[0]->meta_id."' postId='".$curr_clientid."' onclick='alertFunction(".$meta_id[0]->meta_id.");'>";
																	$manualSign = 'manualSign';

																	$assigned_doc .= "<a href='$url' class='taskURL $manualSign' download meta-data='".$meta_id[0]->meta_id."' file-name='$fileName' meta-post-id='$curr_clientid' meta-user-id='".get_current_user_id()."' type='application/octet-stream'>";
																		$assigned_doc .= "<i  class='TaskIcons downloadActionBtn' download title='Download'></i>
																		<span>$name</span>
																	</a>";
																$assigned_doc .= " </li>";
															}
														}
													}
													$f++;
												}
												if($assigned_doc != ''){
													echo $assigned_doc;
												} else { ?>
													<li class="GreyDownList noDownloads 555"><a href="javascript:void(0);" class='taskURL'><i class="TaskIcons downloadActionBtn announceIcon"></i><span>You're awesome, you have no task to complete</span></a></li>
												<?php }
											/*************Code to fetch legal files [END]*************/ ?>
											</ul>
										<?php else : ?>
											<ul class="taskDownloadList">
												<li class="GreyDownList noDownloads"><a href="javascript:void(0);" class='taskURL'><i class="TaskIcons downloadActionBtn announceIcon"></i><span>You're awesome, you have no task to complete</span></a></li>
											</ul>
										<?php endif; ?>
									</div>

									<div class="rightDownload">
										<ul class="taskDownloadList">
											<?php
											$uploaded_doc = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uploaded_doc WHERE post_id = $curr_clientid AND status = 1 ORDER BY `id` DESC");
											if(!empty($uploaded_doc)){
												foreach($uploaded_doc as $doc){
													$file_id = $doc->file_id;
													$url = wp_get_attachment_url($file_id);
													 $filetype = wp_check_filetype( $url ); ?>
													<li  class='GreyDownList withfile '>
														<a href='<?php echo wp_get_attachment_url( $file_id ); ?>'  class='taskURL' download><i  class='TaskIcons downloadActionBtn' download title='Download'></i><span><?php echo $doc->file_name; ?></span></a>
													</li>
												<?php }
											} else { ?>
												<li class="GreyDownList noDownloads"><a href="javascript:void(0);" class='taskURL'><i class="TaskIcons downloadActionBtn announceIcon"></i><span>You currently have no files uploaded.</span></a></li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>

							<div id="tab-5" class="tab">
								<div class="score-wrap">
									<div class="float-right">
										<?php if(get_field('admin_timer')): ?>
											<div class="soon" data-scale-max="l" data-layout="group label-below" data-format="M,d,h,m,s" data-face="" data-due="<?php the_field('admin_timer'); ?>"></div>
										<?php endif; ?>
									</div>

									<div class="float-left">
										<?php if( have_rows('admin_scoreboard') ): ?>
											<div class="scoreboard">
												<div class="row top">
													<div class="cell blue">
														&nbsp;
													</div>

													<div class="cell grey">
														<?php _e( 'Original', 'html5blank' ); ?>
													</div>

													<div class="cell">
														<?php _e( 'Current', 'html5blank' ); ?>
													</div>

													<div class="cell">
														<?php _e( 'Variation', 'html5blank' ); ?>
													</div>
												</div>

												<?php while( have_rows('admin_scoreboard') ): the_row(); ?>
													<div class="row">
														<div class="cell blue">
															<?php the_sub_field('admin_scoreboard_label'); ?>
														</div>

														<div class="cell grey">
															<?php the_sub_field('admin_scoreboard_original'); ?>
														</div>

														<div class="cell">
															<?php the_sub_field('admin_scoreboard_current'); ?>
														</div>

														<div class="cell variation<?php if(get_sub_field('admin_scoreboard_comment')): ?> hover<?php endif; ?>" style="color: <?php the_sub_field('admin_scoreboard_variation_color'); ?>">
															<?php the_sub_field('admin_scoreboard_variation'); ?>

															<?php if(get_sub_field('admin_scoreboard_comment')): ?>
																<div class="tooltip">
																	<span>
																		<div class="content">
																			<?php the_sub_field('admin_scoreboard_comment'); ?>
																		</div>
																	</span>
																</div>
															<?php endif; ?>
														</div>
													</div>

													<div class="clear"></div>
												<?php endwhile; ?>
											</div>
										<?php endif; ?>
									</div>
								</div>

								<div class="clear"></div>
							</div>
						</div>

						<div class="custom-search overflow controls">
							<form>
								<input class="input" data-ref="search-input" type="text" placeholder="Search..."/>
							</form>
						</div>
					</div>
				<?php endwhile; ?>

				<?php endif; ?>
			</main>
		</div>
	</div>
<?php get_footer(); ?>
