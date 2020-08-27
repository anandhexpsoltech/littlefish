<?php get_header(); ?>

	<div class="main-container has-sidebar overflow">
		<div class="wrapper">
			<main role="main">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="title">
							<?php the_title(); ?>
						</h1>

						<p class="date entry-meta">
							<time class="entry-time">
								<?php _e( 'Last Updated, ', 'html5blank' ); ?> <?php the_time('F j, Y'); ?>
							</time>
				        </p>

						<?php if ( has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('large'); ?>
						<?php endif; ?>

						<div class="property-info">
							<?php if( get_field('bedrooms') ): ?>
								<div class="icon bedrooms">
									<i class="fa fa-bed no-hover" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

									<?php the_field('bedrooms'); ?>
								</div>
							<?php endif; ?>

							<?php if( get_field('bathrooms') ): ?>
								<div class="icon bathrooms">
									<i class="fa fa-shower no-hover" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

									<?php the_field('bathrooms'); ?>
								</div>
							<?php endif; ?>

							<?php if( get_field('garages') ): ?>
								<div class="icon garages">
									<i class="fa fa-car no-hover" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

									<?php the_field('garages'); ?>
								</div>
							<?php endif; ?>

							<?php if( get_field('bedrooms') ): ?>
								<div class="icon distance">
									<i class="fa fa-building no-hover" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

									<?php the_field('distance'); ?>

									<span>
										<?php the_field('distance_label'); ?>
									</span>
								</div>
							<?php endif; ?>
						</div>

						<?php if( get_field('custom_content') ): ?>
							<?php the_field('custom_content'); ?>
						<?php endif; ?>

						<?php if( get_field('updates_latest') ): ?>
							<div class="updates-wrap">
								<?php if( get_field('updates_title') ): ?>
									<h2 class="title">
										<?php the_field('updates_title'); ?>
									</h2>
								<?php endif; ?>

								<div class="latest">
									<?php the_field('updates_latest'); ?>
								</div>

								<?php if( have_rows('updates') ): ?>
									<div class="updates">
										<?php
											$reversed = array_reverse(get_field('updates'));
										?>

										<h3 class="title">
											<?php _e( 'Previous Updates', 'html5blank' ); ?>

											<i class="fa fa-chevron-circle-down size-25 blue" aria-hidden="true"></i>
										</h3>

										<?php foreach($reversed as $i => $row): ?>
											<div class="update">
												<?php echo $row['updates_content']; ?>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if( get_field('updates_gallery_content') ): ?>
							<?php the_field('updates_gallery_content'); ?>
						<?php endif; ?>

						<?php if( get_field('updates_gallery') ): ?>
							<?php $images = get_field('updates_gallery'); ?>

							<?php if(get_field('updates_gallery_title')): ?>
								<h2>
									<?php the_field('updates_gallery_title'); ?>
								</h2>
							<?php endif; ?>

							<div class="slider wp-slick-slider has-lightbox">
								<?php foreach($images as $image): ?>
									<div class="image">
										<a href="<?php echo $image['url']; ?>">
											<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
										</a>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php the_content(); ?>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>
			</main>

			<?php get_template_part('sidebar-projects'); ?>
		</div>
	</div>

<?php get_footer(); ?>
