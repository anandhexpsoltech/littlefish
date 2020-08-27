<?php /* Template Name: Video */ get_header(); ?>

	<?php if( get_field('video_url') ): ?>
		<div class="header-image has-video">
			<div class="video">
				<iframe src="<?php the_field('video_url'); ?>" width="100%" height="100%" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
			</div>
		</div>
	<?php endif; ?>

	<div class="main-container min-height" style="background-image: url(<?php the_field('header_background'); ?>)">
		<div class="wrapper overflow narrow">
			<main role="main">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>
			</main>
		</div>
	</div>

<?php get_footer(); ?>
