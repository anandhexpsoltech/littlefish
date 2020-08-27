<?php
	$args = array(
		'post_type' => 'project',
		'posts_per_page' => 3,
		'post__not_in' => array($post->ID),
	);

	$loop = new WP_Query($args);
?>

<div class="columns columns-3 projects related">
	<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('col mix all ' . $classes); ?>>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php if ( has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('carousel'); ?>
				<?php endif; ?>

				<div class="content">
					<?php if( get_field('street_name') ): ?>
						<h2>
							<?php the_field('street_name'); ?>
						</h2>
					<?php endif; ?>

					<?php if( get_field('district_name') ): ?>
						<h3>
							<?php the_field('district_name'); ?>
						</h3>
					<?php endif; ?>
				</div>
			</a>
		</article>
	<?php endwhile; ?>

	<?php endif; ?>

	<?php wp_reset_query(); ?>
</div>

<article class="news-item normal">
	<p><?php _e('More featured projects', 'html5blank'); ?> <a class="view-article" href="<?php bloginfo('url'); ?>/featured-projects/"><?php _e('click here', 'html5blank'); ?></a></p>
</article>
