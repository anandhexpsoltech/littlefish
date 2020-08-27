<?php /* Template Name: Overview Page Template */ get_header(); ?>

	<?php if( get_field('header_image') ): ?>
		<?php $image = get_field('header_image'); ?>

		<div class="header-image">
			<img src="<?php echo $image['url']; ?>" alt="">
		</div>
	<?php endif; ?>

	<?php
		global $current_custom_user;
		$current_user_field = 'user_' . $current_custom_user;
	?>

	<div class="main-container" style="background-image: url(<?php the_field('header_background'); ?>)">
		<div class="wrapper overflow">
			<main role="main">
				<h2 class="title wow animated fadeIn">
					<?php if( get_field('user_plot', $current_user_field) ): ?>
						<a class="btn-plot" href="<?php the_field('user_plot', $current_user_field); ?>" target="_blank"></a>
					<?php endif; ?>

					<?php if(current_user_can('administrator') ) :  ?>
						<a href="<?php bloginfo('url'); ?>/wp-admin/">
					<?php endif; ?>

					<?php the_title(); ?>

					<?php if(current_user_can('administrator') ) :  ?>
						</a>
					<?php endif; ?>
				</h2>

                <?php get_template_part('loop-clients'); ?>
			</main>
		</div>
	</div>
<?php get_footer(); ?>
