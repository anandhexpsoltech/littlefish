<?php
	$args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => -1
	);

	$loop = new WP_Query($args);
?>

<div class="home-slider slider-wrap">
	<?php if(get_field('testimonial_title', 'option')): ?>
		<div class="title-small">
			<h2 class="carousel-title wow animated slideInUp">
				<?php the_field('testimonial_title', 'option'); ?>
			</h2>
		</div>
	<?php endif; ?>

	<?php if(get_field('testimonial_content', 'option')): ?>
		<div class="content">
			<?php the_field('testimonial_content', 'option'); ?>
		</div>
	<?php endif; ?>

    <div class="testimonials-home" style="background-image: url(<?php the_field('testimonial_image', 'option'); ?>);">
		<div class="bgr"></div>

		<div class="testimonials-slider">
			<?php if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post(); ?>
		        <div class="slide">
		            <div class="caption wow animated fadeInUp">
						<?php if( get_field('testimonials_quote') ): ?>
							<p>
								<?php the_field('testimonials_quote'); ?>
							</p>
						<?php endif; ?>

						<?php if( get_field('testimonials_image') ): ?>
							<img src="<?php the_field('testimonials_image'); ?>" alt="">
						<?php endif; ?>

						<?php if( get_field('testimonials_author') ): ?>
							<p class="author">
								<?php the_field('testimonials_author'); ?>
							</p>
						<?php endif; ?>

						<?php if( get_field('testimonials_title') ): ?>
							<p class="title">
								<?php the_field('testimonials_title'); ?>
							</p>
						<?php endif; ?>
		            </div>
		        </div>
	        <?php endwhile; ?>

	        <?php endif; ?>
		</div>
    </div>
</div>

<?php wp_reset_query(); ?>
