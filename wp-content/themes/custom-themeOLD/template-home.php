<?php /* Template Name: Home Page Template */ get_header(); ?>

    <?php if( get_field('home_slider') ): ?>
    	<?php $images = get_field('home_slider'); ?>

    	<div class="header-image">
    		<?php foreach($images as $image): ?>
                <?php if( get_field('caption_width', $image['id']) ): ?>
                    <?php $width = get_field('caption_width', $image['id']); ?>
                <?php else : ?>
                    <?php $width = '500'; ?>
                <?php endif; ?>

                <div class="image" style="background-image: url(<?php echo $image['url']; ?>);">
                    <div class="wrapper">
                        <div class="slider-content animated fadeInUp" style="max-width: <?php echo $width; ?>px;">
                            <?php if( $image['title'] ): ?>
                                <h1>
                                    <?php echo $image['title']; ?>
                                </h1>
                            <?php endif; ?>

                            <?php if( $image['description'] ): ?>
                                <h2>
                                    <?php echo $image['description']; ?>
                                </h2>
                            <?php endif; ?>

                            <?php if( get_field('custom_url', $image['id']) ): ?>
                                <a href="<?php the_field('custom_url', $image['id']); ?>">
                                    <?php _e( 'Read More', 'html5blank' ); ?> &mdash;
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
    		<?php endforeach; ?>
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

                        <?php if(get_field('home_box_1_link')): ?>
                            <a class="btn-more" href="<?php the_field('home_box_1_link'); ?>">
                                <?php _e( 'Read More', 'html5blank' ); ?> &mdash;
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php get_template_part('loop-projects-carousel'); ?>

        <?php get_template_part('loop-testimonial'); ?>

        <div class="wrapper">
            <div class="title-small">
                <h2 class="carousel-title wow animated slideInUp">
                    <?php _e( 'News & Insights', 'html5blank' );?>
                </h2>
            </div>

            <div class="latest-news columns columns-3">
                <?php get_template_part('loop-news-home'); ?>
            </div>
        </div>

        <?php if(get_field('home_box_2_content')): ?>
            <div class="box-wrap last animated wow fadeIn">
                <div class="wrapper overflow">
                    <?php if(get_field('home_box_2_title')): ?>
                        <div class="title">
                            <h2>
                                <?php the_field('home_box_2_title'); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_field('home_box_2_content'); ?>

                        <?php if(get_field('home_box_2_link')): ?>
                            <a class="btn-more" href="<?php the_field('home_box_2_link'); ?>">
                                <?php _e( 'Read More', 'html5blank' );?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
	</div>

<?php get_footer(); ?>
