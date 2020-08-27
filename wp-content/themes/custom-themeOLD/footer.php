		<footer class="footer" role="contentinfo">
			<div class="wrapper">
				<div class="columns columns-6">
					<div class="col col-1">
						<a class="logo-footer" href="<?php bloginfo('url'); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo-small-grey.png" alt="Little Fish Properties">
						</a>
					</div>

					<div class="col col-2">
						<h3 class="title">
							<?php _e('Contact us', 'html5blank'); ?>
						</h3>

						<p>info@littlefishproperties.com.au</p>
					</div>

					<div class="col col-3">
						<h3 class="title">
							<?php _e('Visit us', 'html5blank'); ?>
						</h3>

						<?php
							$location = get_field('contact_address', 18);
							$address = $location['address'];
						?>

						<p><?php echo $address; ?></p>
					</div>

					<div class="col col-4">
						<h3 class="title">
							<?php _e('More information', 'html5blank'); ?>
						</h3>

						<p>
							<a href="<?php bloginfo('url'); ?>">
								<?php _e('Home', 'html5blank'); ?>
							</a>

							<a href="<?php bloginfo('url'); ?>/about/">
								<?php _e('About', 'html5blank'); ?>
							</a>
						</p>
					</div>

					<div class="col col-5">
						<p>
							<a href="<?php bloginfo('url'); ?>/blog/">
								<?php _e('News & Insights', 'html5blank'); ?>
							</a>

							<a href="<?php bloginfo('url'); ?>/our-process/">
								<?php _e('Management', 'html5blank'); ?>
							</a>

							<a href="<?php bloginfo('url'); ?>/contact//">
								<?php _e('Contact Us', 'html5blank'); ?>
							</a>
						</p>
					</div>

					<div class="col col-6">
						<?php get_template_part('module-social'); ?>
					</div>
				</div>
			</div>

			<!--<p class="copyright">
				&copy; <?php _e('Copyright', 'html5blank'); ?> <?php bloginfo('name'); ?> <?php echo date('Y'); ?>
			</p>-->

			<span class="scrollup"></span>
		</footer>

		<?php wp_footer(); ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-10127770-11"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-10127770-11');
		</script>

		<div class="overlay"></div>

		<input type="hidden" class="adminAjax" value="<?php echo admin_url( 'admin-ajax.php' );?>">

		<?php get_template_part('module-avatars'); ?>
	</body>
</html>
