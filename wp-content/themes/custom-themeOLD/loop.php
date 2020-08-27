<div class="featured-article">
	<h4 class="widget-title">
		<?php _e( 'Featured article', 'html5blank' ); ?>
	</h4>

	<?php
		$f_args = array(
			'post_type' => 'post',
			'posts_per_page' => 1
		);

		$f_loop = new WP_Query($f_args);
	?>

    <?php if ($f_loop->have_posts()): while ($f_loop->have_posts()) : $f_loop->the_post(); ?>
		<?php $id = get_the_ID(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured-image">
                <?php if ( has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php endif; ?>

                <time class="entry-time">
					<?php the_time('F j, Y'); ?>
				</time>
            </a>

            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
            </h2>

            <?php if( get_field('post_author') ): ?>
                <p class="entry-meta">
                    <span>
						<?php _e( ' Source; ', 'html5blank' ); the_field('post_author'); ?>
					</span>
                </p>
            <?php endif; ?>

            <div class="entry-content">
				<?php the_excerpt(); ?>

				<a class="view-article" href="<?php the_permalink(); ?>">
					<?php _e('Read More', 'html5blank'); ?>
				</a>
            </div>
        </article>
    <?php endwhile; ?>

    <?php endif; ?>
</div>

<div class="news-feed">
	<h4 class="widget-title">
		<?php _e( 'News and insights', 'html5blank' ); ?>
	</h4>

	<div class="infinite-scroll">
		<?php
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

			$args = array(
				'post_type' => 'post',
		        'post__not_in' => array($id),
				'posts_per_page' => 4,
				'paged'=> $paged
			);

			$wp_query = new WP_Query($args);
		?>

		<?php if ($wp_query->have_posts()): while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="float-left featured-image">
		            <?php if ( has_post_thumbnail()) : ?>
						<?php
							$thumbnail_id = get_post_thumbnail_id();
							$thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
							$thumbnail_small = wp_get_attachment_image_src($thumbnail_id, 'small');
							$thumbnail_large = wp_get_attachment_image_src($thumbnail_id, 'large');
						?>

						<img srcset="<?php echo $thumbnail_large[0]; ?> 480w, <?php echo $thumbnail_small[0]; ?> 1280w" src="<?php echo $thumbnail_small[0]; ?>" alt="A rad wolf" alt="<?php echo $thumbnail_alt; ?>" />
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
								<?php _e( ' Source; ', 'html5blank' ); the_field('post_author'); ?>
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
