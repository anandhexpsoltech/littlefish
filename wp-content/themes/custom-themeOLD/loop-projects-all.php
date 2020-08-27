<?php
	$args = array(
		'post_type' => 'project',
		'posts_per_page' => -1
	);

	$loop = new WP_Query($args);

	$taxonomy_name = 'project-category';

	$terms = get_terms( array(
		'taxonomy' => $taxonomy_name,
		'hide_empty' => true,
	) );
?>

<section id="insights-news" class="news-feed">
	<div class="project-nav overflow">
		<span class="current-nav">
			<?php _e('All', 'html5blank'); ?>
		</span>

		<ul>
			<li class="title">
				<?php _e('Sort Project:', 'html5blank'); ?>
			</li>

			<li class="first filter">
				<span class="control" data-filter=".all">
					<?php _e('All', 'html5blank'); ?>
				</span>
			</li>

			<?php foreach ($terms as $term) : ?>
				<?php $filter = '.' . $term->slug; ?>

				<li class="filter">
					<span class="control" data-filter="<?php echo $filter; ?>">
						<?php echo $term->name; ?>
					</span>
				</li>
			<?php endforeach; ?>

			<?php wp_reset_query(); ?>
		</ul>
	</div>

	<div class="columns columns-3 projects mixitup-container">
		<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
			<?php
				$classes = '';

				$tags = wp_get_post_terms($post->ID, 'project-category');

				foreach ($tags as $tag) {
					$classes .= ' ' . $tag->slug;
				}

			?>
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
</section>
