<?php get_header(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper">
			<?php get_template_part('module-breadcrumbs'); ?>

			<main role="main">
				<h1 class="title">
					<?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?>
				</h1>

				<?php get_template_part('loop-normal'); ?>
			</main>

			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div>
	</div>

<?php get_footer(); ?>
