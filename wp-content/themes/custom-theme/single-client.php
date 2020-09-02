<?php get_header();
unset($_SESSION['datas']);
function searchForName($name, $array)
{
    foreach ($array as $key => $val) {
        if ($val['name'] === $name) {
            return $val;
        }
    }
    return false;
}
?>
<?php if (get_field('client_id')): ?>
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
$clientid = get_field('client_id_task', $curr_clientid);
$last_selected_file = get_user_meta(get_current_user_id(), 'last_selected_file', true);
if ($last_selected_file === false || $last_selected_file === null) {
    $last_selected_file = '';
}
$currentuserid = get_current_user_id();
?>
<!-- Code to add color classes if any file required action [START] -->
<?php
global $wpdb;
$tab_4_class = '';
$get_added_files = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "postmeta` WHERE `post_id` = " . $curr_clientid . " AND `meta_key` LIKE 'legal_files_2_%_legal_name' ");
$tf = 0;

$current_title = esc_html(get_the_title());

$sql = "SELECT 
lineitem.ItemCode,
lineitem.Description, 
lineitem.LineAmount, 
lineitem.TaxAmount,
exp.Date,
con.name,
month(exp.Date) as date_month,
year(exp.Date) as date_year
FROM xero_expense_lineitem AS lineitem
LEFT JOIN xero_expense_item_tracking as item_track ON lineitem.LineItemID = item_track.LineItemID  
LEFT JOIN xero_expense as exp ON lineitem.BankTransactionID = exp.BankTransactionID  
LEFT JOIN xero_contact as con ON con.ContactID = exp.ContactID   
WHERE item_track.Option = '" . $current_title . "'
order by exp.Date desc";
$money_query = $wpdb->get_results($sql);

$templateData = array();

foreach ($money_query as $money_key => $money_value) {
    $templateData[$money_value->date_year][$money_value->date_month][] = $money_value;
}

//var_dump($templateData);

foreach ($get_added_files as $added_file) {
    if (is_super_admin($currentuserid)) {
        $tf++;
        continue;
    }
    $assigned_to = get_post_meta($curr_clientid, 'legal_files_2_' . $tf . '_doc_uploaded_for', true);
    $due_date = get_post_meta($curr_clientid, 'legal_files_2_' . $tf . '_due_date', true);
    $file_id = get_post_meta($curr_clientid, 'legal_files_2_' . $tf . '_legal_file', true);
    $name = get_post_meta($curr_clientid, 'legal_files_2_' . $tf . '_legal_name', true);
    $type = get_post_meta($curr_clientid, 'legal_files_2_' . $tf . '_legal_type', true);
    $type = get_post_meta($curr_clientid, 'legal_files_2_' . $tf . '_legal_type', true);
    $action_required = get_post_meta($curr_clientid, 'legal_files_2_' . $tf . '_action_required', true);

    $url = wp_get_attachment_url($file_id);
    $fullsize_path = get_attached_file($file_id);

    $meta_id = $wpdb->get_results("SELECT meta_id FROM `" . $wpdb->prefix . "postmeta` WHERE `post_id` = " . $curr_clientid . " AND `meta_key` LIKE 'legal_files_2_" . $tf . "_doc_uploaded_for' ");
    if ($action_required == 'Yes') {
        $exist_check = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "uploaded_doc WHERE meta_id = " . $meta_id[0]->meta_id);
    } else {
        $exist_check = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "uploaded_doc WHERE meta_id = " . $meta_id[0]->meta_id . " AND user_id = " . $currentuserid);
    }
    if (!$exist_check) {
        if (is_user_logged_in()) {

            $currentuserid = get_current_user_id();

            if ($action_required == 'Yes' && $assigned_to == $currentuserid) {

                if ($last_selected_file != $meta_id[0]->meta_id) {

                    if ($last_selected_file != '') {

                        $tab_4_class = 'tabpurple';

                    } else {

                        if ($action_required == 'Yes') {

                            $tab_4_class = 'tabpurple';

                        } else {

                            $tab_4_class = 'tabblue';

                        }

                    }


                } else if ($last_selected_file != '') {

                    $tab_4_class = 'tabpurple';

                }

            } else if ($assigned_to == $currentuserid || $assigned_to == '') {

                $tab_4_class = 'tabblue';

            }

            if ($last_selected_file != '') {

                $tab_4_class = 'tabpurple';

            }

        }
    }
    $tf++;
}

$detail_sql = "SELECT 
sum(temp.total_amount) as final_amount, 
score.name FROM (
SELECT sum(lineitem.LineAmount) as total_amount, 
accounts.Name FROM xero_expense_item_tracking AS item_tracking 
LEFT JOIN xero_expense_lineitem as lineitem ON lineitem.LineItemID = item_tracking.LineItemID 
LEFT JOIN xero_accounts as accounts ON accounts.code = lineitem.AccountCode 
WHERE item_tracking.Option= '" . $current_title . "' GROUP BY accounts.Name) 
AS Temp 
LEFT JOIN xero_score_config as config ON config.name = temp.Name 
LEFT JOIN xero_score_config as score ON score.id = config.parent_id 
GROUP BY score.name";
$details_res = $wpdb->get_results($detail_sql, ARRAY_A);
?>


<!-- Code to add color classes if any file required action [END] -->


<div class="main-container overflow" data-user-id="<?php echo get_current_user_id(); ?>"
     data-post-id="<?php echo get_the_id(); ?>">

    <div class="wrapper">

        <?php if (get_field('toggle_form')): ?>

            <?php $form_status = get_field('toggle_form'); ?>

        <?php endif; ?>

        <main role="main" class="<?php echo $form_status; ?>">
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="title">
                        <a class="fa fa-bars size-12" href="<?php bloginfo('url'); ?>/my-projects/"></a>
                        <span>
                                    <?php the_title(); ?>
                            </span>

                        <?php if (get_field('custom_link')): ?>

                            <a class="planning" href="<?php the_field('custom_link'); ?>" target="_blank"></a>

                        <?php endif; ?>


                        <?php if (get_field('custom_link_2')): ?>

                            <a class="build" href="<?php the_field('custom_link_2'); ?>" target="_blank"></a>

                        <?php endif; ?>

                    </h1>
                    <div class="project-status overflow">

                        <div class="project-column first">

                            <div class="project-title">

                                <?php _e('Project Tracker', 'html5blank'); ?>

                            </div>


                            <div class="project-address">

                                <?php if (get_field('project_address')): ?>

                                    <?php the_field('project_address'); ?><?php if (get_field('project_suburb')): ?>, <?php the_field('project_suburb'); ?><?php endif; ?>

                                <?php endif; ?>

                            </div>

                        </div>

                        <?php if (get_field('status_prepurchase')): ?>

                            <?php

                            $status = get_field_object('status_prepurchase');

                            $value = $status['value'];

                            $label = $status['choices'][$value];

                            ?>


                            <div class="project-column">

                                <div class="stage">

                                    <?php _e('Pre-Purchase', 'html5blank'); ?>

                                </div>


                                <div class="status <?php echo $value; ?>">

                                    <?php echo $label; ?>

                                </div>

                            </div>

                        <?php endif; ?>

                        <?php if (get_field('status_settlement_period')): ?>

                            <?php

                            $status = get_field_object('status_settlement_period');

                            $value = $status['value'];

                            $label = $status['choices'][$value];

                            ?>


                            <div class="project-column">

                                <div class="stage">

                                    <?php _e('Settlement', 'html5blank'); ?>


                                    <span>

											<?php _e('Period', 'html5blank'); ?>

										</span>

                                </div>


                                <div class="status <?php echo $value; ?>">

                                    <?php echo $label; ?>

                                </div>

                            </div>

                        <?php endif; ?>

                        <?php if (get_field('status_post_settlement')): ?>

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

                        <?php if (get_field('status_tp_demo')): ?>

                            <?php

                            $status = get_field_object('status_tp_demo');

                            $value = $status['value'];

                            $label = $status['choices'][$value];

                            ?>


                            <div class="project-column">

                                <div class="stage">

                                    <?php _e('TP & Demo', 'html5blank'); ?>

                                </div>


                                <div class="status <?php echo $value; ?>">

                                    <?php echo $label; ?>

                                </div>

                            </div>

                        <?php endif; ?>

                        <?php if (get_field('status_engineering')): ?>

                            <?php

                            $status = get_field_object('status_engineering');

                            $value = $status['value'];

                            $label = $status['choices'][$value];

                            ?>


                            <div class="project-column">

                                <div class="stage">

                                    <?php _e('Engineering', 'html5blank'); ?>

                                </div>


                                <div class="status <?php echo $value; ?>">
                                    <?php echo $label; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (get_field('status_build')): ?>
                            <?php
                            $status = get_field_object('status_build');
                            $value = $status['value'];
                            $label = $status['choices'][$value];
                            ?>
                            <div class="project-column">
                                <div class="stage">

                                    <?php _e('Build', 'html5blank'); ?>

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
                                <a href="#tab-1" class="normal">

                                    <span class="fa fa-comments size-45 grey"></span>


                                    <?php _e('Chat', 'html5blank'); ?>

                                </a>
                            </li>
                            <li>
                                <a href="#tab-2" class="normal">
                                    <span class="fa fa-file size-40 grey margin-3"></span>
                                    <?php _e('Files', 'html5blank'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-3" class="normal">
                                    <span class="fa fa-database size-40 grey margin-2"></span>
                                    <?php _e('Money', 'html5blank'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-6" class="normal">
                                    <span class="fa fa-align-left size-40 grey margin-1"></span>
                                    <?php _e('Gantt', 'html5blank'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-4" class="normal <?php echo $tab_4_class; ?>">
                                    <span class="fa fa-clipboard size-45 grey"></span>
                                    <?php _e('Tasks', 'html5blank'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-5" class="normal">
                                    <span class="fa fa-line-chart size-40 grey margin-1"></span>
                                    <?php _e('Score', 'html5blank'); ?>
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tab">

                            <?PHP /*?><div class="btn-activity">

									<span class="wpd-sbs-title">Activity</span>

									<i class="fas fa-caret-down"></i>



									<?php usort($clients, 'date_compare'); ?>



									<div class="activity">

										<?php

											foreach ($clients as $client) {

												$name = $client['display_name'];

												$id = $client['ID'];

												$email = $client['user_email'];

												$last_login = get_last_login($id);

												$avatar = get_avatar_url($id, 32);



												echo '<p> <img src="'. $avatar .'" />' . $name . ' - ' . $last_login . '</p>';

											}

										?>

									</div>

								</div>



								<?php get_template_part('loop-comments-featured'); ?>



								<?php comments_template(); */ ?>
                            <?php

                            $current_post_id = get_the_ID();
                            $currentuserid = get_current_user_id();

                            ?>
                            <form action="" name="addComments" method="post">
                                <textarea id="editor" class="editor" name=""></textarea>
                                <div class="ser-full">
                                    <div class="ser-full-l">
                                        <div id="mineiscuz-search-formc">
                                            <div class="mineiscuz-search-boxc">
                                                <input type="text" placeholder="Search comments ..."
                                                       name="search-comment" class="mineiscuz-comm-searchc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ser-full-r">
                                        <input id="com-sub" class="wc_comm_submit wpd_not_clicked wpd-prim-button"
                                               type="submit" name="commentsubmit" value="Post Comment">
                                    </div>
                                </div>
                                <input type="hidden" class="current_post_id" name="current_post_id"
                                       value="<?php echo $current_post_id; ?>">
                                <input type="hidden" class="currentuserid" name="currentuserid"
                                       value="<?php echo $currentuserid; ?>">
                            </form>
                            <div class="comment-left">
                                <?php
                                $comments = get_comments(array(
                                    'post_id' => $current_post_id,
                                    'status' => 'approve',
                                    'orderby' => 'comment_date', 'order' => 'DESC',
                                    'parent' => array(0)
                                ));
                                /* echo "<pre>";
                                print_r($comments);
                                echo "</pre>";
                                die; */
                                if (!empty($comments)) {
                                    foreach ($comments as $comment) {
                                        $comment_id = $comment->comment_ID;
                                        $comment_content = $comment->comment_content;
                                        $username = $comment->comment_author;
                                        $comment_date = $comment->comment_date;
                                        $comment_date_new = date("F d, g:i A", strtotime($comment_date));
                                        $userid = $comment->user_id;
                                        $viewed = get_comment_meta($comment_id, 'comment_viewed_by', true);
                                        $class = '';
                                        if ($userid == $currentuserid) {
                                            $class = "";
                                        } else {
                                            $class = "viewcomment";
                                        }
                                        ?>

                                        <div class="comnmine-thread <?php echo $class; ?>"
                                             commentid="<?php echo $comment_id; ?>"
                                             commentuserid="<?php echo $userid; ?>">
                                            <div id="comnminethread" class="comnminethread">
                                                <div class="comnminethread-user">
                                                    <div id="comnmineuser" class="right">
                                                        <div class="comnmine-header">
                                                            <div class="comnmine-author">
                                                                <?php echo $username;
                                                                if ($userid == $currentuserid) {
                                                                    ?>
                                                                    <div class="comnmine-status"><span
                                                                                class="comnmine-onlinem">Online</span><input
                                                                                type="hidden" class="comnmine-uuid"
                                                                                value="o"></div>
                                                                <?php } else { ?>
                                                                    <div class="comnmine-status-offline"><span
                                                                                class="comnmine-offline">Offline</span><input
                                                                                type="hidden" class="comnmine-uuid"
                                                                                value="o"></div>
                                                                <?php } ?>


                                                            </div>
                                                            <div class="comnmine-date">
                                                                <?php echo $comment_date_new; ?>
                                                            </div>
                                                        </div>
                                                        <div class="comnmine-text">
                                                            <p style="float: left; margin-right:1%;"><?php echo $comment_content; ?></p>
                                                            <div class="comnmine-author">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     aria-hidden="true" focusable="false" width="1em"
                                                                     height="1em"
                                                                     style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                                                     preserveAspectRatio="xMidYMid meet"
                                                                     viewBox="0 0 512 512">
                                                                    <path style="fill: #26ac00 !important;"
                                                                          d="M505 174.8l-39.6-39.6c-9.4-9.4-24.6-9.4-33.9 0L192 374.7L80.6 263.2c-9.4-9.4-24.6-9.4-33.9 0L7 302.9c-9.4 9.4-9.4 24.6 0 34L175 505c9.4 9.4 24.6 9.4 33.9 0l296-296.2c9.4-9.5 9.4-24.7.1-34zm-324.3 106c6.2 6.3 16.4 6.3 22.6 0l208-208.2c6.2-6.3 6.2-16.4 0-22.6L366.1 4.7c-6.2-6.3-16.4-6.3-22.6 0L192 156.2l-55.4-55.5c-6.2-6.3-16.4-6.3-22.6 0L68.7 146c-6.2 6.3-6.2 16.4 0 22.6l112 112.2z"
                                                                          fill="#626262"/>
                                                                </svg>
                                                                <div class="comnmine-status"><span
                                                                            class="comnmine-onlinem">Seen By : Peter Kelly, Gaurav Sehrawat </span><input
                                                                            type="hidden" class="comnmine-uuid"
                                                                            value="o"></div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="comnmine-last-edited"><i class="far fa-edit"></i>Last edited 20 hours ago by Ben Drohan</div>-->
                                                        <div class="comnmine-footer">
                                                            <div class="comnmine-vote">
                                                                <div class="comnmine-vote-up comnmine-not-clicked">
                                                                    <svg xmlns="https://www.w3.org/2000/svg"
                                                                         viewBox="0 0 24 24">
                                                                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                                        <path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2z"></path>
                                                                    </svg>
                                                                </div>
                                                                <div class="comnmine-vote-result">0</div>
                                                            </div>
                                                            <div class="comnmine-reply-button">
                                                                <svg xmlns="https://www.w3.org/2000/svg"
                                                                     viewBox="0 0 24 24">
                                                                    <path d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"></path>
                                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                                </svg>
                                                                <span>Reply</span>
                                                            </div>
                                                            <?php
                                                            if ($userid == $currentuserid) {
                                                                if (!empty($viewed)) { ?>
                                                                    <div>Seen By :
                                                                        <?php
                                                                        $i = 1;
                                                                        $cview = count($viewed);
                                                                        // echo $cview;die;
                                                                        foreach ($viewed as $view) {
                                                                            // print_r($view);die;
                                                                            $viewer_name = get_user_meta($view, 'first_name', true);
                                                                            if (get_user_meta($view, 'last_name', true) != '') {
                                                                                $viewer_name .= ' ' . get_user_meta($view, 'last_name', true);
                                                                            }

                                                                            if ($i >= 1 && $i < $cview) {
                                                                                $viewers_name = $viewer_name . ',';
                                                                            } else {
                                                                                $viewers_name = $viewer_name;
                                                                            }
                                                                            ?>
                                                                            <?php echo $viewers_name; ?>
                                                                            <?php $i++;
                                                                        } ?>
                                                                    </div>
                                                                <?php }
                                                            } ?>
                                                            <div class="comnmine-tools comnmine-hidden"
                                                                 title="Manage Comment"><i class="fas fa-cog"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php }
                                } else {
                                    ?>
                                    <div class="comnmine-thread">No Comment yet.</div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php ?>

                        <div id="tab-2" class="tab active">

                            <?php if (have_rows('plan_folders') || have_rows('plan_files_2')): ?>

                                <ul class="plan-list container">

                                    <?php while (have_rows('plan_folders')) : the_row(); ?>

                                        <li class="list-title mix">

                                            <?php the_sub_field('plan_folders_name'); ?>

                                        </li>


                                        <div class="sub">

                                            <?php while (have_rows('plan_files')) : the_row(); ?>

                                                <?php

                                                $name = get_sub_field('plan_name');

                                                $file = get_sub_field('plan_file');

                                                $type = get_sub_field('plan_type');

                                                $url = $file['url'];

                                                ?>


                                                <li class="mix <?php echo strtolower($name); ?>">

                                                    <?php if ($type == 'pdf'): ?>

                                                        <a href="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true"
                                                           data-iframe="true" class="doc">

                                                            <?php echo $name; ?>

                                                        </a>

                                                    <?php endif; ?>



                                                    <?php if ($type == 'image'): ?>

                                                        <a class="doc" href="<?php echo $url; ?>">

                                                            <?php echo $name; ?>

                                                        </a>

                                                    <?php endif; ?>



                                                    <?php if ($type == 'document'): ?>

                                                        <a class="doc" data-iframe="true"
                                                           href="<?php the_sub_field('plan_document_url'); ?>?embedded=true">

                                                            <?php echo $name; ?>

                                                        </a>

                                                    <?php endif; ?>

                                                </li>

                                            <?php endwhile; ?>

                                        </div>

                                    <?php endwhile; ?>



                                    <?php while (have_rows('plan_files_2')) : the_row(); ?>

                                        <?php

                                        $name = get_sub_field('plan_name');

                                        $file = get_sub_field('plan_file');

                                        $type = get_sub_field('plan_type');

                                        $url = $file['url'];

                                        ?>


                                        <li class="mix <?php echo strtolower($name); ?>">

                                            <?php if ($type == 'pdf'): ?>

                                                <a href="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true"
                                                   data-iframe="true" class="doc">

                                                    <?php echo $name; ?>

                                                </a>

                                            <?php endif; ?>



                                            <?php if ($type == 'image'): ?>

                                                <a class="doc" href="<?php echo $url; ?>">

                                                    <?php echo $name; ?>

                                                </a>

                                            <?php endif; ?>



                                            <?php if ($type == 'document'): ?>

                                                <a class="doc" data-iframe="true"
                                                   href="<?php the_sub_field('plan_document_url'); ?>?embedded=true">

                                                    <?php echo $name; ?>

                                                </a>

                                            <?php endif; ?>

                                        </li>

                                    <?php endwhile; ?>

                                </ul>

                            <?php else : ?>

                                <div class="no-plans">

                                    <?php _e('There are no files uploaded.', 'html5blank'); ?>

                                </div>

                            <?php endif; ?>

                        </div>

                        <div id="tab-3" class="tab">
                            <?php if (have_rows('money_folders') || have_rows('money_files_2')): ?>
                                <ul class="plan-list container">
                                    <?php while (have_rows('money_folders')) : the_row(); ?>
                                        <li class="list-title mix">
                                            <?php the_sub_field('money_folders_name'); ?>
                                        </li>
                                    <?php endwhile; ?>
                                    <?php while (have_rows('money_files_2')) : the_row(); ?>
                                        <?php

                                        $name = get_sub_field('money_name');

                                        $file = get_sub_field('money_file');

                                        $type = get_sub_field('money_type');

                                        $url = $file['url'];

                                        ?>
                                        <li class="mix <?php echo strtolower($name); ?>">

                                            <?php if ($type == 'pdf'): ?>

                                                <a href="https://docs.google.com/gview?url=<?php echo $url; ?>&amp;embedded=true"
                                                   data-iframe="true" class="doc">

                                                    <?php echo $name; ?>

                                                </a>

                                            <?php endif; ?>

                                            <?php if ($type == 'image'): ?>

                                                <a class="doc" href="<?php echo $url; ?>">

                                                    <?php echo $name; ?>

                                                </a>

                                            <?php endif; ?>

                                            <?php if ($type == 'document'): ?>

                                                <a class="doc" data-iframe="true"
                                                   href="<?php the_sub_field('money_document_url'); ?>?embedded=true">

                                                    <?php echo $name; ?>

                                                </a>

                                            <?php endif; ?>

                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <?php if (get_field('google_document')): ?>
                                <?php
                                if (count($templateData)) { ?>
                                    <div class="panel panel-default list_table">
                                        <div class="panel-body">
                                            <table class="table table-condensed">
                                                <thead>
                                                <tr>
                                                    <th>Expense</th>
                                                    <th>Amount</th>
                                                    <th>GST</th>
                                                    <th>Date</th>
                                                    <th>Paid to</th>
                                                    <th>Notes</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $total_amount = 0;
                                                $gst = 0;
                                                foreach ($templateData as $year => $months) {
                                                    foreach ($months as $month => $listDatas) {
                                                        $dateObj = DateTime::createFromFormat('!m', $month);
                                                        $monthName = $dateObj->format('M');
                                                        ?>
                                                        <tr>
                                                            <td colspan="12" class="main_head_bg">
                                                                <div role="button" data-toggle="collapse"
                                                                     href="#list_<?php echo $year . '_' . $month ?>"
                                                                     class="accordion-toggle collapsed"
                                                                     aria-expanded="true">
                                                                    <span class="text_right"><?php echo $monthName, ' ', $year; ?></span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="12" class="hiddenRow">
                                                                <div class="accordian-body collapse"
                                                                     id="list_<?php echo $year . '_' . $month ?>">
                                                                    <table class="table">
                                                                        <tbody>
                                                                        <?php
                                                                        foreach ($listDatas as $listData) {
                                                                            $total_amount += $listData->LineAmount;
                                                                            $gst += $listData->TaxAmount;
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $listData->ItemCode ? $listData->ItemCode : $listData->Description; ?></td>
                                                                                <td><?php echo $listData->LineAmount ? '$' . number_format($listData->LineAmount, 2, '.', ',') : '$ 0'; ?> </td>
                                                                                <td><?php echo $listData->TaxAmount ? '$' . number_format($listData->TaxAmount, 2, '.', ',') : '$ 0'; ?> </td>
                                                                                <td>
                                                                                    <?php
                                                                                    $date = date_create($listData->Date);
                                                                                    echo date_format($date, "d.m.Y") ? date_format($date, "d.m.Y") : '';
                                                                                    ?>
                                                                                </td>
                                                                                <td><?php echo $listData->name ? $listData->name : ''; ?></td>
                                                                                <td><?php echo $listData->Description ? $listData->Description : ''; ?></td>
                                                                            </tr>
                                                                            <?php ?>
                                                                        <?php }
                                                                        ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } ?>
                                                <tr class="amount_cal">
                                                    <td>
                                                        Total costs
                                                    </td>
                                                    <td>
                                                        <?php echo $total_amount ? '$' . $total_amount : '$ 0'; ?>
                                                    </td>
                                                    <td>
                                                        <?php // echo $gst ? '$' . $gst : '$ 0'; ?>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <iframe style="height: <?php the_field('google_document_height'); ?>px;"
                                            src="<?php the_field('google_document'); ?>?widget=true&headers=false"></iframe>
                                <?php } ?>
                            <?php endif; ?>
                        </div>

                        <div id="tab-6" class="tab">

                            <?php if (get_field('gantt_document')): ?>

                                <div>

                                    <iframe style="height: <?php the_field('gantt_document_height'); ?>px;"
                                            src="<?php the_field('gantt_document'); ?>"></iframe>


                                    <a class="hide" href='http://teamgantt.com' target='_blank'>Online Gantt Chart</a>

                                </div>

                            <?php endif; ?>

                        </div>

                        <div id="tab-4" class="tab">

                            <?php

                            $dropzoneclass = 'greydrop';


                            if ($last_selected_file != '') {

                                $dropzoneclass = 'purpleForm';

                            } ?>


                            <div class="taskSubSection">

                                <div class="leftUpload">

                                    <div class="uploadDragnDrop <?php echo $dropzoneclass; ?>">

                                        <form action="<?php echo site_url(); ?>/file_upload.php" method="post"
                                              class="dropzone dz-clickable">

                                            <input name="meta_id" id="meta_id"
                                                   value="<?php echo $last_selected_file; ?>" type="hidden">

                                            <input name="user_id" value="<?php echo get_current_user_id(); ?>"
                                                   type="hidden">

                                            <input name="post_id" value="<?php echo $curr_clientid; ?>" type="hidden">

                                            <div class="dz-default dz-message">

                                                <div class="dzMidleCont">

                                                    <?php if ($last_selected_file == '') { ?>

                                                        <i class="dropIcon"></i>

                                                        <span>Drop files here to upload</span>

                                                    <?php } else { ?>

                                                        <i class="dropIcon"></i>

                                                        <p class="coloredText"><strong>Important:</strong> Please only
                                                            upload this file; </p>

                                                        <?php $filename = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "postmeta` WHERE `meta_id` = $last_selected_file");

                                                        $metaKey = str_replace("legal_files_2_", "", (str_replace("_doc_uploaded_for", "", $filename[0]->meta_key)));

                                                        $fileID = get_post_meta($filename[0]->post_id, 'legal_files_2_' . $metaKey . '_legal_file', true);

                                                        //~ echo "<pre>"; print_r($filename); echo "</pre>";

                                                        $filename_url = wp_get_attachment_url($fileID);

                                                        $filename_type = wp_check_filetype($filename_url);


                                                        ?>

                                                        <p class="coloredText"><?php echo get_the_title($fileID) . '.' . $filename_type['ext']; ?></p>

                                                        <p>* All other files can be uploaded after you have uploaded the
                                                            requested file.</p>

                                                    <?php } ?>

                                                </div>

                                            </div>

                                        </form>

                                    </div>


                                    <?php if (have_rows('legal_files_2')): ?>

                                        <ul class="taskDownloadList">

                                            <?php /*************Code to fetch legal files [START]*************/

                                            $get_added_files = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "postmeta` WHERE `post_id` = " . $curr_clientid . " AND `meta_key` LIKE 'legal_files_2_%_legal_name' ");

                                            $assigned_doc = '';

                                            $f = 0;

                                            foreach ($get_added_files as $added_file) {

                                                if (is_super_admin($currentuserid)) {
                                                    $f++;
                                                    continue;
                                                }


                                                $meta_id = $wpdb->get_results("SELECT meta_id FROM `" . $wpdb->prefix . "postmeta` WHERE `post_id` = " . $curr_clientid . " AND `meta_key` LIKE 'legal_files_2_" . $f . "_doc_uploaded_for' ");

                                                if ($last_selected_file == $meta_id[0]->meta_id) {
                                                    $f++;
                                                    continue;
                                                }


                                                $assigned_to = get_post_meta($curr_clientid, 'legal_files_2_' . $f . '_doc_uploaded_for', true);

                                                $due_date = get_post_meta($curr_clientid, 'legal_files_2_' . $f . '_due_date', true);

                                                $file_id = get_post_meta($curr_clientid, 'legal_files_2_' . $f . '_legal_file', true);

                                                $name = get_post_meta($curr_clientid, 'legal_files_2_' . $f . '_legal_name', true);

                                                $type = get_post_meta($curr_clientid, 'legal_files_2_' . $f . '_legal_type', true);

                                                $action_required = get_post_meta($curr_clientid, 'legal_files_2_' . $f . '_action_required', true);


                                                $fullsize_path = get_attached_file($file_id);


                                                $url = wp_get_attachment_url($file_id);

                                                $filetype = wp_check_filetype($url);

                                                $fileName = get_the_title($file_id) . '.' . $filetype['ext'];


                                                if ($type == 'document') {

                                                    $ft = 'doc_file';

                                                } else {

                                                    $ft = 'pdf_file';

                                                }

                                                if ($action_required == 'Yes') {

                                                    $exist_check = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "uploaded_doc WHERE meta_id = " . $meta_id[0]->meta_id);

                                                } else {

                                                    $exist_check = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "uploaded_doc WHERE meta_id = " . $meta_id[0]->meta_id . " AND user_id = " . $currentuserid);

                                                }

                                                //~ echo "<pre>"; print_r($exist_check); echo "</pre>";

                                                if (!$exist_check) {

                                                    //~ echo $f;


                                                    if ($last_selected_file != $meta_id[0]->meta_id) {


                                                        if ($action_required == 'Yes') {

                                                            if ($assigned_to == $currentuserid) {

                                                                $liclass = "purpuleDownList";

                                                            } else {

                                                                $f++;
                                                                continue;

                                                            }

                                                        } else {

                                                            $liclass = "BlueDownList noaction ";

                                                        }


                                                        if ($action_required == 'Yes' && $assigned_to == $currentuserid) {

                                                            $assigned_doc .= "<li  class='$liclass " . strtolower($name) . "' metaid='" . $meta_id[0]->meta_id . "' postId='" . $curr_clientid . "'>";

                                                            $manualSign = 'manualSign';


                                                            $assigned_doc .= "<a href='$url' class='taskURL $manualSign' download meta-data='" . $meta_id[0]->meta_id . "' file-name='$fileName' meta-post-id='$curr_clientid' meta-user-id='" . get_current_user_id() . "' type='application/octet-stream'>

																		<i  class='TaskIcons downloadActionBtn' download title='Download'></i>

																		<span>$name</span>

																	</a>";

                                                            $assigned_doc .= " </li>";

                                                        } else if ($assigned_to == $currentuserid || $assigned_to == '') {

                                                            $assigned_doc .= "<li  class='$liclass " . strtolower($name) . " meta" . $meta_id[0]->meta_id . "' metaid='" . $meta_id[0]->meta_id . "' postId='" . $curr_clientid . "' onclick='alertFunction(" . $meta_id[0]->meta_id . ");'>";

                                                            $manualSign = 'manualSign';


                                                            $assigned_doc .= "<a href='$url' class='taskURL $manualSign' download meta-data='" . $meta_id[0]->meta_id . "' file-name='$fileName' meta-post-id='$curr_clientid' meta-user-id='" . get_current_user_id() . "' type='application/octet-stream'>";

                                                            $assigned_doc .= "<i  class='TaskIcons downloadActionBtn' download title='Download'></i>

																		<span>$name</span>

																	</a>";

                                                            $assigned_doc .= " </li>";

                                                        }

                                                    }

                                                }

                                                $f++;

                                            }

                                            if ($assigned_doc != '') {

                                                echo $assigned_doc;

                                            } else { ?>

                                                <li class="GreyDownList noDownloads 555"><a href="javascript:void(0);"
                                                                                            class='taskURL'><i
                                                                class="TaskIcons downloadActionBtn announceIcon"></i><span>You're awesome, you have no task to complete</span></a>
                                                </li>

                                            <?php }

                                            /*************Code to fetch legal files [END]*************/ ?>

                                        </ul>

                                    <?php else : ?>

                                        <ul class="taskDownloadList">

                                            <li class="GreyDownList noDownloads"><a href="javascript:void(0);"
                                                                                    class='taskURL'><i
                                                            class="TaskIcons downloadActionBtn announceIcon"></i><span>You're awesome, you have no task to complete</span></a>
                                            </li>

                                        </ul>

                                    <?php endif; ?>

                                </div>


                                <div class="rightDownload">

                                    <ul class="taskDownloadList">

                                        <?php

                                        $uploaded_doc = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "uploaded_doc WHERE post_id = $curr_clientid AND status = 1 ORDER BY `id` DESC");

                                        if (!empty($uploaded_doc)) {

                                            foreach ($uploaded_doc as $doc) {

                                                $file_id = $doc->file_id;

                                                $url = wp_get_attachment_url($file_id);

                                                $filetype = wp_check_filetype($url); ?>

                                                <li class='GreyDownList withfile '>

                                                    <a href='<?php echo wp_get_attachment_url($file_id); ?>'
                                                       class='taskURL' download><i class='TaskIcons downloadActionBtn'
                                                                                   download
                                                                                   title='Download'></i><span><?php echo $doc->file_name; ?></span></a>

                                                </li>

                                            <?php }

                                        } else { ?>

                                            <li class="GreyDownList noDownloads"><a href="javascript:void(0);"
                                                                                    class='taskURL'><i
                                                            class="TaskIcons downloadActionBtn announceIcon"></i><span>You currently have no files uploaded.</span></a>
                                            </li>

                                        <?php } ?>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div id="tab-5" class="tab">

                            <div class="score-wrap">

                                <div class="float-right">

                                    <?php if (get_field('admin_timer')): ?>

                                        <div class="soon" data-scale-max="l" data-layout="group label-below"
                                             data-format="M,d,h,m,s" data-face=""
                                             data-due="<?php the_field('admin_timer'); ?>"></div>

                                    <?php endif; ?>

                                </div>


                                <div class="float-left">

                                    <?php if (have_rows('admin_scoreboard')): ?>

                                        <div class="scoreboard">

                                            <div class="row top">

                                                <div class="cell blue">

                                                    &nbsp;

                                                </div>


                                                <div class="cell grey">

                                                    <?php _e('Budget', 'html5blank'); ?>

                                                </div>


                                                <div class="cell">

                                                    <?php _e('Actual', 'html5blank'); ?>

                                                </div>


                                                <div class="cell">

                                                    <?php _e('Variance', 'html5blank'); ?>

                                                </div>

                                            </div>
                                            <?php while (have_rows('admin_scoreboard')): the_row(); ?>
                                                <?php
                                                if (count($details_res) > 0) {
                                                    $loop_data = searchForName(get_sub_field('admin_scoreboard_label'), $details_res);
                                                } else {
                                                    $loop_data = false;
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="cell blue">
                                                        <?php the_sub_field('admin_scoreboard_label'); ?>
                                                    </div>

                                                    <div class="cell grey">
                                                        <?php the_sub_field('admin_scoreboard_original'); ?>
                                                    </div>

                                                    <div class="cell">
                                                        <?php
                                                        global $purchase_cost, $tp_demo, $pm_fee, $total_build, $total_holding, $open_space, $gst;
                                                        $datas = array();
                                                        if (trim(get_sub_field('field_is_manual')) == 'false') {

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'Purchase Costs') {
                                                                $purchase_cost = $loop_data['final_amount'];
                                                                $_SESSION['datas']['purchase_cost'] = $loop_data['final_amount'];
                                                                echo $purchase_cost ? '$ ' . number_format($purchase_cost, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'Purchase Costs')) {
                                                                $_SESSION['datas']['purchase_cost'] = '0';
                                                                echo '$ 0';
                                                            }

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'TP & Demo') {
                                                                $tp_demo = $loop_data['final_amount'];
                                                                $_SESSION['datas']['tp_demo'] = $loop_data['final_amount'];
                                                                echo $tp_demo ? '$ ' . number_format($tp_demo, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'TP & Demo')) {
                                                                $_SESSION['datas']['tp_demo'] = '0';
                                                                echo '$ 0';
                                                            }

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'PM Fee') {
                                                                $pm_fee = $loop_data['final_amount'];
                                                                $_SESSION['datas']['pm_fee'] = $loop_data['final_amount'];
                                                                echo $pm_fee ? '$ ' . number_format($pm_fee, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'PM Fee')) {
                                                                $_SESSION['datas']['pm_fee'] = '0';
                                                                echo '$ 0';
                                                            }

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'Total Build') {
                                                                $total_build = $loop_data['final_amount'];
                                                                $_SESSION['datas']['total_build'] = $loop_data['final_amount'];
                                                                echo $total_build ? '$ ' . number_format($total_build, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'Total Build')) {
                                                                $_SESSION['datas']['total_build'] = '0';
                                                                echo '$ 0';
                                                            }

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'Total Holding') {
                                                                $total_holding = $loop_data['final_amount'];
                                                                $_SESSION['datas']['total_holding'] = $loop_data['final_amount'];
                                                                echo $total_holding ? '$ ' . number_format($total_holding, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'Total Holding')) {
                                                                $_SESSION['datas']['total_holding'] = '0';
                                                                echo '$ 0';
                                                            }

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'Open Space') {
                                                                $open_space = $loop_data['final_amount'];
                                                                $_SESSION['datas']['open_space'] = $loop_data['final_amount'];
                                                                echo $open_space ? '$ ' . number_format($open_space, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'Open Space')) {
                                                                $_SESSION['datas']['open_space'] = '0';
                                                                echo '$ 0';
                                                            }

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'GST') {
                                                                $gst = $loop_data['final_amount'];
                                                                $_SESSION['datas']['gst'] = $loop_data['final_amount'];
                                                                echo $gst ? '$ ' . number_format($gst, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'GST')) {
                                                                $_SESSION['datas']['gst'] = '0';
                                                                echo '$ 0';
                                                            }

                                                            if (($loop_data && trim($loop_data['name']) == trim(get_sub_field('admin_scoreboard_label')))
                                                                && trim(get_sub_field('admin_scoreboard_label')) == 'Total Sales') {
                                                                $total_sales = $loop_data['final_amount'];
                                                                $_SESSION['datas']['total_sales'] = $loop_data['final_amount'];
                                                                echo $total_sales ? '$ ' . number_format($total_sales, 2, '.', ',') : '$ 0';
                                                            } else if (($loop_data == false) && (trim(get_sub_field('admin_scoreboard_label')) == 'Total Sales')) {
                                                                $_SESSION['datas']['total_sales'] = '0';
                                                                echo '$ 0';
                                                            }

                                                        }
                                                        else if (trim(get_sub_field('field_is_manual')) == 'true') {
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'Purchase Costs') {
                                                                $purchase_cost = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['purchase_cost'] = $purchase_cost;
                                                                echo $purchase_cost ? '$ ' . number_format($purchase_cost, 2, '.', ',') : '$ 0';
                                                            }
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'TP & Demo') {
                                                                $tp_demo = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['tp_demo'] = $tp_demo;
                                                                echo $tp_demo ? '$ ' . number_format($tp_demo, 2, '.', ',') : '$ 0';
                                                            }
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'PM Fee') {
                                                                $pm_fee = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['pm_fee'] = $pm_fee;
                                                                echo $pm_fee ? '$ ' . number_format($pm_fee, 2, '.', ',') : '$ 0';
                                                            }
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Build') {
                                                                $total_build = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['total_build'] = $total_build;
                                                                echo $total_build ? '$ ' . number_format($total_build, 2, '.', ',') : '$ 0';
                                                            }
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Holding') {
                                                                $total_holding = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['total_holding'] = $total_holding;
                                                                echo $total_holding ? '$ ' . number_format($total_holding, 2, '.', ',') : '$ 0';
                                                            }
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'Open Space') {
                                                                $open_space = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['open_space'] = $open_space;
                                                                echo $open_space ? '$ ' . number_format($open_space, 2, '.', ',') : '$ 0';
                                                            }
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'GST') {
                                                                $gst = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['gst'] = $gst;
                                                                echo $gst ? '$ ' . number_format($gst, 2, '.', ',') : '$ 0';
                                                            }
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Sales') {
                                                                $total_sales = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                                $_SESSION['datas']['total_sales'] = $total_sales;
                                                                echo $total_sales ? '$ ' . number_format($total_sales, 2, '.', ',') : '$ 0';
                                                            }
                                                        }


                                                        if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Costs' && trim(get_sub_field('field_is_manual')) == 'false') {
                                                            if (isset($_SESSION['datas'])) {
                                                                $values = $_SESSION['datas'];
                                                                $total_cost = $values['purchase_cost'] + $values['tp_demo'] + $values['pm_fee'] + $values['total_build'] + $values['total_holding'] + $values['open_space'] + $values['gst'];
                                                                $_SESSION['datas']['total_costs'] = $total_cost;
                                                                echo $total_cost ? '$ ' . number_format($total_cost, 2, '.', ',') : '$ 0';
                                                            }
                                                        }
                                                        else if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Costs' && trim(get_sub_field('field_is_manual')) == 'true') {
                                                            echo get_sub_field('admin_scoreboard_current');
                                                        }

                                                        if (trim(get_sub_field('admin_scoreboard_label')) == 'Net Profit' && trim(get_sub_field('field_is_manual')) == 'false') {
                                                            if (isset($_SESSION['datas'])) {
                                                                $values = $_SESSION['datas'];
                                                                if (isset($values['total_sales']) && isset($values['total_costs'])) {
                                                                    $net_profit = $values['total_sales'] - $values['total_costs'];
                                                                    $_SESSION['datas']['net_profit'] = $net_profit;
                                                                    echo $net_profit ? '$ ' . number_format($net_profit, 2, '.', ',') : '$ 0';
                                                                } else {
                                                                    echo '$ 0';
                                                                }
                                                            }
                                                        }
                                                        else if (trim(get_sub_field('admin_scoreboard_label')) == 'Net Profit' && trim(get_sub_field('field_is_manual')) == 'true') {
                                                            echo get_sub_field('admin_scoreboard_current');
                                                        }

                                                        if (trim(get_sub_field('admin_scoreboard_label')) == 'Net Project ROI' && trim(get_sub_field('field_is_manual')) == 'false') {
                                                            if (isset($_SESSION['datas'])) {
                                                                $values = $_SESSION['datas'];
                                                                if (isset($values['net_profit']) && isset($values['total_costs'])) {
                                                                    $net_pro_roi = $values['net_profit'] / $values['total_costs'];
                                                                    echo $net_pro_roi ? '$ ' . number_format($net_pro_roi, 2, '.', ',') : '$ 0';
                                                                } else {
                                                                    echo '$ 0';
                                                                }
                                                            }
                                                        }
                                                        else if (trim(get_sub_field('admin_scoreboard_label')) == 'Net Project ROI' && trim(get_sub_field('field_is_manual')) == 'true') {
                                                            echo get_sub_field('admin_scoreboard_current');
                                                        }

                                                        if (trim(get_sub_field('admin_scoreboard_label')) == 'Net ROE') {
                                                            if (isset($_SESSION['datas'])) {
                                                                $values = $_SESSION['datas'];
                                                                $percentage = trim(str_replace("%", "", get_field('field_is_config_net_roe')));
                                                                if (isset($values['net_profit']) && isset($values['total_costs']) && get_field('field_is_config_net_roe')) {
                                                                    $totalValue = $values['total_costs'];
                                                                    $finalValue = ($percentage / 100) * $totalValue;
                                                                    $net_roe = $values['net_profit'] / $finalValue;
                                                                    $net_roe_val = bcdiv($net_roe, 1, 2);
                                                                    echo '$ ' . $net_roe_val;
                                                                } else {
                                                                    echo '$ 0';
                                                                }
                                                            }
                                                        } else if (trim(get_sub_field('admin_scoreboard_label')) == 'Net ROE' && trim(get_sub_field('field_is_manual')) == 'true') {
                                                            echo get_sub_field('admin_scoreboard_current');
                                                        }

                                                        if (trim(get_sub_field('admin_scoreboard_label')) == 'Days' && trim(get_sub_field('field_is_manual')) == 'false') {
                                                            echo get_sub_field('admin_scoreboard_original');
                                                        } else if (trim(get_sub_field('admin_scoreboard_label')) == 'Days' && trim(get_sub_field('field_is_manual')) == 'true') {
                                                            echo get_sub_field('admin_scoreboard_current');
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="cell variation<?php if (get_sub_field('admin_scoreboard_comment')): ?> hover<?php endif; ?>"
                                                         style="color: <?php the_sub_field('admin_scoreboard_variation_color'); ?>">

                                                        <?php
                                                        if (trim(get_sub_field('field_is_manual')) == 'false') {
                                                            $budget = trim(str_replace(["$", ","], ["", ""], get_sub_field('admin_scoreboard_current')));
                                                            if (trim(get_sub_field('admin_scoreboard_label')) == 'Purchase Costs') {
                                                                if (isset($_SESSION['datas'])) {
                                                                    $actual_cost = 0;
                                                                    $values = $_SESSION['datas'];
                                                                    $actual_cost = $values['purchase_cost'];
                                                                    if ($actual_cost && $budget) {
                                                                        if ($actual_cost > $budget) {
                                                                            $value = '$ ' . number_format(($actual_cost - $budget), 2, '.', ',');
                                                                            echo "<span class=\"error_high\">$value</span>";
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                            }
                                                            else if (trim(get_sub_field('admin_scoreboard_label')) == 'TP & Demo') {
                                                                if (isset($_SESSION['datas'])) {
                                                                    $actual_cost = 0;
                                                                    $values = $_SESSION['datas'];
                                                                    $actual_cost = $values['tp_demo'];
                                                                    if ($actual_cost && $budget) {
                                                                        if ($actual_cost > $budget) {
                                                                            $value = '$ ' . number_format(($actual_cost - $budget), 2, '.', ',');
                                                                            echo "<span class=\"error_high\">$value</span>";
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                            }
                                                            else if (trim(get_sub_field('admin_scoreboard_label')) == 'PM Fee') {
                                                                if (isset($_SESSION['datas'])) {
                                                                    $actual_cost = 0;
                                                                    $values = $_SESSION['datas'];
                                                                    $actual_cost = $values['pm_fee'];
                                                                    if ($actual_cost && $budget) {
                                                                        if ($actual_cost > $budget) {
                                                                            $value = '$ ' . number_format(($actual_cost - $budget), 2, '.', ',');
                                                                            echo "<span class=\"error_high\">$value</span>";
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                            }
                                                            else if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Build') {
                                                                if (isset($_SESSION['datas'])) {
                                                                    $actual_cost = 0;
                                                                    $values = $_SESSION['datas'];
                                                                    $actual_cost = $values['total_build'];
                                                                    if ($actual_cost && $budget) {
                                                                        if ($actual_cost > $budget) {
                                                                            $value = '$ ' . number_format(($actual_cost - $budget), 2, '.', ',');
                                                                            echo "<span class=\"error_high\">$value</span>";
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                            }
                                                            else if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Holding') {
                                                                if (isset($_SESSION['datas'])) {
                                                                    $actual_cost = 0;
                                                                    $values = $_SESSION['datas'];
                                                                    $actual_cost = $values['total_holding'];
                                                                    if ($actual_cost && $budget) {
                                                                        if ($actual_cost > $budget) {
                                                                            $value = '$ ' . number_format(($actual_cost - $budget), 2, '.', ',');
                                                                            echo "<span class=\"error_high\">$value</span>";
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                            }
                                                            else if (trim(get_sub_field('admin_scoreboard_label')) == 'Open Space') {
                                                                if (isset($_SESSION['datas'])) {
                                                                    $actual_cost = 0;
                                                                    $values = $_SESSION['datas'];
                                                                    $actual_cost = $values['open_space'];
                                                                    if ($actual_cost && $budget) {
                                                                        if ($actual_cost > $budget) {
                                                                            $value = '$ ' . number_format(($actual_cost - $budget), 2, '.', ',');
                                                                            echo "<span class=\"error_high\">$value</span>";
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                            }
                                                            else if (trim(get_sub_field('admin_scoreboard_label')) == 'Total Sales') {
                                                                if (isset($_SESSION['datas'])) {
                                                                    $actual_cost = 0;
                                                                    $values = $_SESSION['datas'];
                                                                    $actual_cost = $values['total_sales'];
                                                                    if ($actual_cost && $budget) {
                                                                        if ($actual_cost > $budget) {
                                                                            $value = '$ ' . number_format(($actual_cost - $budget), 2, '.', ',');
                                                                            echo "<span class=\"error_high\">$value</span>";
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    } else {
                                                                        echo '-';
                                                                    }
                                                                } else {
                                                                    echo '-';
                                                                }
                                                            }
                                                            else {
                                                                echo '-';
                                                            }
                                                        } else {
                                                            the_sub_field('admin_scoreboard_variation');
                                                        }
                                                        ?>

                                                        <?php if (get_sub_field('admin_scoreboard_comment')): ?>

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

<?php

// echo "<pre>"; print_r(wp_get_current_user());
// echo "<pre>"; print_r(get_current_user_id());
$current_user_id = get_current_user_id();
?>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
    jQuery(document).ready(function () {
        var user_id = "<?php echo $current_user_id ?>";
        console.log(user_id);
        jQuery("body").on("custom-scroll", ".wpd-comment", function () {
            console.log("Scrolled :P");
        })
        jQuery(".wpd-comment").scroll(function () {
            console.log("Event Fired");
        })
        jQuery(".wpd-comment").scroll(function (e) {
            e.preventDefault();
            var elem = $(this);
            console.log(elem);

            // if (elem.scrollTop() > 0 &&
            //         (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())) {
            //     alert("At the bottom");
            // }
        });
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        jQuery(document).on('scroll', function () {
            // jQuery(document).one('mouseover', function() {
            if (jQuery(this).scrollTop() >= jQuery('.comnmine-thread').position().top) {


                // var comment_id = jQuery('.viewcomment').attr('commentid');
                var commentuserid = jQuery('.viewcomment').attr('commentuserid');
                var currentuserid = jQuery('.currentuserid').val();
                var inputs = jQuery(".viewcomment");
                for (var i = 0; i < inputs.length; i++) {
                    var comment_id = jQuery(inputs[i]).attr('commentid');
                    var data = {
                        action: 'update_viewed_comment',
                        comment_id: comment_id,
                        commentuserid: commentuserid,
                        currentuserid: currentuserid
                    };
                    jQuery.ajax({
                        type: 'post',
                        url: ajaxurl,
                        data: data,
                        success: function (response) {
                            jQuery(".comment-left").load(window.location.href + " .comment-left");
                            jQuery(".comnmine-thread").removeClass("viewcomment").addClass("viewedcomment");
                        }
                    });
                }
            }
        });
        jQuery('.wc_comm_submit').on('click', function (e) {
            e.preventDefault();
            var editor = CKEDITOR.instances['editor'].getData();
            var current_post_id = jQuery('.current_post_id').val();
            var currentuserid = jQuery('.currentuserid').val();
            // alert(editor);
            // alert(current_post_id);


            var data = {
                action: 'add_comments',
                editor: editor,
                current_post_id: current_post_id,
                currentuserid: currentuserid,

            };
            jQuery.ajax({
                type: 'post',
                url: ajaxurl,
                data: data,
                success: function (response) {
                    if (response == 1) {
                        CKEDITOR.instances['editor'].setData('');
                        jQuery(".comment-left").load(window.location.href + " .comment-left");
                    } else {

                    }
                }
            });
        });
    });
</script>
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
<?php get_footer(); ?>

