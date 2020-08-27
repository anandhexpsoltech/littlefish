<?php get_header(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper overflow">
			<main role="main">
				<?php get_template_part('loop'); ?>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
