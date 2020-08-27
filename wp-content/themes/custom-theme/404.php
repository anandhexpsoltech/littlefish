<?php get_header(); ?>

	<div class="main-container">
		<div class="wrapper">
			<main role="main" class="fullwidth">
				<article id="post-404">
					<h2>
						<?php _e( 'Not found', 'html5blank' ); ?>
					</h2>

					<span class="separator"></span>

					<h1>
						<?php _e( 'The page you are looking for cannot be found.', 'html5blank' ); ?>
					</h1>

					<span class="separator"></span>

					<h3>
						<?php _e( "We've sent this guy to find out what happened. Tipping he'll get it sorted out pretty quickly.", 'html5blank' ); ?>
					</h3>

					<h3>To head back to safer territory <a href="<?php bloginfo('url'); ?>">click here</a>.</h3>

					<img class="mobile" src="<?php echo get_template_directory_uri(); ?>/img/bgr-404.jpg" alt="">
				</article>
			</main>
		</div>
	</div>

<?php get_footer(); ?>
