<?php get_header(); ?>

	<?php $term = get_queried_object(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper narrow">
			<?php get_template_part('module-breadcrumbs'); ?>

			<main role="main">
				<div class="category-desc">
					<h3 class="widget-title">
						<?php _e( 'Author', 'html5blank' ); ?>
					</h3>

					<div class="category-title-wrap">
						<h1 class="category-title">
							<?php echo get_the_author(); ?>
						</h1>

						<?php if(get_field('user_avatar_2_active', $term) === 'yes'): ?>
							<?php
								$image = get_field('user_avatar_2', $term);
							?>

							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php endif; ?>
					</div>

					<?php if(get_field('category_description', $term)): ?>
						<?php the_field('category_description', $term); ?>
					<?php endif; ?>
				</div>

				<?php get_template_part('loop-normal'); ?>
			</main>

			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div>

		<?php get_template_part('module-cta'); ?>
	</div>

<?php get_footer(); ?>
