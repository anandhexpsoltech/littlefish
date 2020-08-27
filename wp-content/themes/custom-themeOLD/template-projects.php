<?php /* Template Name: Projects */ get_header(); ?>

	<?php if( get_field('header_image') ): ?>
		<?php $image = get_field('header_image'); ?>

		<div class="header-image">
			<img src="<?php echo $image['url']; ?>" alt="">
		</div>
	<?php endif; ?>

	<div class="main-container has-sidebar">
		<div class="wrapper overflow">
			<main role="main" class="fullwidth">
				<?php get_template_part('loop-projects-all'); ?>
			</main>
		</div>

		<?php if(get_field('projects_box_1_content')): ?>
            <div class="box-wrap last animated wow fadeIn">
                <div class="wrapper overflow">
                    <?php if(get_field('projects_box_1_title')): ?>
                        <div class="title">
                            <h2>
                                <?php the_field('projects_box_1_title'); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_field('projects_box_1_content'); ?>

                        <?php if(get_field('projects_box_1_link')): ?>
                            <a class="btn-more" href="<?php the_field('projects_box_1_link'); ?>">
                                <?php _e( 'Read More', 'html5blank' );?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
	</div>
<?php get_footer(); ?>
