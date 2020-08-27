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

		<?php get_template_part('module-cta'); ?>
	</div>
<?php get_footer(); ?>
