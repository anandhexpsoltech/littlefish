<div class="news-feed">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="content has-video">
				<h1 class="entry-title padding">
		            <a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
		        </h1>

		        <p class="entry-meta padding">
		            <time class="entry-time">
						<?php the_time('M j, Y'); ?>
					</time>

					<span>
			            <?php if( get_field('post_author') ): ?>
							<?php _e( ' Source; ', 'html5blank' ); the_field('post_author'); ?>
						<?php else: ?>
							<?php _e( ' by ', 'html5blank' ); the_author_posts_link(); ?>
			            <?php endif; ?>
					</span>

					<span class="sep">|</span>

					<?php the_category(', '); ?>
		        </p>

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured-image">
					<?php if ( has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('large-2'); ?>
					<?php endif; ?>
				</a>

		        <div class="entry-content padding">
					<?php if(get_field('custom_excerpt')): ?>
						<?php the_field('custom_excerpt'); ?>
					<?php else: ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>

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
