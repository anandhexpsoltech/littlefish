<?php
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 6
	);

	$loop = new WP_Query( $args );
?>

<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('overflow news-item'); ?>>
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
