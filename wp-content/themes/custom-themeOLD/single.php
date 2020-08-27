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
								<?php the_time('F j, Y'); ?>
							</time>
							
				            <?php if( get_field('post_author') ): ?>
			                    <span>
									<?php _e( ' Source; ', 'html5blank' ); the_field('post_author'); ?>
								</span>
				            <?php endif; ?>
				        </p>

						<?php if( get_field('intro_paragraph') ): ?>
							<p class="intro-paragraph">
								<?php the_field('intro_paragraph'); ?>
							</p>
						<?php endif; ?>

						<?php if ( has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('large'); ?>
						<?php endif; ?>

						<?php the_content(); ?>
					</article>
				<?php endwhile; ?>

				<?php endif; ?>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
