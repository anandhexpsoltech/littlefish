<?php
	$args = array(
		'post_type' => 'project',
		'posts_per_page' => 4,
		'post__not_in' => array($post->ID)
	);

	$loop = new WP_Query( $args );
?>

<section id="insights-news" class="widget latest-news">
	<div class="widget-wrap">
		<h4 class="widget-title">
			<?php _e( 'Featured projects', 'html5blank' );?>
		</h4>

		<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('overflow'); ?>>
				<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('sidebar'); ?>
					<?php endif; ?>
				</a>

				<div class="content">
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h3>

					<p class="entry-meta">
						<time class="entry-time">
							<?php _e( 'Last Updated, ', 'html5blank' ); ?> <?php the_time('F j, Y'); ?>
						</time>

						<?php if( get_field('post_author') ): ?>
							<span>
								<?php _e( 'By ', 'html5blank' ); the_field('post_author'); ?>
							</span>
						<?php endif; ?>
					</p>
				</div>
			</article>
		<?php endwhile; ?>

		<?php endif; ?>

		<a class="btn-view-all" href="<?php bloginfo('url'); ?>/featured-projects/">
			<?php _e( 'View All Featured Projects', 'html5blank' ); ?>
		</a>
	</div>
</section>

<?php wp_reset_query(); ?>
