<?php

namespace WP_Business_Reviews_Bundle\Includes;

class View {

    public function render($businesses, $reviews, $options) {
        ob_start();

        $max_width = $options->max_width;
        if (is_numeric($max_width)) {
            $max_width = $max_width . 'px';
        }

        $max_height = $options->max_height;
        if (is_numeric($max_height)) {
            $max_height = $max_height . 'px';
        }

        ?>
        <div class="rplg"<?php if (strlen($options->schema_rating) > 0) { ?> itemscope="" itemtype="http://schema.org/LocalBusiness"<?php } ?> style="<?php if (strlen($max_width) > 0) { ?>width:<?php echo $max_width;?>!important;<?php } ?><?php if (strlen($max_height) > 0) { ?>height:<?php echo $max_height;?>!important;overflow-y:auto!important;<?php } ?><?php if ($options->centred) { ?>margin:0 auto!important;<?php } ?>">
        <?php
            switch ($options->view_mode) {
                case 'list':
                    $this->render_list($businesses, $reviews, $options);
                    break;
                 case 'list_thin':
                    $this->render_list_thin($businesses, $reviews, $options);
                    break;
                case 'grid4':
                    $this->render_grid($businesses, $reviews, $options, 4);
                    break;
                case 'grid3':
                    $this->render_grid($businesses, $reviews, $options, 3);
                    break;
                case 'grid2':
                    $this->render_grid($businesses, $reviews, $options, 2);
                    break;
                case 'slider':
                    $this->render_slider($businesses, $reviews, $options);
                    break;
                default:
                    $this->render_badge2($businesses, $reviews, $options);
            }
        ?>
        </div>
        <?php
        return preg_replace('/[\n\r]|(>)\s+(<)/', '$1$2', ob_get_clean());
    }

    private function render_list($businesses, $reviews, $options) {
        ?>
        <div class="rplg-list2<?php if ($options->dark_theme) { ?> rplg-dark<?php } ?>">
            <div class="rplg-businesses">
                <?php
                foreach ($businesses as $business) {
                    $this->business($business, $options);
                }
                ?>
            </div>
            <div class="rplg-reviews">
                <?php
                $hide_review = false;
                if (count($reviews) > 0) {
                    $i = 0;
                    foreach ($reviews as $review) {
                        if ($options->pagination > 0 && $options->pagination <= $i++) {
                            $hide_review = true;
                        }
                        $this->review(
                            $review,
                            $options->hide_avatar,
                            $options->text_size,
                            $options->disable_user_link,
                            $options->hide_name,
                            $options->short_last_name,
                            $options->disable_review_time,
                            $options->open_link,
                            $options->nofollow_link,
                            $options->reviewer_avatar_size,
                            $options->lazy_load_img,
                            true,
                            $hide_review
                        );
                    }
                }
                ?>
            </div>
            <?php
            if ($options->pagination > 0 && $hide_review) {
                $this->anchor('#', 'rplg-url', __('Next Reviews', 'brb'), false, false, 'return rplg_next_reviews.call(this, ' . $options->pagination . ');');
            }
            ?>
        </div>
        <?php
        $this->js_loader('rplg_init_list_theme');
    }

    private function render_list_thin($businesses, $reviews, $options) {
        ?>
        <div class="rplg-list<?php if ($options->dark_theme) { ?> rplg-dark<?php } ?>">
            <div class="rplg-businesses">
                <?php
                foreach ($businesses as $business) {
                    $this->business_thin($business, $options);
                }
                ?>
            </div>
            <?php if (count($businesses) > 0) { ?><div class="rplg-hr2"></div><?php } ?>
            <div class="rplg-reviews">
                <?php
                $hide_review = false;
                if (count($reviews) > 0) {
                    $i = 0;
                    foreach ($reviews as $review) {
                        if ($options->pagination > 0 && $options->pagination <= $i++) {
                            $hide_review = true;
                        }
                        $this->review_thin(
                            $review,
                            $options->hide_avatar,
                            $options->text_size,
                            $options->disable_user_link,
                            $options->hide_name,
                            $options->short_last_name,
                            $options->disable_review_time,
                            $options->open_link,
                            $options->nofollow_link,
                            $options->reviewer_avatar_size,
                            $options->lazy_load_img,
                            true,
                            $hide_review
                        );
                    }
                }
                ?>
            </div>
            <?php
            if ($options->pagination > 0 && $hide_review) {
                $this->anchor('#', 'rplg-url', __('Next Reviews', 'brb'), false, false, 'return rplg_next_reviews.call(this, ' . $options->pagination . ');');
            }
            ?>
        </div>
        <?php
        $this->js_loader('rplg_init_list_theme');
    }

    private function render_grid($businesses, $reviews, $options, $column_default = 4) {
        ?>
        <div class="rplg-grid<?php if ($options->dark_theme) { ?> rplg-dark<?php } ?>">
            <?php
            $count = count($businesses);
            if ($count > 0 && $businesses[0]->provider == 'summary') {
                ?>
                <div class="rplg-grid-row rplg-businesses">
                    <div class="rplg-col rplg-col-12">
                        <?php
                        $this->business($businesses[0], $options);
                        array_shift($businesses);
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="rplg-grid-row rplg-businesses">
                <?php
                switch ($count) {
                    case 1:
                        $col = 12;
                        break;
                    case 2:
                    case 4:
                        $col = 6;
                        break;
                    case 3:
                        $col = 3;
                        break;
                    default:
                        $col = $column_default;
                }
                if ($count > 0) {
                    foreach ($businesses as $business) {
                        $col_class = 'rplg-col-' . $col;
                        ?><div class="rplg-col <?php echo $col_class; ?>"><?php
                        $this->business($business, $options);
                        ?></div><?php
                    }
                }
                ?>
            </div>
            <div class="rplg-grid-row rplg-reviews">
                <?php
                $count = count($reviews);
                switch ($count) {
                    case 1:
                        $col = 12;
                        break;
                    case 2:
                        $col = 6;
                        break;
                    default:
                        $col = $column_default;
                }
                $hide_review = false;
                if ($count > 0) {
                    $i = 0;
                    foreach ($reviews as $review) {
                        $col_class = 'rplg-col-' . $col;
                        if ($options->pagination > 0 && $options->pagination <= $i++) {
                            $hide_review = true;
                        }
                        ?><div class="rplg-col <?php echo $col_class; if ($hide_review) { ?> rplg-hide<?php } ?>"><?php
                        $this->review(
                            $review,
                            $options->hide_avatar,
                            $options->text_size,
                            $options->disable_user_link,
                            $options->hide_name,
                            $options->short_last_name,
                            $options->disable_review_time,
                            $options->open_link,
                            $options->nofollow_link,
                            $options->reviewer_avatar_size,
                            $options->lazy_load_img
                        );
                        ?></div><?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
        if ($options->pagination > 0 && $hide_review) {
            $this->anchor('#', 'rplg-url', __('Next Reviews', 'brb'), false, false, 'return rplg_next_reviews.call(this, ' . $options->pagination . ');');
        }
        $this->js_loader('rplg_init_grid_theme');
    }

    private function render_slider($businesses, $reviews, $options) {
        ?>
        <?php if (count($businesses)) { ?>
        <div class="rplg-grid<?php if ($options->dark_theme) { ?> rplg-dark<?php } ?>">
            <?php
            if ($businesses[0]->provider == 'summary') {
                ?>
                <div class="rplg-grid-row rplg-businesses">
                    <div class="rplg-col rplg-col-12">
                        <?php
                        $this->business($businesses[0], $options);
                        array_shift($businesses);
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="rplg-grid-row rplg-businesses">
                <?php
                $count = count($businesses);
                switch ($count) {
                    case 1:
                        $col = 12;
                        break;
                    case 2:
                    case 4:
                        $col = 6;
                        break;
                    case 3:
                        $col = 3;
                        break;
                    default:
                        $col = 3;
                }
                if ($count > 0) {
                    foreach ($businesses as $business) {
                        $col_class = 'rplg-col-' . $col;
                        ?><div class="rplg-col <?php echo $col_class; ?>"><?php
                        $this->business($business, $options);
                        ?></div><?php
                    }
                }
                ?>
            </div>
        </div>
        <?php } ?>
        <div class="rplg-slider<?php if ($options->dark_theme) { ?> rplg-dark<?php } ?>">
            <div class="rplgsw-container">
                <div class="rplgsw-wrapper">
                    <?php foreach ($reviews as $review) { ?>
                    <div class="rplgsw-slide">
                        <?php $this->slider_review(
                            $review,
                            $options->hide_avatar,
                            $options->text_size,
                            $options->disable_user_link,
                            $options->hide_name,
                            $options->short_last_name,
                            $options->disable_review_time,
                            $options->open_link,
                            $options->nofollow_link,
                            $options->reviewer_avatar_size,
                            $options->lazy_load_img,
                            $options->slider_review_height
                        ); ?>
                    </div>
                    <?php } ?>
                </div>
                <?php if (!$options->slider_hide_pagin) { ?>
                <div class="rplgsw-pagination"></div>
                <?php } ?>
            </div>
            <?php if (!$options->slider_hide_nextprev) { ?>
            <div class="rplg-slider-prev"><span>&lsaquo;</span></div>
            <div class="rplg-slider-next"><span>&rsaquo;</span></div>
            <?php } ?>
        </div>
        <?php
        $this->js_loader('rplg_init_slider_theme', json_encode(
            array(
                'speed'             => ($options->slider_speed             ? $options->slider_speed              : 5) * 1000,
                'effect'            => $options->slider_effect             ? $options->slider_effect             : 'slide',
                'count'             => $options->slider_count              ? $options->slider_count              : 3,
                'space'             => $options->slider_space_between      ? $options->slider_space_between      : 40,
                'pagin'             => !$options->slider_hide_pagin        || true,
                'nextprev'          => !$options->slider_hide_nextprev     || true,
                'mobileBreakpoint'  => $options->slider_mobile_breakpoint  ? $options->slider_mobile_breakpoint  : 500,
                'mobileCount'       => $options->slider_mobile_count       ? $options->slider_mobile_count       : 1,
                'tabletBreakpoint'  => $options->slider_tablet_breakpoint  ? $options->slider_tablet_breakpoint  : 800,
                'tabletCount'       => $options->slider_tablet_count       ? $options->slider_tablet_count       : 2,
                'desktopBreakpoint' => $options->slider_desktop_breakpoint ? $options->slider_desktop_breakpoint : 1024,
                'desktopCount'      => $options->slider_desktop_count      ? $options->slider_desktop_count      : 3
            )
        ));
    }

    private function render_badge($businesses, $reviews, $options) {
        ?>
        <div class="rplg-badge-cnt
                    <?php if ($options->view_mode != 'badge_inner') { ?> rplg-<?php echo $options->view_mode; ?>-fixed<?php } ?>
                    <?php if ($options->badge_center) { ?> rplg-badge-center<?php } ?>
                    <?php if ($options->hide_float_badge) { ?> rplg-badge-hide<?php } ?>
        ">
            <?php foreach ($businesses as $business) { ?>
            <div
                class="rplg-badge
                    <?php if ($options->badge_display_block) { ?>rplg-badge-block<?php } ?>
                    <?php if ($options->badge_click) { ?>rplg-badge-clickable<?php } ?>
                "
                <?php
                    if (strlen($options->badge_space_between) > 0) {
                        $space = $options->badge_space_between;
                        if (is_numeric($space)) {
                            $space = $space . 'px';
                        }
                ?>style="margin:0 <?php echo $space . ' ' . $space; ?> 0!important;"<?php
                    }
                    if ($business->provider != 'summary') {
                        if ($options->badge_click == 'reviews') {
                ?>onclick="window.open('<?php echo $this->get_allreview_url($business); ?>', '_blank');"<?php
                        }
                        if ($options->badge_click == 'writereview') {
                ?>onclick="_rplg_popup('<?php echo $this->get_writereview_url($business); ?>', 800, 600)"<?php
                        }
                    }
                ?>
                data-provider="<?php echo $business->provider; ?>"
            >
                <?php
                $rich_snippets = false;
                $business_name = $business->name;
                $business_photo = '';
                if ($options->schema_rating && $options->schema_rating == $business->id) {
                    $this->render_schema_fields($options);
                    $rich_snippets = true;
                    $business_name = '<span itemprop="name">' . $business_name . '</span>';
                    $business_photo = '<meta itemprop="image" content="' . ($this->correct_url_proto($business->photo)) . '" name="' . $business->name . '"/>';
                }
                ?>
                <div class="rplg-badge-btn">
                    <div class="rplg-row">
                        <?php if (!$options->header_hide_photo) { ?>
                        <div class="rplg-row-left">
                            <div class="rplg-badge-logo">
                            <?php
                            switch ($business->provider) {
                                case 'summary':
                                    $this->image($business->photo, $business->name, $options->lazy_load_img);
                                    break;
                                case 'google':
                                    $this->google_logo();
                                    break;
                                case 'facebook':
                                    $this->facebook_logo();
                                    break;
                                case 'yelp':
                                    $this->yelp_logo2();
                                    break;
                            }
                            echo $business_photo;
                            ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="rplg-row-right rplg-trim">
                            <?php
                            if (!$options->header_hide_name) { echo $business_name; }
                            $this->render_rating($business, $options, $rich_snippets);
                            ?>
                        </div>
                    </div>
                    <?php if ($business->provider != 'summary' &&  (!$options->header_hide_seeall || !$options->header_hide_write)) { ?>
                    <button class="rplg-badge-menu" onclick="this.nextSibling.style.display=(this.nextSibling.style.display=='none'?'block':'none');return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                          <g fill="none" fill-rule="evenodd">
                            <circle cx="6" cy="3" r="1" fill="#000"/>
                            <circle cx="6" cy="6" r="1" fill="#000"/>
                            <circle cx="6" cy="9" r="1" fill="#000"/>
                          </g>
                        </svg>
                    </button>
                    <div class="rplg-badge-actions" style="display:none">
                        <?php $this->render_action_links($business, $options, true); ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
        $this->js_loader('rplg_init_badge_theme');
    }

    private function render_badge2($businesses, $reviews, $options) {
        ?>
        <div class="rplg-badge-cnt
                    <?php if ($options->view_mode != 'badge_inner') { ?> rplg-<?php echo $options->view_mode; ?>-fixed<?php } ?>
                    <?php if ($options->badge_center) { ?> rplg-badge-center<?php } ?>
                    <?php if ($options->hide_float_badge) { ?> rplg-badge-hide<?php } ?>
        ">
            <?php foreach ($businesses as $business) { ?>
            <div class="rplg-badge2<?php if ($options->badge_display_block) { ?> rplg-badge-block<?php } ?>"
                <?php
                    if (strlen($options->badge_space_between) > 0) {
                        $space = $options->badge_space_between;
                        if (is_numeric($space)) {
                            $space = $space . 'px';
                        }
                ?>style="margin:0 <?php echo $space . ' ' . $space; ?> 0!important;"<?php
                    }
                    if ($business->provider != 'summary') {
                        if ($options->badge_click == 'reviews') {
                ?>onclick="window.open('<?php echo $this->get_allreview_url($business); ?>', '_blank');return false;"<?php
                        }
                        if ($options->badge_click == 'writereview') {
                ?>onclick="_rplg_popup('<?php echo $this->get_writereview_url($business); ?>', 800, 600);return false;"<?php
                        }
                    }
                ?>
                data-provider="<?php echo $business->provider; ?>"
            >
                <div class="rplg-badge2-border"></div>
                <?php
                $rich_snippets = false;
                if ($options->schema_rating && $options->schema_rating == $business->id) {
                    echo '<meta itemprop="name" content="' . $business->name . '">' .
                         '<meta itemprop="image" content="' . ($this->correct_url_proto($business->photo)) . '" name="' . $business->name . '"/>';
                    $this->render_schema_fields($options);
                    $rich_snippets = true;
                }
                ?>
                <div class="rplg-badge2-btn<?php if ($options->badge_click != 'disable') {?> rplg-badge2-clickable<?php } ?>">
                    <?php
                    $provider_name = ucfirst($business->provider);
                    switch ($business->provider) {
                        case 'summary':
                            $this->image($business->photo, $business->name, $options->lazy_load_img);
                            $provider_name = 'Social';
                            break;
                        case 'google':
                            $this->google_logo();
                            break;
                        case 'facebook':
                            $this->facebook_logo();
                            break;
                        case 'yelp':
                            $this->yelp_logo2();
                            break;
                    }
                    ?>
                    <div class="rplg-badge2-score">
                        <div><?php printf(esc_html__('%s Rating', 'brb'), $provider_name); ?></div>
                        <?php $this->render_rating($business, $options, $rich_snippets); ?>
                    </div>
                </div>
                <?php if ($options->badge_click == 'sidebar') { ?>
                <div class="rplg-form <?php if ($options->view_mode == 'badge_left') { ?>rplg-form-left<?php } ?>" style="display:none">
                    <div class="rplg-form-head">
                        <div class="rplg-form-head-inner">
                            <div class="rplg-row">
                                <?php if (!$options->header_hide_photo) { ?>
                                <div class="rplg-row-left">
                                    <?php $this->image($business->photo, $business->name, $options->lazy_load_img); ?>
                                </div>
                                <?php } ?>
                                <div class="rplg-row-right rplg-trim">
                                    <?php
                                    echo $business->name;
                                    $this->render_rating($business, $options, false, false);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <button class="rplg-form-close" type="button" onclick="_rplg_get_parent(this, 'rplg-form').style.display='none'">×</button>
                    </div>
                    <div class="rplg-form-body"></div>
                    <div class="rplg-form-content">
                        <div class="rplg-form-content-inner">
                            <?php
                            $hide_review = false;
                            $i = 0;
                            foreach ($reviews as $review) {
                                if ($review->provider == $business->provider || $business->provider == 'summary') {
                                    if ($options->pagination > 0 && $options->pagination <= $i++) {
                                        $hide_review = true;
                                    }
                            ?>
                            <div class="rplg-form-review <?php if ($hide_review) { ?> rplg-hide<?php } ?>">
                                <div class="rplg-row rplg-row-start">
                                    <?php if (!$options->hide_avatar) { ?>
                                    <div class="rplg-row-left">
                                        <?php $this->author_avatar($review, $options->reviewer_avatar_size, $options->lazy_load_img); ?>
                                    </div>
                                    <?php } ?>
                                    <div class="rplg-row-right">
                                        <?php
                                        $this->author_name($review, $options->disable_user_link, $options->hide_name, $options->short_last_name, $options->open_link, $options->nofollow_link);
                                        $this->review_time($review, $options->disable_review_time);
                                        ?>
                                        <div class="rplg-box-content">
                                            <?php $this->stars($review->rating, $review->provider); ?>
                                            <span class="rplg-review-text"><?php $this->trim_text($review->text, $options->text_size); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            }
                            if ($options->pagination > 0 && $hide_review) {
                                $this->anchor('#', 'rplg-url', __('Next Reviews', 'brb'), false, false, 'return rplg_next_reviews.call(this, ' . $options->pagination . ');');
                            }
                            $this->render_action_links($business, $options);
                            ?>
                        </div>
                    </div>
                    <div class="rplg-form-footer">

                        <?php
                        switch ($business->provider) {
                            case 'summary':
                                ?><div class="rplg-powered"></div><?php
                                break;
                            case 'google':
                                ?><img src="<?php echo BRB_ASSETS_URL; ?>img/powered_by_google_on_white.png" alt="powered by Google"><?php
                                break;
                            case 'facebook':
                                ?><div class="rplg-powered rplg-facebook-powered">powered by <span>Facebook</span></div><?php
                                break;
                            case 'yelp':
                                ?><div class="rplg-powered rplg-yelp-logo">powered by <?php echo $this->anchor($business->url, '', '<img src="' . BRB_ASSETS_URL . 'img/yelp-logo.png" alt="Yelp logo">', $options->open_link, $options->nofollow_link); ?></div><?php
                                break;
                        }
                        ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php
        $this->js_loader('rplg_init_badge_theme');
    }

    private function business($business, $options) {
        $hide_photo    = $options->header_hide_photo;
        $hide_name     = $options->header_hide_name;
        $hide_count    = $options->header_hide_count;
        $open_link     = $options->open_link;
        $nofollow_link = $options->nofollow_link;
        $lazy_load_img = $options->lazy_load_img;

        $rich_snippets = false;
        $business_name = $business->name;
        $business_photo = '';
        if ($options->schema_rating && $options->schema_rating == $business->id) {
            $this->render_schema_fields($options);
            $rich_snippets = true;
            $business_name = '<span itemprop="name">' . $business_name . '</span>';
            $business_photo = '<meta itemprop="image" content="' . ($this->correct_url_proto($business->photo)) . '" name="' . $business->name . '"/>';
        }
        ?>
        <div class="rplg-box">
            <div class="rplg-row">
                <?php if (!$hide_photo) { ?>
                <div class="rplg-row-left">
                    <?php $this->image($business->photo, $business->name, $lazy_load_img); echo $business_photo; ?>
                </div>
                <?php } ?>
                <div class="rplg-row-right">
                    <?php if (!$hide_name) { ?>
                    <div class="rplg-biz-name rplg-trim">
                        <?php $this->anchor($business->url, '', $business_name, $open_link, $nofollow_link); ?>
                    </div>
                    <?php
                    }
                    $this->render_rating($business, $options, $rich_snippets);
                    $this->render_action_links($business, $options);
                    ?>
                </div>
                <span class="rplg-review-badge"><?php $this->social_logo($business->provider); ?></span>
            </div>
        </div>
        <?php
    }

    private function business_thin($business, $options) {
        $hide_photo    = $options->header_hide_photo;
        $hide_name     = $options->header_hide_name;
        $hide_count    = $options->header_hide_count;
        $open_link     = $options->open_link;
        $nofollow_link = $options->nofollow_link;
        $lazy_load_img = $options->lazy_load_img;

        $rich_snippets = false;
        $business_name = $business->name;
        $business_photo = '';
        if ($options->schema_rating && $options->schema_rating == $business->id) {
            $this->render_schema_fields($options);
            $rich_snippets = true;
            $business_name = '<span itemprop="name">' . $business_name . '</span>';
            $business_photo = '<meta itemprop="image" content="' . ($this->correct_url_proto($business->photo)) . '" name="' . $business->name . '"/>';
        }
        ?>
        <div class="rplg-list-header">
            <div class="rplg-row rplg-row-start">
                <?php if (!$hide_photo) { ?>
                <div class="rplg-row-left">
                    <?php $this->image($business->photo, $business->name, $lazy_load_img); echo $business_photo; ?>
                    <span class="rplg-review-badge"><?php $this->social_logo($business->provider); ?></span>
                </div>
                <?php } ?>
                <div class="rplg-row-right">
                    <?php if (!$hide_name) { ?>
                    <div class="rplg-biz-name rplg-trim">
                        <?php $this->anchor($business->url, '', $business_name, $open_link, $nofollow_link); ?>
                    </div>
                    <?php
                    }
                    $this->render_rating($business, $options, $rich_snippets);
                    $this->render_action_links($business, $options);
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function render_schema_fields($options) {
        ?>
        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <meta itemprop="streetAddress" content="<?php echo $options->schema_address_street; ?>"/>
            <meta itemprop="addressLocality" content="<?php echo $options->schema_address_locality; ?>"/>
            <meta itemprop="addressRegion" content="<?php echo $options->schema_address_region; ?>"/>
            <meta itemprop="postalCode" content="<?php echo $options->schema_address_zip; ?>"/>
            <meta itemprop="addressCountry" content="<?php echo $options->schema_address_country; ?>"/>
        </span>
        <meta itemprop="priceRange" content="<?php echo $options->schema_price_range; ?>"/>
        <meta itemprop="telephone" content="<?php echo $options->schema_phone; ?>"/>
        <?php
    }

    private function render_rating($business, $options, $rich_snippets = false, $reviews_count = true) {
        $aggregate_rating = '';
        $rating_value = '';
        if ($rich_snippets) {
            $aggregate_rating  = 'itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating"';
            $rating_value = 'itemprop="ratingValue"';
        }
        if ($business->rating > 0) {
        ?>
        <div <?php echo $aggregate_rating; ?>>
            <div class="rplg-biz-rating rplg-trim rplg-biz-<?php echo $business->provider; ?>">
                <div class="rplg-biz-score" <?php echo $rating_value; ?>><?php echo $business->rating; ?></div>
                <?php $this->stars($business->rating, $business->provider, '#0caa41'); ?>
            </div>
            <?php
            if (!$options->header_hide_count && $reviews_count) {
                $this->render_based_on_reviews($business, $rich_snippets);
            }
            ?>
        </div>
        <?php
        } else {
        ?>
        <div>
            <div class="rplg-biz-rating rplg-trim rplg-biz-<?php echo $business->provider; ?>">
                <?php $this->stars($business->rating, $business->provider, '#0caa41'); ?>
            </div>
        </div>
        <?php
        }
    }

    private function render_based_on_reviews($business, $rich_snippets = false) {
        $review_count = isset($business->review_count_manual) && $business->review_count_manual > 0
            ? $business->review_count_manual : $business->review_count;

        if ($rich_snippets) {
            $review_count = '<span itemprop="ratingCount">' . $review_count . '</span>';
        }
        ?>
        <div class="rplg-biz-based rplg-trim">
            <span class="rplg-biz-based-text"><?php printf(esc_html__('Based on %s reviews', 'brb'), $review_count); ?></span>
            <?php if ($rich_snippets) { ?>
            <meta itemprop="bestRating" content="5"/>
            <?php } ?>
        </div>
        <?php
    }

    private function render_action_links($business, $options, $in_menu = false) {
        if ($business->provider != 'summary') {
        ?><div class="rplg-links"><?php
            if (!$options->header_hide_seeall) {
                $this->get_allreview_link($business, $in_menu);
            }
            if (!$options->header_hide_write) {
                $this->get_writereview_link($business, $in_menu);
            }
        ?></div><?php
        }
    }

    private function get_allreview_link($business, $in_menu = false) {
        ?><a href="<?php echo $this->get_allreview_url($business); ?>" target="_blank" onclick="<?php if ($in_menu) { ?>this.parentNode.parentNode.style.display='none';<?php } ?>return true;"><?php echo __('See all reviews', 'brb'); ?></a><?php
    }

    private function get_allreview_url($business) {
        switch ($business->provider) {
            case 'google':
                return 'https://search.google.com/local/reviews?placeid=' . $business->id;
            case 'facebook':
                return 'https://facebook.com/' . $business->id . '/reviews';
            case 'yelp':
                return $business->url;
        }
    }

    private function get_writereview_link($business, $in_menu = false) {
        ?><a href="javascript:void(0)" onclick="<?php if ($in_menu) { ?>this.parentNode.parentNode.style.display='none';<?php } ?>_rplg_popup('<?php echo $this->get_writereview_url($business); ?>', 800, 600)"><?php echo __('Write a review', 'brb'); ?></a><?php
    }

    private function get_writereview_url($business) {
        switch ($business->provider) {
            case 'google':
                return 'https://search.google.com/local/writereview?placeid=' . $business->id;
            case 'facebook':
                return 'https://facebook.com/' . $business->id . '/reviews';
            case 'yelp':
                return 'https://www.yelp.com/writeareview/biz/' . $business->id;
        }
    }

    private function review($review, $hide_avatar, $text_size, $disable_user_link, $hide_name, $short_last_name, $disable_review_time, $open_link, $nofollow_link, $reviewer_avatar_size, $lazy_load_img, $stars_in_body=false, $hide_review=false) {
        ?>
        <div class="rplg-box<?php if ($hide_review) { ?> rplg-hide<?php } ?>">
            <div class="rplg-row">
                <?php if (!$hide_avatar) { ?>
                <div class="rplg-row-left">
                    <?php $this->author_avatar($review, $reviewer_avatar_size, $lazy_load_img); ?>
                </div>
                <?php } ?>
                <div class="rplg-row-right">
                    <?php
                    $this->author_name($review, $disable_user_link, $hide_name, $short_last_name, $open_link, $nofollow_link);
                    if (!$stars_in_body) {
                        $this->stars($review->rating, $review->provider);
                    }
                    $this->review_time($review, $disable_review_time);
                    ?>
                </div>
            </div>
            <div class="rplg-box-content">
                <?php if ($stars_in_body) {
                    $this->stars($review->rating, $review->provider);
                } ?>
                <span class="rplg-review-text"><?php $this->trim_text($review->text, $text_size); ?></span>
                <span class="rplg-review-badge"><?php $this->social_logo($review->provider); ?></span>
            </div>
        </div>
        <?php
    }

    private function review_thin($review, $hide_avatar, $text_size, $disable_user_link, $hide_name, $short_last_name, $disable_review_time, $open_link, $nofollow_link, $reviewer_avatar_size, $lazy_load_img, $stars_in_body=false, $hide_review=false) {
        ?>
        <div class="rplg-list-review<?php if ($hide_review) { ?> rplg-hide<?php } ?>">
            <div class="rplg-row rplg-row-start">
                <?php if (!$hide_avatar) { ?>
                <div class="rplg-row-left">
                    <?php $this->author_avatar($review, $reviewer_avatar_size, $lazy_load_img); ?>
                    <span class="rplg-review-badge"><?php $this->social_logo($review->provider); ?></span>
                </div>
                <?php } ?>
                <div class="rplg-row-right">
                    <?php
                    $this->author_name($review, $disable_user_link, $hide_name, $short_last_name, $open_link, $nofollow_link);
                    if (!$stars_in_body) {
                        $this->stars($review->rating, $review->provider);
                    }
                    $this->review_time($review, $disable_review_time);
                    ?>
                    <?php if ($stars_in_body) {
                        $this->stars($review->rating, $review->provider);
                    } ?>
                    <span class="rplg-review-text"><?php $this->trim_text($review->text, $text_size); ?></span>
                </div>
            </div>
        </div>
        <?php
    }

    private function slider_review($review, $hide_avatar, $text_size, $disable_user_link, $hide_name, $short_last_name, $disable_review_time, $open_link, $nofollow_link, $reviewer_avatar_size, $lazy_load_img, $review_height) {
        ?>
        <div class="rplg-slider-review">
            <div class="rplg-box">
                <div class="rplg-box-content" <?php if (strlen($review_height) > 0) { echo 'style="height:'. $review_height .'!important"'; } ?>>
                    <?php $this->stars($review->rating, $review->provider); ?>
                    <span class="rplg-review-text"><?php $this->trim_text($review->text, $text_size); ?></span>
                    <span class="rplg-review-badge"><?php $this->social_logo($review->provider); ?></span>
                </div>
            </div>
            <div class="rplg-row">
                <?php if (!$hide_avatar) { ?>
                <div class="rplg-row-left">
                    <?php $this->author_avatar($review, $reviewer_avatar_size, $lazy_load_img); ?>
                </div>
                <?php } ?>
                <div class="rplg-row-right">
                    <?php
                    $this->author_name($review, $disable_user_link, $hide_name, $short_last_name, $open_link, $nofollow_link);
                    $this->review_time($review, $disable_review_time);
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function author_avatar($review, $reviewer_avatar_size, $lazy_load_img) {
        switch ($review->provider) {
            case 'google':
                $regexp = '/googleusercontent\.com\/([^\/]+)\/([^\/]+)\/([^\/]+)\/([^\/]+)\/photo\.jpg/';
                $matches = array();
                preg_match($regexp, $review->author_avatar, $matches, PREG_OFFSET_CAPTURE);
                if (count($matches) > 4 && $matches[3][0] == 'AAAAAAAAAAA') {
                    $review->author_avatar = str_replace('/photo.jpg', '/s128-c0x00000000-cc-rp-mo/photo.jpg', $review->author_avatar);
                }
                if (strlen($review->author_avatar) > 0) {
                    if (strpos($review->author_avatar, "s128") != false) {
                        $review->author_avatar = str_replace('s128', 's' . $reviewer_avatar_size, $review->author_avatar);
                    } else {
                        $review->author_avatar = str_replace('-mo', '-mo-s' . $reviewer_avatar_size, $review->author_avatar);
                    }
                }
                $default_avatar = BRB_GOOGLE_AVATAR;
                break;
            case 'facebook':
                $default_avatar = BRB_FACEBOOK_AVATAR;
                break;
            case 'yelp':
                if (strlen($review->author_avatar) > 0) {
                    $avatar_size = '';
                    if ($reviewer_avatar_size <= 128) {
                        $avatar_size = 'ms';
                    } else {
                        $avatar_size = 'o';
                    }
                    $review->author_avatar = str_replace('ms.jpg', $avatar_size . '.jpg', $review->author_avatar);
                }
                $default_avatar = BRB_YELP_AVATAR;
                break;
        }
        $author_avatar = strlen($review->author_avatar) > 0 ? $review->author_avatar : $default_avatar;
        $this->image($author_avatar, $review->author_name, $lazy_load_img, $default_avatar);
    }

    private function author_name($review, $disable_user_link, $hide_name, $short_last_name, $open_link, $nofollow_link) {
        if ($hide_name) {
            return;
        }

        if (strlen($review->author_name) > 0) {
            $author_name = $review->author_name;
            if ($short_last_name) {
                $names = explode(" ", $author_name);
                if (count($names) > 1) {
                    $last_index = count($names) - 1;
                    $last_name = $names[$last_index];
                    if (strlen($last_name) > 1) {
                        $last_char = function_exists('mb_substr') ? mb_substr($last_name, 0, 1, "UTF-8") : substr($last_name, 0, 1);
                        $last_name = (function_exists('mb_strtoupper') ? mb_strtoupper($last_char, "UTF-8") : strtoupper($last_char)) . ".";
                        $names[$last_index] = $last_name;
                        $author_name = implode(" ", $names);
                    }
                }
            }
        } else {
            $author_name = __(ucfirst($provider) . ' User', 'brb');
        }

        if (strlen($review->author_url) > 0 && !$disable_user_link) {
            $this->anchor($review->author_url, 'rplg-review-name rplg-trim', $author_name, $open_link, $nofollow_link, '', $author_name);
        } else {

            echo '<div class="rplg-review-name rplg-trim" title="' . $author_name . '">' . $author_name . '</div>';
        }
    }

    private function review_time($review, $disable_review_time) {
        if (!$disable_review_time) {
            ?><div class="rplg-review-time rplg-trim" data-time="<?php echo $review->time; ?>"><?php echo gmdate("H:i d M y", $review->time); ?></div><?php
        }
    }

    private function stars($rating, $provider = '', $color = '#777') {
        ?><div class="rplg-stars"><?php
        switch ($provider) {
            case 'google':
                $this->stars_simple($rating, '#e7711b');
                break;
            case 'facebook':
                $this->stars_simple($rating, '#3c5b9b');
                break;
            case 'yelp':
                $this->stars_yelp($rating);
                break;
             default:
                $this->stars_simple($rating, $color);
        }
        ?></div><?php
    }

    private function stars_simple($rating, $color) {
        foreach (array(1,2,3,4,5) as $val) {
            $score = $rating - $val;
            if ($score >= 0) {
                ?><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="17" height="17" viewBox="0 0 1792 1792"><path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="<?php echo $color; ?>"></path></svg><?php
            } elseif ($score > -1 && $score < 0) {
                if ($score < -0.75) {
                    ?><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="17" height="17" viewBox="0 0 1792 1792"><path d="M1201 1004l306-297-422-62-189-382-189 382-422 62 306 297-73 421 378-199 377 199zm527-357q0 22-26 48l-363 354 86 500q1 7 1 20 0 50-41 50-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="#ccc"></path></svg><?php
                } elseif ($score > -0.25) {
                    ?><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="17" height="17" viewBox="0 0 1792 1792"><path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="<?php echo $color; ?>"></path></svg><?php
                } else {
                    ?><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="17" height="17" viewBox="0 0 1792 1792"><path d="M1250 957l257-250-356-52-66-10-30-60-159-322v963l59 31 318 168-60-355-12-66zm452-262l-363 354 86 500q5 33-6 51.5t-34 18.5q-17 0-40-12l-449-236-449 236q-23 12-40 12-23 0-34-18.5t-6-51.5l86-500-364-354q-32-32-23-59.5t54-34.5l502-73 225-455q20-41 49-41 28 0 49 41l225 455 502 73q45 7 54 34.5t-24 59.5z" fill="<?php echo $color; ?>"></path></svg><?php
                }
            } else {
                ?><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="17" height="17" viewBox="0 0 1792 1792"><path d="M1201 1004l306-297-422-62-189-382-189 382-422 62 306 297-73 421 378-199 377 199zm527-357q0 22-26 48l-363 354 86 500q1 7 1 20 0 50-41 50-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="#ccc"></path></svg><?php
            }
        }
    }

    private function stars_yelp($rating) {
        ?><svg class="yrw-rating yrw-rating-<?php echo $rating * 10; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 865 145" width="865" height="145"><path class="yrw-stars-1f" d="M110.6 0h-76.9c-18.6 0-33.7 15.1-33.7 33.7v76.9c0 18.6 15.1 33.7 33.7 33.7h76.9c18.6 0 33.7-15.1 33.7-33.7v-76.9c0-18.6-15.1-33.7-33.7-33.7z"/><path class="yrw-stars-0h" d="M33.3,0.3C14.7,0.3-0.4,15.4-0.4,34V111c0,18.6,15.1,33.7,33.7,33.7h38.3V0.3H33.3z"/><path class="yrw-stars-2f" d="M290.6 0h-76.9c-18.6 0-33.7 15.1-33.7 33.7v76.9c0 18.6 15.1 33.7 33.7 33.7h76.9c18.6 0 33.7-15.1 33.7-33.7v-76.9c0-18.6-15.1-33.7-33.7-33.7z"/><path class="yrw-stars-1h" d="M214,0.3c-18.6,0-33.7,15.1-33.7,33.7v77c0,18.6,15.1,33.7,33.7,33.7h38.3V0.3H214z"/><path class="yrw-stars-3f" d="M470.4 0h-76.9c-18.6 0-33.7 15.1-33.7 33.7v76.9c0 18.6 15.1 33.7 33.7 33.7h76.9c18.6 0 33.7-15.1 33.7-33.7v-76.9c.1-18.6-15.1-33.7-33.7-33.7z"/><path class="yrw-stars-2h" d="M393.9,0.6c-18.6,0-33.7,15.1-33.7,33.7v77c0,18.6,15.1,33.7,33.7,33.7h38.3V0.6H393.9z"/><path class="yrw-stars-4f" d="M650.6 0h-76.9c-18.6 0-33.7 15.1-33.7 33.7v76.9c0 18.6 15.1 33.7 33.7 33.7h76.9c18.6 0 33.7-15.1 33.7-33.7v-76.9c0-18.6-15.1-33.7-33.7-33.7z"/><path class="yrw-stars-3h" d="M573.9 0c-18.6 0-33.7 15.1-33.7 33.7v77c0 18.6 15.1 33.7 33.7 33.7h38.3v-144.4h-38.3z"/><path class="yrw-stars-5f" d="M830.6 0h-76.9c-18.6 0-33.7 15.1-33.7 33.7v76.9c0 18.6 15.1 33.7 33.7 33.7h76.9c18.6 0 33.7-15.1 33.7-33.7v-76.9c0-18.6-15.1-33.7-33.7-33.7z"/><path class="yrw-stars-4h" d="M753.8 0c-18.6 0-33.7 15.1-33.7 33.7v77c0 18.6 15.1 33.7 33.7 33.7h38.3v-144.4h-38.3z"/><path class="yrw-stars" fill="#FFF" stroke="#FFF" stroke-width="2" stroke-linejoin="round" d="M72 19.3l13.6 35.4 37.9 2-29.5 23.9 9.8 36.6-31.8-20.6-31.8 20.6 9.8-36.6-29.5-23.9 37.9-2zm180.2 0l13.6 35.4 37.8 2-29.4 23.9 9.8 36.6-31.8-20.6-31.9 20.6 9.8-36.6-29.4-23.9 37.8-2zm179.8 0l13.6 35.4 37.9 2-29.5 23.9 9.8 36.6-31.8-20.6-31.8 20.6 9.8-36.6-29.5-23.9 37.9-2zm180.2 0l13.6 35.4 37.8 2-29.4 23.9 9.8 36.6-31.8-20.6-31.9 20.6 9.8-36.6-29.4-23.9 37.8-2zm180 0l13.6 35.4 37.8 2-29.4 23.9 9.8 36.6-31.8-20.6-31.9 20.6 9.8-36.6-29.4-23.9 37.8-2z"/></svg><?php
    }

    private function social_logo($provider) {
        ?><span class="rplg-social-logo rplg-<?php echo $provider; ?>-logo"><?php
        switch ($provider) {
            case 'google':
                $this->google_logo();
                break;
            case 'facebook':
                $this->facebook_logo();
                break;
            case 'yelp':
                $this->yelp_logo2();
                break;
        }
        ?></span><?php
    }

    function google_logo() {
        ?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="44" width="44"><g fill="none" fill-rule="evenodd"><path d="M482.56 261.36c0-16.73-1.5-32.83-4.29-48.27H256v91.29h127.01c-5.47 29.5-22.1 54.49-47.09 71.23v59.21h76.27c44.63-41.09 70.37-101.59 70.37-173.46z" fill="#4285f4"></path><path d="M256 492c63.72 0 117.14-21.13 156.19-57.18l-76.27-59.21c-21.13 14.16-48.17 22.53-79.92 22.53-61.47 0-113.49-41.51-132.05-97.3H45.1v61.15c38.83 77.13 118.64 130.01 210.9 130.01z" fill="#34a853"></path><path d="M123.95 300.84c-4.72-14.16-7.4-29.29-7.4-44.84s2.68-30.68 7.4-44.84V150.01H45.1C29.12 181.87 20 217.92 20 256c0 38.08 9.12 74.13 25.1 105.99l78.85-61.15z" fill="#fbbc05"></path><path d="M256 113.86c34.65 0 65.76 11.91 90.22 35.29l67.69-67.69C373.03 43.39 319.61 20 256 20c-92.25 0-172.07 52.89-210.9 130.01l78.85 61.15c18.56-55.78 70.59-97.3 132.05-97.3z" fill="#ea4335"></path><path d="M20 20h472v472H20V20z"></path></g></svg><?php
    }

    function facebook_logo() {
        ?><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="30" height="30" viewBox="0 0 100 100"><g transform="translate(23,85) scale(0.05,-0.05)"><path fill="#fff" d="M959 1524v-264h-157q-86 0 -116 -36t-30 -108v-189h293l-39 -296h-254v-759h-306v759h-255v296h255v218q0 186 104 288.5t277 102.5q147 0 228 -12z"></path></g></svg><?php
    }

    function yelp_logo() {
        ?><img src="<?php echo BRB_ASSETS_URL; ?>img/yelp-logo.png" alt="Yelp logo"><?php
    }

    function yelp_logo2() {
        ?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="44" height="44" viewBox="0 0 533.33 533.33" style="enable-background:new 0 0 533.33 533.33;" xml:space="preserve"><path d="M317.119,340.347c-9.001,9.076-1.39,25.586-1.39,25.586l67.757,113.135c0,0,11.124,14.915,20.762,14.915   c9.683,0,19.246-7.952,19.246-7.952l53.567-76.567c0,0,5.395-9.658,5.52-18.12c0.193-12.034-17.947-15.33-17.947-15.33   l-126.816-40.726C337.815,335.292,325.39,331.994,317.119,340.347z M310.69,283.325c6.489,11.004,24.389,7.798,24.389,7.798   l126.532-36.982c0,0,17.242-7.014,19.704-16.363c2.415-9.352-2.845-20.637-2.845-20.637l-60.468-71.225   c0,0-5.24-9.006-16.113-9.912c-11.989-1.021-19.366,13.489-19.366,13.489l-71.494,112.505   C311.029,261.999,304.709,273.203,310.69,283.325z M250.91,239.461c14.9-3.668,17.265-25.314,17.265-25.314l-1.013-180.14   c0,0-2.247-22.222-12.232-28.246c-15.661-9.501-20.303-4.541-24.79-3.876l-105.05,39.033c0,0-10.288,3.404-15.646,11.988   c-7.651,12.163,7.775,29.972,7.775,29.972l109.189,148.831C226.407,231.708,237.184,242.852,250.91,239.461z M224.967,312.363   c0.376-13.894-16.682-22.239-16.682-22.239L95.37,233.079c0,0-16.732-6.899-24.855-2.091c-6.224,3.677-11.738,10.333-12.277,16.216   l-7.354,90.528c0,0-1.103,15.685,2.963,22.821c5.758,10.128,24.703,3.074,24.703,3.074L210.37,334.49   C215.491,331.048,224.471,330.739,224.967,312.363z M257.746,361.219c-11.315-5.811-24.856,6.224-24.856,6.224l-88.265,97.17   c0,0-11.012,14.858-8.212,23.982c2.639,8.552,7.007,12.802,13.187,15.797l88.642,27.982c0,0,10.747,2.231,18.884-0.127   c11.552-3.349,9.424-21.433,9.424-21.433l2.003-131.563C268.552,379.253,268.101,366.579,257.746,361.219z" fill="#D80027"/></svg><?php
    }

    private function anchor($url, $class, $text, $open_link, $nofollow_link, $onclick = '', $title = '') {
        ?><a href="<?php echo $url; ?>" class="<?php echo $class; ?>" <?php if ($open_link) { ?>target="_blank"<?php } ?> <?php if ($nofollow_link) { ?>rel="nofollow"<?php } ?> <?php if (strlen($onclick) > 0) { ?>onclick="<?php echo $onclick; ?>"<?php } ?> <?php if (strlen($title) > 0) { ?>title="<?php echo $title; ?>"<?php } ?>><?php echo $text; ?></a><?php
    }

    function image($src, $alt, $lazy, $def_ava = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', $atts = '') {
        ?><img <?php if ($lazy) { ?>src="<?php echo $def_ava; ?>" data-<?php } ?>src="<?php echo $src; ?>" class="rplg-review-avatar<?php if ($lazy) { ?> rplg-blazy<?php } ?>" alt="<?php echo $alt; ?>" onerror="if(this.src!='<?php echo $def_ava; ?>')this.src='<?php echo $def_ava; ?>';" <?php echo $atts; ?>><?php
    }

    private function js_loader($func, $data = '') {
        ?><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" onload="(function(el, data) { var t = setInterval(function () { if (window.<?php echo $func; ?>){ <?php echo $func; ?>(el, data); clearInterval(t); } }, 200); })(this.parentNode<?php if (strlen($data) > 0) { ?>, <?php echo str_replace('"', '\'', $data); } ?>);" style="display:none"><?php
    }

    private function trim_text($text, $size) {
        if ($size > 0 && strlen($text) > $size) {
            $visible_text = $text;
            $invisible_text = '';
            $idx = $this->rstrpos($text, ' ', $size);
            if ($idx < 1) {
                $idx = $size;
            }
            if ($idx > 0) {
                $visible_text = substr($text, 0, $idx);
                $invisible_text = substr($text, $idx, strlen($text));
            }
            echo $visible_text;
            if (strlen($invisible_text) > 0) {
                ?><span class="rplg-more"><?php echo $invisible_text; ?></span><span class="rplg-more-toggle" onclick="this.previousSibling.className='';this.textContent='';"><?php echo __('read more', 'brb'); ?></span><?php
            }
        } else {
            echo $text;
        }
    }

    private function rstrpos($haystack, $needle, $offset){
        $size = strlen ($haystack);
        $pos = strpos (strrev($haystack), $needle, $size - $offset);

        if ($pos === false)
            return false;

        return $size - $pos;
    }

    private function correct_url_proto($url){
        return substr($url, 0, 2) == '//' ? 'https:' . $url : $url;
    }

}
