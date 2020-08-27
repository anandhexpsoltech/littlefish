<?php get_header(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper overflow">
			<main role="main">
				<h1 class="title">
					<?php _e( 'Archives', 'html5blank' ); ?>
				</h1>

				<?php get_template_part('loop-normal'); ?>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
