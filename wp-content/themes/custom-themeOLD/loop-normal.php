<div class="news-feed">
	<div class="infinite-scroll">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="float-left featured-image">
		            <?php if ( has_post_thumbnail()) : ?>
		                <?php the_post_thumbnail('small'); ?>
		            <?php endif; ?>
		        </a>

				<div class="content float-right">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>

					<p class="entry-meta">
						<time class="entry-time">
							<?php the_time('F j, Y'); ?>
						</time>

						<?php if( get_field('post_author') ): ?>
								<span>
									<?php _e( 'Source; ', 'html5blank' ); the_field('post_author'); ?>
								</span>
						<?php endif; ?>
					</p>

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
</div>
