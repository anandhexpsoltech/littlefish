<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<?php if( get_field('website_favicon', 'option') ): ?>
			<link href="<?php the_field('website_favicon', 'option'); ?>" rel="shortcut icon">
		<?php endif; ?>

		<link href="<?php echo get_template_directory_uri(); ?>/img/touch.png" rel="apple-touch-icon-precomposed">
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

		<?php wp_head(); ?>
	</head>

	<?php if(get_field('fullwidth_website', 'option')): ?>
		<?php $style = get_field('fullwidth_website', 'option'); ?>
	<?php endif; ?>

	<body <?php body_class($style); ?>>
		<header id="sticker" class="header clear" role="banner">
			<div class="wrapper">
				<div class="normal">
					<?php if( get_field('website_logo', 'option') ): ?>
						<div class="logo">
							<a href="<?php echo home_url(); ?>">
								<?php if (is_page_template('template-home.php') && get_field('website_logo_home', 'option')) : ?>
									<img src="<?php the_field('website_logo_home', 'option'); ?>" alt="Little Fish Properties" class="logo-img">
								<?php else :?>
									<img src="<?php the_field('website_logo', 'option'); ?>" alt="Little Fish Properties" class="logo-img">
								<?php endif; ?>
							</a>

							<?php if(current_user_can('administrator')) { ?>
								<a class="btn-admin" href="<?php bloginfo('url'); ?>/wp-admin/"></a>
							<?php } ?>
						</div>
					<?php endif; ?>

					<nav class="nav" role="navigation">
						<div class="wrapper menuContainer">
							<?php html5blank_nav(); ?>

							<li>
								<a class="phone" href="tel:1300 799 277">1300 799 277</a>
							</li>
                        </div>
					</nav>
				</div>

				<div class="compact">
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img class="first" src="<?php echo get_template_directory_uri(); ?>/img/logo-small.png" alt="Little Fish Properties" class="logo-img">

							<img class="second" src="<?php echo get_template_directory_uri(); ?>/img/logo-small-white.png" alt="Little Fish Properties" class="logo-img">
						</a>

						<?php if(current_user_can('administrator')) { ?>
							<a class="btn-admin" href="<?php bloginfo('url'); ?>/wp-admin/"></a>
						<?php } ?>
					</div>

					<li class="phone-wrap">
						<a class="phone" href="tel:1300 799 277">1300 799 277</a>
					</li>

					<div class="btn-menu">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>

					<nav class="nav" role="navigation">
						<div class="wrapper menuContainer">
							<?php html5blank_nav(); ?>
						</div>
					</nav>
				</div>
			</div>

			<?php if(get_field('show_custom_message', 'option')): ?>
				<?php
					$pages = get_field('show_custom_message', 'option');
					$id = get_the_ID();
				?>

				<?php if(in_array($id, $pages) && get_field('custom_message', 'option')) :?>
					<div class="custom-message">
						<div class="wrapper">
							<?php the_field('custom_message', 'option'); ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</header>
