<?php get_header(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper overflow">
			<main role="main">
				<h4 class="widget-title">
					<?php _e( 'News & Insights', 'html5blank' ); ?>
				</h4>

				<?php get_template_part('loop-normal'); ?>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
