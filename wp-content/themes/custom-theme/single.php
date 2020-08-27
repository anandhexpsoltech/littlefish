<?php get_header(); ?>

	<div class="main-container has-sidebar overflow">
		<div class="wrapper narrow">
			<?php get_template_part('module-breadcrumbs'); ?>

			<main role="main">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="title">
							<?php the_title(); ?>
						</h1>

						<p class="date entry-meta">
							<time class="entry-time">
								<?php the_time('M j, Y'); ?>
							</time>

							<span>
					            <?php if( get_field('post_author') ): ?>
									<?php _e( ' Source; ', 'html5blank' ); the_field('post_author'); ?>
								<?php else: ?>
									<?php _e( ' by ', 'html5blank' ); the_author_posts_link(); ?>
					            <?php endif; ?>
							</span>

							<span class="sep">|</span>

							<?php the_category(', '); ?>
				        </p>

						<?php if( get_field('intro_paragraph') ): ?>
							<p class="intro-paragraph">
								<?php the_field('intro_paragraph'); ?>
							</p>
						<?php endif; ?>

						<?php if(get_field('video_url')): ?>
							<?php
								$video = get_field_object('video_url');
								$video_id = $video['value'];
								$video_prepend = $video['prepend'];
								$video_url = $video_prepend . $video_id . '?rel=0';
							?>

							<div class="video-container">
								<iframe src="<?php echo $video_url; ?>" allowfullscreen allowtransparency allow="autoplay" frameborder="0"></iframe>
							</div>
						<?php else: ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php if ( has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('large-3'); ?>
								<?php endif; ?>
							</a>
						<?php endif; ?>

						<?php the_content(); ?>

						<p class="date entry-meta bottom">
							<?php _e( 'Filled under: ', 'html5blank' ); ?>

							<?php the_category(' '); ?>
				        </p>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>

				<?php if (!in_category(1)): ?>
					<div class="share-wrap">
						<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
					</div>

					<div class="share-wrap floating animated wow slideInLeft">
						<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
					</div>
				<?php endif; ?>

				<?php if(!get_field('post_author')): ?>
					<?php $author_id = 'user_' . get_the_author_meta('ID'); ?>

					<div class="author-info overflow">
						<div class="left">
							<?php if( get_field('user_avatar_2', $author_id) ): ?>
								<?php $image = get_field('user_avatar_2', $author_id); ?>

								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
						</div>

						<div class="right">
							<?php if(get_field('user_about', $author_id)): ?>
								<?php the_field('user_about', $author_id); ?>
							<?php endif; ?>

							<?php if( have_rows('user_social', $author_id) ): ?>
								<div class="info">
									<p>
										<?php _e('Follow ', 'html5blank' ); ?> <?php the_author_meta('display_name'); ?>
									</p>

									<?php while( have_rows('user_social', $author_id) ): the_row(); ?>
										<a href="<?php the_sub_field('user_social_url'); ?>" target="_blank">
											<?php the_sub_field('user_social_title'); ?>
										</a>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php get_template_part('loop-related'); ?>
			</main>

			<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div>

		<?php get_template_part('module-cta'); ?>
	</div>

<?php get_footer(); ?>
