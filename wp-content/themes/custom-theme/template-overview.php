<?php/* Template Name: Overview Page Template */get_header();?><?php if( get_field('header_image') ): ?>    <?php $image = get_field('header_image'); ?>    <div class="header-image">        <img src="<?php echo $image['url']; ?>" alt="">    </div><?php endif; ?><?phpglobal $current_custom_user;global $wpdb;$current_user_field = 'user_' . $current_custom_user;$current_title = esc_html(get_the_title());$totVal = 0;$canShowUnCat = false;$show_menu = true;$user_filter_sql = '';$organisation_col = array();$project_address = array();global $current_custom_user;$args = array(    'post_type' => 'client',    'posts_per_page' => -1,    'order' => 'DESC');$wp_query = new WP_Query($args);?><?php if ($wp_query->have_posts()): while ($wp_query->have_posts()) : $wp_query->the_post(); ?>    <?php $clients = get_field('client_id'); ?>    <?php        if($clients){            if (in_array_r($current_custom_user, $clients)){                $fund_selection = get_field('field_5f55ec4ce0351');                if($fund_selection){                    $organisation_col[] = $fund_selection->post_title;                }                if(get_field('project_address')){                    $project_address[] = get_field('project_address');                }            }        }    ?><?php endwhile; ?><?php endif; ?><?php//project list$project_string_val='';$project_count = 0;$project_len = count($project_address);foreach ($project_address as $key => $pro_data){    if($project_count == $project_len - 1) {        $comm='';    }else{        $comm=',';    }    $project_string_val.="'".$pro_data."'".$comm;    $project_count++;}//organisation list$organisation_data = array_unique($organisation_col);$final_data = implode(',',$organisation_data);$org_string_val='';$org_count = 0;$org_len = count($organisation_data);foreach ($organisation_data as $key => $org_data){    if($org_count == $org_len - 1) {        $comm='';    }else{        $comm=',';    }    $org_string_val.="'".$org_data."'".$comm;    $org_count++;}//select tenant id$tenantSql = "SELECT `tenantId` FROM `xero_tenants` WHERE tenantName IN ($org_string_val)";$tenantRes = $wpdb->get_results($tenantSql,ARRAY_A);$exp_filter_sql='';$tenant_count = 0;$tenant_len = count($tenantRes);foreach ($tenantRes as $key => $ten_data){    $ten_data = $ten_data['tenantId'];    if($tenant_count == $tenant_len - 1) {        $comm='';    }else{        $comm=',';    }    $ten_string_val.="'".$ten_data."'".$comm;    $tenant_count++;}//checking user role$user = new WP_User($current_custom_user);if(!empty($user) && $user){    if(wp_sprintf_l( '%l', $user->roles ) == 'administrator'){        $canShowUnCat = true;        $bank_filter_sql = '';        $exp_filter_sql = 'WHERE (category_options.Name IS NULL AND bank_feed.Amount<=0) OR (category_options.Name IS NOT NULL)';    }else{        if($ten_string_val){            $canShowUnCat = true;        }else{            $canShowUnCat = false;        }        $bank_filter_sql = "WHERE bank_feed.TenantId IN ($ten_string_val)";        $exp_filter_sql = "WHERE bank_feed.TenantId IN ($ten_string_val) AND (category_options.Name IS NULL AND bank_feed.Amount<=0) OR (category_options.Name IS NOT NULL)";        if(count($organisation_data)<=0){            $show_menu = false;        }    }}// Bank Feed$bank_sql = "SELECT category_options.Name as 'Option', bank_feed.Date,bank_feed.Reference, ABS(bank_feed.Amount) as Total, bank_feed.Amount as Original_Total,bank_feed.Reconciled,bank_feed.Balance, month(bank_feed.Date) as date_month, year(bank_feed.Date) as date_year FROM xero_expense AS expense RIGHT JOIN xero_expense_lineitem as lineitem ON lineitem.BankTransactionID = expense.BankTransactionID RIGHT JOIN xero_expense_item_tracking as item_tracking ON item_tracking.LineItemID = lineitem.LineItemID RIGHT JOIN xero_tracking_category_options as category_options ON category_options.TrackingOptionID = item_tracking.TrackingOptionIDRIGHT JOIN xero_bank_feed as bank_feed ON (expense.Reference = '' and convert(bank_feed.Date,DATE) = convert(expense.Date,DATE) and ABS(bank_feed.Amount) = expense.Total) or (bank_feed.Reference = expense.Reference AND convert(bank_feed.Date,DATE) = convert(expense.Date,DATE)) $bank_filter_sql";//var_dump($bank_sql);$bank_feed = $wpdb->get_results($bank_sql);$templateData = array();// Expense Summary$exp_sql =  "SELECTcategory_options.Name as name,SUM(bank_feed.Amount) as CountValue FROM xero_expense AS expense RIGHT JOIN xero_expense_lineitem as lineitem ON lineitem.BankTransactionID = expense.BankTransactionID RIGHT JOIN xero_expense_item_tracking as item_tracking ON item_tracking.LineItemID = lineitem.LineItemIDRIGHT JOIN xero_tracking_category_options as category_options ON category_options.TrackingOptionID = item_tracking.TrackingOptionID RIGHT JOIN xero_bank_feed as bank_feed ON (expense.Reference = '' and convert(bank_feed.Date,DATE) = convert(expense.Date,DATE) and ABS(bank_feed.Amount) = expense.Total) or (bank_feed.Reference = expense.Reference AND convert(bank_feed.Date,DATE) = convert(expense.Date,DATE))$exp_filter_sqlGROUP BY category_options.Name";$val = "SELECT category_options.Name as name, SUM(bank_feed.Amount) as CountValue FROM xero_expense AS expense RIGHT JOIN xero_expense_lineitem as lineitem ON lineitem.BankTransactionID = expense.BankTransactionID RIGHT JOIN xero_expense_item_tracking as item_tracking ON item_tracking.LineItemID = lineitem.LineItemID RIGHT JOIN xero_tracking_category_options as category_options ON category_options.TrackingOptionID = item_tracking.TrackingOptionID RIGHT JOIN xero_bank_feed as bank_feed ON (expense.Reference = '' and convert(bank_feed.Date,DATE) = convert(expense.Date,DATE) and ABS(bank_feed.Amount) = expense.Total) or (bank_feed.Reference = expense.Reference AND convert(bank_feed.Date,DATE) = convert(expense.Date,DATE)) WHERE (category_options.Name IS NULL AND bank_feed.Amount<=0) OR (category_options.Name IS NOT NULL) GROUP BY category_options.Name";$result = $wpdb->get_results($exp_sql);//var_dump($exp_sql);foreach ($bank_feed as $bank_feed_key => $bank_feed_value ){    $templateData[$bank_feed_value->date_year][$bank_feed_value->date_month][] = $bank_feed_value;}?>    <div class="main-container" style="background-image: url(<?php the_field('header_background'); ?>)">        <div class="wrapper overflow main_projects">            <main role="main">                <div class="tabs project_tabs main_menu">                    <ul id="tabs">                        <li>                            <a id="tab1">                                <h2 class="title wow animated fadeIn">                                    <?php echo $current_title; ?>                                </h2>                            </a>                        </li>                        <?php if($show_menu){?>                        <li>                            <a id="tab2">                                <div class="title wow animated fadeIn">                                    <p>Bank Feed</p>                                </div>                            </a>                        </li>                        <li>                            <div class="main_menu wow animated fadeIn">                                <ul>                                    <li class="dropdown">                                        <p>Expense Summary &#9662;</p>                                        <div class="dropdown-menu">                                            <div class="list_top_section">                                                <span class="pro_title">Project</span>                                                <span class="pro_spend">Spend</span>                                            </div>                                            <ul>                                                <?php                                                $s = 0;                                                $uncat = false;                                                $uncatCheck = false;                                                $uncatValue = 0;                                                $len = count($result);                                                if($result){                                                    foreach ($result as $key => $values ){                                                        if($values->name == '' || $values->name == NULL){                                                            $uncat = false;                                                            break;                                                        }else if($s == $len - 1){                                                            $uncat = true;                                                        }                                                        ?>                                                        <?php $s++; }}?>                                                <?php                                                $m = 0;                                                if($result){                                                    foreach ($result as $key => $values ){                                                        $totVal +=$values->CountValue;                                                        if(!$values->name){                                                            //$uncatValue = $values->CountValue;                                                            if($values->CountValue >= 0){                                                                $uncatValue = '('.number_format($values->CountValue, 2, '.', ',').')';                                                            }else{                                                                $uncatValue = str_replace("-","",number_format($values->CountValue,2,'.',','));                                                            }                                                            $uncatCheck = true;                                                        }                                                        ?>                                                        <?php if($values->name){                                                            if($values->CountValue <= 0){                                                                $CountDataVal = str_replace("-","",number_format($values->CountValue,2,'.',','));                                                            }else{                                                                $CountDataVal = '('.number_format($values->CountValue, 2, '.', ',').')';                                                            }                                                            ?>                                                        <li class="items_inner">                                                            <span class="pro_title"><?php echo $values->name;?></span>                                                            <span class="pro_spend"><?php echo $CountDataVal? '$ '. $CountDataVal : '$ 0.00'; ?></span>                                                        </li>                                                        <?php } ?>                                                        <?php if($uncat == true && $canShowUnCat){                                                            $uncat = false; ?>                                                            <li class="items_inner">                                                                <span class="pro_title">General</span>                                                                <span class="pro_spend">$ 0.00</span>                                                            </li>                                                        <?php } ?>                                                        <?php $m++; }} ?>                                                        <?php if($uncatCheck == true && $canShowUnCat){                                                            $uncatCheck = true; ?>                                                            <li class="items_inner">                                                                <span class="pro_title">General</span>                                                                <span class="pro_spend"><?php echo $uncatValue? '$ '. $uncatValue: '$ 0.00'; ?></span>                                                            </li>                                                        <?php } ?>                                            </ul>                                            <div class="list_bm_section">                                                <span class="pro_title">Total Spend</span>                                                <span class="pro_spend"><?php echo $totVal ? '$ '. str_replace("-","",number_format($totVal,2,'.',',')): '$ 0.00' ; ?></span>                                            </div>                                        </div>                                    </li>                                </ul>                            </div>                        </li>                        <?php } ?>                    </ul>                    <div class="container" id="tab1C"><?php get_template_part('loop-clients'); ?></div>                    <div class="container" id="tab2C">                        <?php                        if(count($templateData)){ ?>                            <div class="panel panel-default list_table">                                <div class="panel-body">                                    <table class="table table-condensed">                                        <thead>                                        <tr>                                            <th style="text-align:left;width:10%;">Date</th>                                            <th style="text-align:left;width:11%;">Project</th>                                            <th style="text-align:left;width:35%;">Reference</th>                                            <th style="text-align:center;">Debit</th>                                            <th style="text-align:center;">Credit</th>                                            <th style="text-align:center;">Balance</th>                                            <th style="text-align:right;">Status</th>                                        </tr>                                        </thead>                                        <tbody>                                        <?php                                        $total_balance = 0;                                        $year_count = 0;                                        foreach ($templateData as $year => $months ){                                            $mounth_count = 0;                                            ksort($months);                                            foreach (array_reverse($months,true) as $month => $listDatas){                                                ksort($listDatas);                                                $dateObj   = DateTime::createFromFormat('!m', $month);                                                $monthName = $dateObj->format('M');                                                $cur_month = date('n');                                                $cur_year = date('Y');                                                ?>                                                <tr>                                                    <td colspan="12" class="main_head_bg">                                                        <div role="button" data-toggle="collapse" href="#list_<?php echo $year.'_'.$month?>"                                                             class="accordion-toggle collapsed" aria-expanded="<?php if(($cur_month == $month) && ($cur_year == $year)){echo 'true';}else{echo 'false';} ?>">                                                            <span class="text_right"><?php echo $monthName, ' ', $year; ?></span>                                                        </div>                                                    </td>                                                </tr>                                                <tr>                                                    <td colspan="12" class="hiddenRow">                                                        <div class="accordian-body collapse <?php if(($cur_month == $month) && ($cur_year == $year)){echo 'show';} ?>" id="list_<?php echo $year.'_'.$month?>">                                                            <table class="table">                                                                <tbody>                                                                <?php//                                                                for($i=count($listDatas)-1; $i>=0; $i=$i-1){                                                                  foreach($listDatas as $listData){//                                                                    $listData = $listDatas[$i];//                                                                    if(($i == count($listDatas)-1) && ($year_count==0) && ($mounth_count==0)){//                                                                        $total_balance+=$listData->Balance;//                                                                    }                                                                    ?>                                                                    <tr>                                                                        <td style="text-align:left;width:10%;">                                                                            <?php                                                                            $date=date_create($listData->Date);                                                                            echo date_format($date,"d M Y") ? date_format($date,"d M Y") : '';                                                                            ?>                                                                        </td>                                                                        <td style="text-align:left;width:11%;"><?php echo $listData->Option;?> </td>                                                                        <td style="text-align:left;width:35%;"><?php echo $listData->Reference;?> </td>                                                                        <td style="text-align:right;">                                                                            <?php if ($listData->Original_Total < 0 ){                                                                                echo $listData->Total ? '$' . number_format($listData->Total, 2, '.', ',') : '$0'; ?>                                                                            <?php } ?>                                                                        </td>                                                                        <td style="text-align:right;">                                                                            <?php if ($listData->Original_Total >= 0){                                                                                echo $listData->Total ? '$' . number_format($listData->Total, 2, '.', ',') : '$0'; ?>                                                                            <?php } ?>                                                                        </td>                                                                        <td style="text-align:right;">                                                                            <?php                                                                            echo $listData->Balance ? '$' . number_format($listData->Balance, 2, '.', ',') : '$0';                                                                            ?>                                                                        </td>                                                                        <td style="text-align:right;" class="<?php echo $listData->Reconciled == 'Yes' ? 'recon ':'unrecon' ?>">                                                                            <?php                                                                            echo $listData->Reconciled == 'Yes' ? 'Reconciled ':'Unreconciled';                                                                            ?>                                                                        </td>                                                                    </tr>                                                                <?php } ?>                                                                </tbody>                                                            </table>                                                        </div>                                                    </td>                                                </tr>                                                <?php $mounth_count++; }                                                $year_count++;                                        }                                        ?>                                        <!--<tr class="amount_cal">                                            <td></td>                                            <td></td>                                            <td style="width:35%"></td>                                            <td></td>                                            <td style="text-align:right;"><p class="amount_cal_style_left">Closing Balance</p></td>                                            <td style="text-align:right;">                                                <p class="amount_cal_style_right"><?php /*echo $total_balance? '$' . $total_balance : '$0';*/?></p>                                            </td>                                            <td></td>                                        </tr>-->                                        </tbody>                                    </table>                                </div>                            </div>                        <?php }else{ ?>                            <p class="bank_feed_not_found">Bank feed data not available for your account.</p>                        <?php }?>                    </div>                </div>            </main>        </div>    </div>    <script>        jQuery(document).ready(function(){            jQuery(".main_menu .dropdown").click(function () {                jQuery(this).find(".dropdown-menu").toggle('slow');            });            jQuery(document).on("click", function(event){                var $trigger = jQuery(".dropdown");                if($trigger !== event.target && !$trigger.has(event.target).length){                    jQuery(this).find(".dropdown-menu").fadeOut(1000);                }            });            jQuery('#tabs li:first-child a').addClass('isActive');            jQuery('#tabs li a:not(:first)').addClass('inactive');            jQuery('.container').hide();            jQuery('.container:first').show();            jQuery('#tabs li a').click(function(){                var t = jQuery(this).attr('id');                if(jQuery(this).hasClass('inactive')){ //this is the start of our condition                    jQuery('#tabs li a').addClass('inactive');                    jQuery('#tabs li a').removeClass('isActive');                    jQuery(this).removeClass('inactive');                    jQuery(this).addClass('isActive');                    jQuery('.container').hide();                    jQuery('#'+ t + 'C').fadeIn('slow');                }            });        });    </script>    <style>        .dropdown-menu ul::-webkit-scrollbar-track {            background-color: white;        }        .dropdown-menu ul::-webkit-scrollbar {            width: 12px;            background-color:white;        }        .dropdown-menu ul::-webkit-scrollbar-thumb{            border-radius: 10px;            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);            background-color: #bbb;        }        .main_menu .dropdown .dropdown-menu{            box-shadow: 2px 2px 4px 0px rgba(0,0,0,0.3);        }        .amount_cal_style_right{            margin-right: 11px !important;        }        p.bank_feed_not_found {            margin-bottom: 0;            padding: 10px;            border: 1px solid #eee;            background-color: #eee;            border-radius: 5px;        }        .project_tabs p {            font-size: 15px;        }    </style>    <script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script><?php get_footer(); ?>