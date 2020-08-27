<?php
	$args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => -1
	);

	$loop = new WP_Query($args);
?>

<div class="home-slider slider-wrap">
	<?php if(get_field('testimonial_title', 'option')): ?>
		<div class="title-small wow animated slideInUp">
			<h2 class="carousel-title">
				<?php the_field('testimonial_title', 'option'); ?>
			</h2>
		</div>
	<?php endif; ?>

	<?php if(get_field('testimonial_content', 'option')): ?>
		<div class="content">
			<?php the_field('testimonial_content', 'option'); ?>
		</div>
	<?php endif; ?>

    <div class="testimonials-home">
		<div class="testimonials-slider has-lightbox-video">
			<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
		        <div class="slide">
					<div class="bgr" style="background-image: url(<?php the_field('testimonials_image'); ?>);"></div>
					<div class="bgr mobile" style="background-image: url(<?php the_field('testimonials_image_mobile'); ?>);"></div>

		            <div class="caption">
						<?php if( get_field('testimonials_quote') ): ?>
							<?php the_field('testimonials_quote'); ?>
						<?php endif; ?>

						<?php if( get_field('testimonials_author') ): ?>
							<p class="title">
								<?php the_field('testimonials_author'); ?>
							</p>
						<?php endif; ?>

						<?php if( get_field('testimonials_title') ): ?>
							<p class="title">
								<?php the_field('testimonials_title'); ?>
							</p>
						<?php endif; ?>

						<?php if( get_field('testimonials_video') ): ?>
							<?php $image = get_field('testimonial_icon', 'option'); ?>

							<a class="btn-play" href="<?php the_field('testimonials_video'); ?>">
								<div class="animated-dot">
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

									<div class="signal" style="background-color: <?php the_field('testimonial_icon_color', 'option'); ?>;"></div>
									<div class="signal2" style="background-color: <?php the_field('testimonial_icon_color', 'option'); ?>;"></div>
								</div>
							</a>
						<?php endif; ?>
		            </div>
		        </div>
	        <?php endwhile; ?>

	        <?php endif; ?>
		</div>

		<div class="testimonials-thumbnails">
			<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
		        <div class="slide">
					<?php if( get_field('testimonials_avatar') ): ?>
						<?php $avatar = get_field('testimonials_avatar'); ?>

						<div class="img-wrap">
							<img src="<?php echo $avatar['url']; ?>" alt="<?php echo $avatar['alt']; ?>" />

							<span class="icon play white"></span>
						</div>
					<?php endif; ?>

					<?php if( get_field('testimonials_logo') ): ?>
						<?php $logo = get_field('testimonials_logo'); ?>

						<img class="logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
					<?php endif; ?>
		        </div>
	        <?php endwhile; ?>

	        <?php endif; ?>
		</div>
    </div>
</div>

<?php wp_reset_query(); ?>
