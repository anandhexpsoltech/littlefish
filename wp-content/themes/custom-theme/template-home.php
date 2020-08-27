<?php /* Template Name: Home Page Template */ get_header(); ?>

    <?php if( get_field('banner_image') ): ?>
        <div class="header-image">
            <div class="image" style="background-image: url(<?php the_field('banner_image'); ?>);">
                <?php if( get_field('banner_caption') ): ?>
                    <div class="wrapper">
                        <div class="slider-content wow animated fadeInUp delay-2">
                            <?php the_field('banner_caption'); ?>

                            <?php if(get_field('button_label')): ?>
                                <a class="btn orange btn-inquiry" href="#" style="color: <?php the_field('button_label_color'); ?>; background-color: <?php the_field('button_background_color'); ?>; border-color: <?php the_field('button_border_color'); ?>">
                                    <?php if(get_field('button_icon')): ?>
                                        <span style="background-image: url('<?php the_field('button_icon'); ?>');"></span>
                                    <?php endif; ?>

                                    <?php the_field('button_label'); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if( get_field('banner_arrow_icon') ): ?>
                            <span class="scrolldown wow animated btnScroll" style="background-image: url(<?php the_field('banner_arrow_icon'); ?>)"></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if( get_field('partners_logos') ): ?>
    	<?php
            $images = get_field('partners_logos');
            $i = 0;
        ?>

        <div class="gallery-wrap">
            <div class="wrapper full">
                <div class="gallery columns">
                    <?php if( get_field('partners_label') ): ?>
                        <div class="col first">
                            <p>
                                <?php the_field('partners_label'); ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="carousel">
                        <?php foreach($images as $image): ?>
                            <?php $i++; ?>

                            <div class="col img-<?php echo $i; ?>">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

	<div class="main-container">
        <?php if(get_field('home_box_1_content')): ?>
            <div class="box-wrap animated wow fadeIn">
                <div class="wrapper overflow">
                    <?php if(get_field('home_box_1_title')): ?>
                        <div class="title">
                            <h2>
                                <?php the_field('home_box_1_title'); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_field('home_box_1_content'); ?>

                        <?php if(get_field('home_box_1_link_label')): ?>
                            <button class="btn-more btn-slide-next">
                                <span class="active">
                                    <?php the_field('home_box_1_link_label'); ?> &mdash;
                                </span>

                                <?php if(get_field('home_box_1_link_label_2')): ?>
                                    <span class="second">
                                        <?php the_field('home_box_1_link_label_2'); ?> &mdash;
                                    </span>
                                <?php endif; ?>
                            </button>
                        <?php endif; ?>

                        <?php if(get_field('home_box_1_content_additional')): ?>
                            <div class="hide">
                                <?php the_field('home_box_1_content_additional'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if(get_field('home_box_1_video_url')): ?>
                    <div class="wrapper narrow-2">
                        <div class="js-player">
                            <iframe src="<?php the_field('home_box_1_video_url'); ?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php get_template_part('loop-projects-carousel'); ?>

        <?php get_template_part('loop-testimonial'); ?>

        <?php if(get_field('projects_content')): ?>
            <div class="projects-section">
                <div class="wrapper overflow">
                    <?php if( get_field('projects_title') ): ?>
                        <div class="title-small">
                            <h2 class="carousel-title wow animated slideInUp">
                                <?php the_field('projects_title'); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <?php if( get_field('projects_image') ): ?>
                        <?php $image = get_field('projects_image'); ?>

                        <div class="right">
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                        </div>
                    <?php endif; ?>

                    <div class="left">
                        <?php the_field('projects_content'); ?>

                        <?php if(get_field('button_label_2')): ?>
                            <a class="btn orange btn-inquiry" href="#" style="color: <?php the_field('button_label_color_2'); ?>; background-color: <?php the_field('button_background_color_2'); ?>; border-color: <?php the_field('button_border_color_2'); ?>">
                                <?php if(get_field('button_icon_2')): ?>
                                    <span style="background-image: url('<?php the_field('button_icon_2'); ?>');"></span>
                                <?php endif; ?>

                                <?php the_field('button_label_2'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="wrapper">
            <div class="title-small wow animated slideInUp">
                <h2 class="carousel-title">
                    <?php _e( 'News & Insights', 'html5blank' );?>
                </h2>
            </div>

            <div class="latest-news columns columns-3">
                <?php get_template_part('loop-news-home'); ?>
            </div>
        </div>

        <?php get_template_part('module-cta'); ?>
	</div>

<?php get_footer(); ?>
