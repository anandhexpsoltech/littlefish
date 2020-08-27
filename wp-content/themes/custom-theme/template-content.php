<?php /* Template Name: Content */ get_header(); ?>

	<?php if( get_field('header_image') ): ?>
		<?php $image = get_field('header_image'); ?>

		<div class="header-image">
			<img src="<?php echo $image['url']; ?>" alt="">
		</div>
	<?php endif; ?>

	<div class="main-container" style="background-image: url(<?php the_field('header_background'); ?>)">
		<?php if(get_field('content_1')): ?>
			<?php if(get_field('content_1_title')): ?>
				<?php $class = 'normal'; ?>
			<?php else: ?>
				<?php $class = 'wide'; ?>
			<?php endif; ?>

            <div class="box-wrap has-social animated wow fadeIn <?php echo $class; ?> <?php the_field('content_1_social_position'); ?>">
                <div class="wrapper overflow">
                    <?php if(get_field('content_1_title')): ?>
                        <div class="title">
                            <?php the_field('content_1_title'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_field('content_1'); ?>

                        <?php if(get_field('content_1_additional')): ?>
                            <button class="btn-more btn-slide-next">
                                <span class="active">
                                    <?php _e('Read More', 'html5blank'); ?> &mdash;
                                </span>

                                <span class="second">
                                    <?php _e('Read Less', 'html5blank'); ?> &mdash;
                                </span>
                            </button>
                        <?php endif; ?>

                        <?php if(get_field('content_1_additional')): ?>
                            <div class="hide">
                                <?php the_field('content_1_additional'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

					<div class="social-wrap">
						<div class="social small border">
						   <?php get_template_part('module-social'); ?>
						</div>

						<p>
							<?php _e('We\'re social', 'html5blank'); ?>
						</p>
					</div>
                </div>
            </div>
        <?php endif; ?>

		<?php if( have_rows('content_services') ): ?>
			<?php if(get_field('content_services_background') === '#ffffff'): ?>
				<?php $color = 'white'; ?>
			<?php endif; ?>

			<?php if(get_field('content_services_title')): ?>
				<div class="title-small wow slideInUp animated <?php echo $color; ?>">
					<h2 class="carousel-title">
						<?php the_field('content_services_title'); ?>
					</h2>
				</div>
			<?php endif; ?>

			<div class="section padding style-<?php the_field('content_services_style'); ?>" style="background-color: <?php the_field('content_services_background'); ?>">
				<div class="wrapper overflow">
					<div class="columns services <?php the_field('content_services_style'); ?>">
						<?php while( have_rows('content_services') ): the_row(); ?>
							<div class="col">
								<?php if( get_sub_field('content_services_icon') ): ?>
									<?php $image = get_sub_field('content_services_icon'); ?>

									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>

								<?php if(get_sub_field('content_services_title')): ?>
									<h2 class="title" style="font-weight: <?php the_sub_field('content_services_title_weight'); ?>; color: <?php the_sub_field('content_services_title_color'); ?>">
										<?php the_sub_field('content_services_title'); ?>
									</h2>
								<?php endif; ?>

								<div class="content">
									<?php the_sub_field('content_services_content'); ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if(get_field('content_3')): ?>
			<div class="section box-wrap fullwidth">
				<div class="wrapper overflow narrow-3">
					<?php if(get_field('content_3_title')): ?>
						<div class="title-small wow slideInUp animated">
							<h2 class="carousel-title">
								<?php the_field('content_3_title'); ?>
							</h2>
						</div>
					<?php endif; ?>

					<div class="content">
						<?php the_field('content_3'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php get_template_part('loop-testimonial'); ?>

		<?php if(get_field('content_2_left')): ?>
			<div class="projects-section padding">
				<?php if(get_field('content_2_title')): ?>
					<div class="title-small wow slideInUp animated">
						<h2 class="carousel-title">
							<?php the_field('content_2_title'); ?>
						</h2>
					</div>
				<?php endif; ?>

				<div class="section grey padding">
					<div class="wrapper overflow">
						<?php if(get_field('content_2_right')): ?>
							<div class="right col">
								<?php the_field('content_2_right'); ?>
							</div>
						<?php endif; ?>

						<?php if(get_field('content_2_left')): ?>
							<div class="left col padding">
								<?php the_field('content_2_left'); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php get_template_part('module-cta'); ?>
	</div>

<?php get_footer(); ?>
