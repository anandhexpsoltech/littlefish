<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

        <meta name="xero-client-id" content="9167A7539B0A453CAA2B34D8F3745C31">
        <meta name="xero-scopes" content="openid profile email files accounting.transactions accounting.transactions.read accounting.reports.read accounting.journals.read accounting.settings accounting.settings.read accounting.contacts accounting.contacts.read accounting.attachments accounting.attachments.read offline_access">
        <meta name="xero-redirect-uri" content="http://localhost/littlefish/xero-callback">

		<?php wp_head(); ?>
	</head>

	<?php if(get_field('fullwidth_website', 'option')): ?>
		<?php $style = get_field('fullwidth_website', 'option'); ?>
	<?php endif; ?>

	<body <?php body_class($style); ?>>
		<?php if (is_page_template('template-home.php')) : ?>
			<?php
				$logo = get_field('website_logo_home', 'option');
				$background = get_field('menu_background', 'option');
			?>
		<?php else: ?>
			<?php
				$logo = get_field('website_logo', 'option');
				$background = '#fff';
			?>
		<?php endif; ?>

		<header id="sticker" class="header clear" role="banner" style="background-color: <?php echo $background; ?>">
			<div class="wrapper">
				<div class="normal">
					<?php if( get_field('website_logo', 'option') ): ?>
						<div class="logo">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo $logo; ?>" alt="Little Fish Properties" class="logo-img">
							</a>

							<?php if(current_user_can('administrator') || current_user_can('editor')) { ?>
								<a class="btn-admin" href="<?php bloginfo('url'); ?>/wp-admin/"></a>
							<?php } ?>
						</div>
					<?php endif; ?>

					<nav class="nav" role="navigation">
						<div class="wrapper menuContainer">
							<?php html5blank_nav(); ?>

							<?php if(get_field('menu_phone', 'option')): ?>
								<li>
									<a class="phone" href="tel:<?php the_field('menu_phone', 'option'); ?>">
										<span class="fa fa-phone size-30 blue"></span>

										<?php the_field('menu_phone_text', 'option'); ?>
									</a>
								</li>
							<?php endif; ?>
                        </div>
					</nav>
				</div>

				<div class="compact">
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img class="first" src="<?php echo get_template_directory_uri(); ?>/img/logo-small.png" alt="Little Fish Properties" class="logo-img">

							<img class="second" src="<?php echo get_template_directory_uri(); ?>/img/logo-small-white.png" alt="Little Fish Properties" class="logo-img">
						</a>

						<?php if(current_user_can('administrator') || current_user_can('editor')) { ?>
							<a class="btn-admin" href="<?php bloginfo('url'); ?>/wp-admin/"></a>
						<?php } ?>
					</div>

					<?php if(get_field('menu_phone', 'option')): ?>
						<li class="phone-wrap">
							<a class="phone" href="tel:<?php the_field('menu_phone', 'option'); ?>">
								<span class="fa fa-phone size-30 blue"></span>

								<?php the_field('menu_phone_text', 'option'); ?>
							</a>
						</li>
					<?php endif; ?>

					<span class="menu">
						<?php _e('Menu', 'html5blank'); ?>
					</span>

					<div class="btn-menu">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>

					<nav class="nav" role="navigation">
						<div class="wrapper menuContainer">
							<?php //html5blank_nav(); ?>

							<?php //wp_nav_menu( array('menu' => 'Header menu (Expanded)', 'menu_class' => 'animatedNo ' )); ?>

							<ul>
								<li class="animated fadeInUp nav-delay-0">
									<a href="<?php bloginfo('url'); ?>" aria-current="page">
										<?php _e('Home', 'html5blank'); ?>
									</a>
								</li>

								<li class="menu-item-has-children animated fadeInUp nav-delay-1">
									<a href="<?php bloginfo('url'); ?>/real-estate-development-process/">
										<?php _e('Services', 'html5blank'); ?>
									</a>

									<ul class="sub-menu">
										<li>
											<a href="<?php bloginfo('url'); ?>/property-development-management-services/">
												<?php _e('Development Management', 'html5blank'); ?>
											</a>
										</li>

										<li>
											<a href="<?php bloginfo('url'); ?>/property-development-project-manager/">
												<?php _e('Project Management', 'html5blank'); ?>
											</a>
										</li>

										<li>
											<a href="<?php bloginfo('url'); ?>/property-development-consultants/">
												<?php _e('Project Consultants', 'html5blank'); ?>
											</a>
										</li>
									</ul>
								</li>

								<li class="animated fadeInUp nav-delay-2">
									<a href="<?php bloginfo('url'); ?>/real-estate-development-process/">
										<?php _e('Process', 'html5blank'); ?>
									</a>
								</li>

								<li class="animated fadeInUp nav-delay-3">
									<a href="<?php bloginfo('url'); ?>/about-us/">
										<?php _e('About us', 'html5blank'); ?>
									</a>
								</li>

								<li class="animated fadeInUp nav-delay-4">
									<a href="<?php bloginfo('url'); ?>/featured-projects/">
										<?php _e('Featured projects', 'html5blank'); ?>
									</a>
								</li>

								<li class="animated fadeInUp nav-delay-5">
									<a href="<?php bloginfo('url'); ?>/property-development-blog/">
										<?php _e('Blog', 'html5blank'); ?>
									</a>
								</li>

								<li class="animated fadeInUp nav-delay-6">
									<a href="<?php bloginfo('url'); ?>/contact/">
										<?php _e('Contact us', 'html5blank'); ?>
									</a>
								</li>

								<?php if (is_user_logged_in()) : ?>
									<li class="animated fadeInUp nav-delay-7">
										<a href="<?php bloginfo('url'); ?>/my-projects/">
											<?php _e('My projects', 'html5blank'); ?>
										</a>
									</li>

									<li class="login animated fadeInUp nav-delay-8">
										<a href="<?php bloginfo('url'); ?>/wp-login.php?action=logout&amp;_wpnonce=4849e66291">
											<?php _e('Log out', 'html5blank'); ?>
										</a>
									</li>
								<?php else : ?>
						            <li class="login animated fadeInUp nav-delay-7">
										<a href="<?php bloginfo('url'); ?>/login/">
											<?php _e('Log in', 'html5blank'); ?>
										</a>
									</li>
						        <?php endif; ?>

								<li class="bg"></li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</header>
