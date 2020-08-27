<?php get_header(); ?>

	<?php $term = get_queried_object(); ?>

	<div class="main-container has-sidebar">
		<div class="wrapper narrow">
			<?php get_template_part('module-breadcrumbs'); ?>

			<main role="main">
				<div class="category-desc">
					<h3 class="widget-title">
						<?php _e( 'Category', 'html5blank' ); ?>
					</h3>

					<h1 class="category-title">
						<?php single_cat_title(); ?>
					</h1>

					<div class="content">
						<?php if(get_field('category_description', $term)): ?>
							<?php the_field('category_description', $term); ?>
						<?php endif; ?>

						<?php if(get_field('category_description_additional', $term)): ?>
							<button class="btn-more btn-slide-next">
								<span class="active">
									<?php _e('Read More', 'html5blank'); ?> &mdash;
								</span>

								<span class="second">
									<?php _e('Read Less', 'html5blank'); ?> &mdash;
								</span>
							</button>
						<?php endif; ?>

						<?php if(get_field('category_description_additional', $term)): ?>
							<div class="hide">
								<?php the_field('category_description_additional', $term); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<?php get_template_part('loop-normal'); ?>
			</main>

			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div>

		<?php get_template_part('module-cta'); ?>
	</div>

<?php get_footer(); ?>
