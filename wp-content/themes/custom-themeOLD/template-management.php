<?php /* Template Name: Management */ get_header(); ?>

	<?php if( get_field('header_image') ): ?>
		<?php $image = get_field('header_image'); ?>

		<div class="header-image">
			<img src="<?php echo $image['url']; ?>" alt="">
		</div>
	<?php endif; ?>

	<div class="main-container">
		<?php if(get_field('management_box_1_content')): ?>
			<div class="box-wrap has-social animated wow fadeIn">
				<div class="wrapper overflow">
					<?php if(get_field('management_box_1_title')): ?>
						<div class="title">
							<h2>
								<?php the_field('management_box_1_title'); ?>
							</h2>
						</div>
					<?php endif; ?>

					<div class="content">
						<?php the_field('management_box_1_content'); ?>
					</div>

					<?php get_template_part('module-social'); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="wrapper overflow">
			<main role="main" class="fullwidth">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>

				<?php if( get_field('management_services') ): ?>
					<div class="services-wrap">
						<div class="title-small">
							<h2 class="title carousel-title">
								<?php _e('Our services', 'html5blank'); ?>
							</h2>
						</div>

						<?php if( have_rows('management_services') ): ?>
							<div class="accordion services">
								<?php while( have_rows('management_services') ): the_row(); ?>
									<h3 class="title">
										<?php the_sub_field('management_services_title'); ?>
									</h3>

									<div class="content">
										<?php the_sub_field('management_services_content'); ?>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</main>
		</div>

		<?php if(get_field('management_box_2_content')): ?>
			<div class="box-wrap last animated wow fadeIn">
				<div class="wrapper overflow">
					<?php if(get_field('management_box_2_title')): ?>
						<div class="title">
							<h2>
								<?php the_field('management_box_2_title'); ?>
							</h2>
						</div>
					<?php endif; ?>

					<div class="content">
						<?php the_field('management_box_2_content'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<?php if(get_field('management_brochure_content')): ?>
		<div class="brochure" style="background-image: url(<?php the_field('management_brochure_background'); ?>)">
			<?php if(get_field('management_brochure_left_image')): ?>
				<img src="<?php the_field('management_brochure_left_image'); ?>" />
			<?php endif; ?>

			<div class="wrapper overflow">
				<div class="content">
					<?php the_field('management_brochure_content'); ?>
				</div>
			</div>
		</div>

	<?php endif; ?>
<?php get_footer(); ?>
