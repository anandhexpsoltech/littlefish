<?php get_header(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper">
			<?php get_template_part('module-breadcrumbs'); ?>

			<main role="main">
				<h1 class="title">
					<?php _e( 'Tag Archive: ', 'html5blank' ); echo single_tag_title('', false); ?>
				</h1>

				<?php get_template_part('loop-normal'); ?>
			</main>

			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div>
	</div>

<?php get_footer(); ?>
