<?php get_header(); ?>

	<?php if( get_field('header_image') ): ?>
		<?php $image = get_field('header_image'); ?>

		<div class="header-image">
			<img src="<?php echo $image['url']; ?>" alt="">
		</div>
	<?php endif; ?>

	<div class="main-container" style="background-image: url(<?php the_field('header_background'); ?>)">
		<div class="wrapper overflow">
			<main role="main">
				<h1><?php the_title(); ?></h1>

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
