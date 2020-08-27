<?php
	$taxonomy = 'category';
	$terms = get_the_terms($post->ID, $taxonomy);

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 2,
		'post__not_in' => array($post->ID),
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $terms[0]->slug
			),
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => 'news-insights',
				'operator' => 'NOT IN',
	        ),
		)
	);

	$loop = new WP_Query($args);
?>

<?php if( get_field('related_posts') || $loop->have_posts() ): ?>
	<div class="related">
		<div class="center">
			<h2 class="carousel-title">
				<?php _e( 'Related Posts', 'html5blank' );?>
			</h2>
		</div>

		<div class="columns columns-2">
			<?php if( get_field('related_posts') ): ?>
				<?php $posts = get_field('related_posts'); ?>

				<?php foreach($posts as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('col overflow wow animated slideInUp'); ?>>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured-image">
							<?php if ( has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('news-home'); ?>
							<?php endif; ?>
						</a>

					    <h3 class="entry-title">
					        <a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
					    </h3>

						<p class="entry-meta">
							<time class="entry-time">
								<?php the_time('F j, Y'); ?>
							</time>

							<span>
								<?php if( get_field('post_author') ): ?>
									<?php _e( ' Source; ', 'html5blank' ); the_field('post_author'); ?>
								<?php else: ?>
									<?php _e( ' by ', 'html5blank' ); the_author_posts_link(); ?>
								<?php endif; ?>
							</span>
						</p>

					    <div class="entry-excerpt">
							<?php the_excerpt(); ?>

							<a class="view-article" href="<?php the_permalink(); ?>">
								<?php _e('Read More', 'html5blank'); ?>
							</a>
					    </div>
					</article>
				<?php endforeach; ?>

				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php else: ?>
				<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('col overflow wow animated slideInUp'); ?>>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured-image">
							<?php if ( has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('news-home'); ?>
							<?php endif; ?>
						</a>

					    <h3 class="entry-title">
					        <a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
					    </h3>

						<p class="entry-meta">
							<time class="entry-time">
								<?php the_time('F j, Y'); ?>
							</time>

							<span>
								<?php if( get_field('post_author') ): ?>
									<?php _e( ' Source; ', 'html5blank' ); the_field('post_author'); ?>
								<?php else: ?>
									<?php _e( ' by ', 'html5blank' ); the_author_posts_link(); ?>
								<?php endif; ?>
							</span>
						</p>

					    <div class="entry-excerpt">
							<?php the_excerpt(); ?>

							<a class="view-article" href="<?php the_permalink(); ?>">
								<?php _e('Read More', 'html5blank'); ?>
							</a>
					    </div>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>

				<?php wp_reset_query(); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
