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
									<i class="fa fa-bed" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

									<?php the_field('bedrooms'); ?>
								</div>
							<?php endif; ?>

							<?php if( get_field('bathrooms') ): ?>
								<div class="icon bathrooms">
									<i class="fa fa-shower" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

									<?php the_field('bathrooms'); ?>
								</div>
							<?php endif; ?>

							<?php if( get_field('garages') ): ?>
								<div class="icon garages">
									<i class="fa fa-car" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

									<?php the_field('garages'); ?>
								</div>
							<?php endif; ?>

							<?php if( get_field('bedrooms') ): ?>
								<div class="icon distance">
									<i class="fa fa-building" aria-hidden="true" style="color: <?php the_field('icon_color'); ?>"></i>

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

						<?php the_content(); ?>

						<?php if( get_field('address') ): ?>
						    <?php $location = get_field('address'); ?>

						    <div class="acf-map short">
						        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						    </div>
						<?php endif; ?>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
