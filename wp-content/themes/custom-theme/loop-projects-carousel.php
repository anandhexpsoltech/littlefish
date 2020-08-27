<div class="project-wrap">
	<div class="title-small">
		<?php if( get_field('projects_slider_title', 14) ): ?>
			<h2 class="carousel-title wow slideInUp animated">
				<?php the_field('projects_slider_title', 14); ?>
			</h2>
		<?php endif; ?>

		<?php if( get_field('projects_slider_desc', 14) ): ?>
			<p class="carousel-description wow slideInUp animated">
				<?php the_field('projects_slider_desc', 14); ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="wrapper">
		<?php if( get_field('projects_relationships', 14) ): ?>
			<?php $posts = get_field('projects_relationships', 14); ?>

			<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>

				<article <?php post_class('overflow'); ?>>
					<a class="featured-image img-wrap" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php if ( has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('carousel'); ?>
						<?php endif; ?>
					</a>

					<h4>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php if( get_field('street_name') ): ?>
								<?php the_field('street_name'); ?>
							<?php endif; ?>

							<?php if( get_field('district_name') ): ?>
								<span>
									<?php the_field('district_name'); ?>
								</span>
							<?php endif; ?>
						</a>
					</h4>
				</article>
			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php else: ?>
			<?php
				$args = array(
					'post_type' => 'project',
					'posts_per_page' => 3
				);

				$loop = new WP_Query($args);
			?>

			<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('overflow'); ?>>
					<a class="featured-image img-wrap" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php if ( has_post_thumbnail()) : ?>
							<?php $attr = array(
								'class' => "grayscale grayscale-fade"
							); ?>

							<?php the_post_thumbnail('carousel', $attr); ?>
						<?php endif; ?>
					</a>

					<h4>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php if( get_field('street_name') ): ?>
								<?php the_field('street_name'); ?>
							<?php endif; ?>

							<?php if( get_field('district_name') ): ?>
								<span>
									<?php the_field('district_name'); ?>
								</span>
							<?php endif; ?>
						</a>
					</h4>
				</article>
			<?php endwhile; ?>

			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

<?php wp_reset_query(); ?>
