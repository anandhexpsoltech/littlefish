<?php /* Template Name: Contact */ get_header(); ?>

<?php if( get_field('header_image') ): ?>
	<?php $image = get_field('header_image'); ?>

	<div class="header-image has-map" style="background-image: url(<?php //echo $image['url']; ?>)">
		<?php if(get_field('contact_address')): ?>
			<div class="map-wrap">
				<?php
					$location = get_field('contact_address');
					$address = $location['address'];
				?>

				<div class="acf-map">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<div class="main-container">
	<?php if(get_field('contact_box_1_content')): ?>
		<div class="box-wrap animated wow fadeIn">
			<div class="wrapper overflow">
				<?php if(get_field('contact_box_1_title')): ?>
					<div class="title">
						<h2>
							<?php the_field('contact_box_1_title'); ?>
						</h2>
					</div>
				<?php endif; ?>

				<div class="content">
					<?php the_field('contact_box_1_content'); ?>

					<?php if(get_field('contact_box_1_content_additional')): ?>
						<button class="btn-more btn-slide-next">
							<span class="active">
								<?php _e('Read More', 'html5blank'); ?> &mdash;
							</span>

							<span class="second">
								<?php _e('Read Less', 'html5blank'); ?> &mdash;
							</span>
						</button>
					<?php endif; ?>

					<?php if(get_field('contact_box_1_content_additional')): ?>
						<div class="hide">
							<?php the_field('contact_box_1_content_additional'); ?>
						</div>
					<?php endif; ?>

					<?php if( have_rows('contact_contacts') ): ?>
						<div class="contacts-wrap animated wow fadeInUp">
							<h1 class="title">
								<?php the_title(); ?>
							</h1>

							<div class="columns columns-3">
								<?php while( have_rows('contact_contacts') ): the_row(); ?>
									<div class="contact col">
										<?php if( get_sub_field('contact_contacts_image') ): ?>
											<?php $image = get_sub_field('contact_contacts_image'); ?>

											<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php endif; ?>

										<h3 class="title">
											<strong>
												<?php the_sub_field('contact_contacts_name'); ?>
											</strong>
										</h3>

										<p class="title">
											<?php the_sub_field('contact_contacts_title'); ?>
										</p>

										<p class="phone">
											<?php the_sub_field('contact_contacts_phone'); ?>
										</p>

										<p class="email">
											<?php the_sub_field('contact_contacts_email'); ?>
										</p>
									</div>
								<?php endwhile; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="wrapper overflow">
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
