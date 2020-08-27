<?php get_header(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper narrow">
			<?php get_template_part('module-breadcrumbs'); ?>

			<main role="main">
				<?php get_template_part('loop-normal'); ?>
			</main>

			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div>

		<?php get_template_part('module-cta'); ?>
	</div>

<?php get_footer(); ?>
