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

						<?php if( get_field('social_email', 'option') ): ?>
							<p>
								<?php the_field('social_email', 'option'); ?>
							</p>
						<?php endif; ?>

						<?php if(get_field('menu_phone', 'option')): ?>
							<p>
								<a class="phone" href="tel:<?php the_field('menu_phone', 'option'); ?>">
									<?php the_field('menu_phone_text', 'option'); ?>
								</a>
							</p>
						<?php endif; ?>

						<h3 class="title margin-top">
							<?php _e('Visit us', 'html5blank'); ?>
						</h3>

						<?php
							$location = get_field('contact_address', 18);
							$address = $location['address'];
						?>

						<p>
							<?php if(get_field('contact_address_custom', 18)): ?>
								<?php the_field('contact_address_custom', 18); ?>
							<?php else: ?>
								<?php echo $address; ?>
							<?php endif; ?>
						</p>
					</div>

					<div class="col col-3">
						<h3 class="title">
							<?php _e('More information', 'html5blank'); ?>
						</h3>

						<?php wp_nav_menu( array('menu' => 'Footer Menu 1' )); ?>
					</div>

					<div class="col col-4">
						<h3 class="title">
							<?php _e('Services', 'html5blank'); ?>
						</h3>

						<?php wp_nav_menu( array('menu' => 'Footer Menu 2' )); ?>
					</div>

					<div class="col col-5">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
					</div>

					<div class="col col-6">
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

		<?php get_template_part('module-form-popup'); ?>

		<?php //get_template_part('module-form-list'); ?>

		<?php get_template_part('module-custom-css'); ?>

		<?php get_template_part('module-avatars'); ?>
	</body>
</html>
