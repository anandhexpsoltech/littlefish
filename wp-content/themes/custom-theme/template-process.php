<?php /* Template Name: Our Process */ get_header(); ?>

	<?php if( get_field('header_image') ): ?>
		<?php $image = get_field('header_image'); ?>

		<div class="header-image">
			<img src="<?php echo $image['url']; ?>" alt="">
		</div>
	<?php endif; ?>

	<div class="main-container" style="background-image: url(<?php the_field('header_background'); ?>)">
		<div class="wrapper overflow">
			<main role="main" class="fullwidth">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>
			</main>
		</div>

		<?php if(get_field('process_what_we_do')): ?>
			<div class="about">
				<div class="wrapper">
					<div class="title-small">
						<h2 class="title carousel-title">
							<?php _e('Our process', 'html5blank'); ?>
						</h2>
					</div>

					<?php the_field('process_what_we_do'); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if( have_rows('process_features') ): ?>
			<div class="features-wrap">
				<div class="wrapper">
					<div class="columns columns-6 features">
						<?php while( have_rows('process_features') ): the_row(); ?>
							<div class="col">
								<?php if( get_sub_field('process_features_icon') ): ?>
									<?php $image = get_sub_field('process_features_icon'); ?>

									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>

								<h2 class="title" style="color: <?php the_sub_field('process_features_color'); ?>">
									<?php the_sub_field('process_features_title'); ?>
								</h2>

								<div class="content">
									<?php the_sub_field('process_features_content'); ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if(get_field('process_work')): ?>
			<div class="work">
				<div class="wrapper">
					<?php the_field('process_work'); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if(get_field('process_portal_content')): ?>
			<div class="portal">
				<div class="wrapper overflow">
					<div class="title-small">
						<h2 class="title carousel-title">
							<?php _e('Our custom portal', 'html5blank'); ?>
						</h2>
					</div>

					<div class="float-left">
						<?php the_field('process_portal_content'); ?>
					</div>

					<div class="float-right">
						<?php if( get_field('process_portal_image') ): ?>
							<?php $image = get_field('process_portal_image'); ?>

							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php get_template_part('module-cta'); ?>
	</div>

<?php get_footer(); ?>
