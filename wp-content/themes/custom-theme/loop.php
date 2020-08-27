<div class="news-feed">
	<?php
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 10,
			'paged'=> $paged
		);

		$wp_query = new WP_Query($args);
	?>

	<?php if ($wp_query->have_posts()): while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="content">
				<h2 class="entry-title">
		            <a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
		        </h2>

		        <p class="entry-meta">
		            <time class="entry-time">
						<?php the_time('M j, Y'); ?>
					</time>

		            <?php if( get_field('post_author') ): ?>
	                    <span>
							<?php _e( ' by ', 'html5blank' ); the_field('post_author'); ?>
						</span>
		            <?php endif; ?>
		        </p>

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured-image">
					<?php if ( has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('large-2'); ?>
					<?php endif; ?>
				</a>

		        <div class="entry-content">
					<?php the_excerpt(); ?>

					<a class="view-article" href="<?php the_permalink(); ?>">
						<?php _e('Read More', 'html5blank'); ?>
					</a>
		        </div>
			</div>
	    </article>

	<?php endwhile; ?>

	<?php endif; ?>

	<?php get_template_part('pagination'); ?>

	<?php wp_reset_query(); ?>
</div>
