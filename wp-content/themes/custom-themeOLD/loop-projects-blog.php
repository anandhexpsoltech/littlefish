<?php
	$args = array(
		'post_type' => 'project',
		'posts_per_page' => 4
	);

	$loop = new WP_Query($args);
?>

<section id="featured-projects" class="widget projects-sidebar">
    <div class="widget-wrap">
        <h4 class="widget-title">
			<?php _e( 'Featured projects', 'html5blank' );?>
		</h4>

        <?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
	        <article id="post-<?php the_ID(); ?>" <?php post_class('overflow'); ?>>
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
						<?php _e( 'Last Updated, ', 'html5blank' ); ?> <?php the_time('F j, Y'); ?>
					</time>
				</p>

	            <div class="entry-content">
	                <?php the_excerpt(); ?>

					<a class="view-article" href="<?php the_permalink(); ?>">
						<?php _e('Read More', 'html5blank'); ?>
					</a>
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
