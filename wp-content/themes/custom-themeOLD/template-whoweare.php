<?php /* Template Name: Who We Are Page Template */ get_header(); ?>

	<?php if( get_field('header_image') ): ?>
		<?php $image = get_field('header_image'); ?>

		<div class="header-image">
			<img src="<?php echo $image['url']; ?>" alt="">
		</div>
	<?php endif; ?>

	<div class="main-container">
		<?php if(get_field('about_box_1_content')): ?>
			<div class="box-wrap has-social animated wow fadeIn">
				<div class="wrapper overflow">
					<?php if(get_field('about_box_1_title')): ?>
						<div class="title">
							<h2>
								<?php the_field('about_box_1_title'); ?>
							</h2>
						</div>
					<?php endif; ?>

					<div class="content">
						<?php the_field('about_box_1_content'); ?>
					</div>

					<?php get_template_part('module-social'); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="wrapper overflow">
			<main role="main" class="fullwidth">
				<?php if( have_rows('about_members') ): ?>
					<div class="title-small">
						<h2 class="carousel-title wow slideInUp animated">
							<?php _e('Our management team', 'html5blank'); ?>
						</h2>
					</div>

					<div class="members columns columns-3 animated wow fadeIn">
						<?php while( have_rows('about_members') ): the_row(); ?>
							<div class="col">
								<?php if( get_sub_field('about_members_image') ): ?>
									<?php $image = get_sub_field('about_members_image'); ?>

									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>

								<?php if(get_sub_field('about_members_name')): ?>
									<h3 class="title">
										<?php the_sub_field('about_members_name'); ?>
									</h3>
								<?php endif; ?>

								<?php if(get_sub_field('about_members_title')): ?>
									<h4 class="title">
										<?php the_sub_field('about_members_title'); ?>
									</h4>
								<?php endif; ?>

								<?php if(get_sub_field('about_members_description')): ?>
									<?php the_sub_field('about_members_description'); ?>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</main>
		</div>

		<?php if(get_field('about_box_2_content')): ?>
			<div class="box-wrap last animated wow fadeIn">
				<div class="wrapper overflow">
					<?php if(get_field('about_box_2_title')): ?>
						<div class="title">
							<h2>
								<?php the_field('about_box_2_title'); ?>
							</h2>
						</div>
					<?php endif; ?>

					<div class="content">
						<?php the_field('about_box_2_content'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>
