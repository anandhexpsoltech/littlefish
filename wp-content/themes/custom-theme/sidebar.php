<aside class="sidebar" role="complementary">
	<div class="widget widget_search">
		<?php get_template_part('searchform'); ?>
	</div>

	<div class="widget social-wrap">
		<h3 class="title">
			<?php _e('Socials', 'html5blank'); ?>
		</h3>

		<div class="social large">
		   <?php get_template_part('module-social'); ?>
		</div>
	</div>

	<?php if( get_field('form_background_sidebar1', 'option') ): ?>
		<?php $image = get_field('form_background_sidebar', 'option'); ?>

		<div class="widget optin">
			<?php if( get_field('form_tagline', 'option') ): ?>
				<?php $tagline = get_field('form_tagline', 'option'); ?>

				<img class="tagline" src="<?php echo $tagline['url']; ?>" alt="<?php echo $tagline['alt']; ?>" />
			<?php endif; ?>

			<a class="btn-list normal" href="#">
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			</a>

			<?php if(get_field('form_button_label_sidebar', 'option')): ?>
				<a class="btn orange btn-list normal" href="#">
					<?php if(get_field('form_button_icon_sidebar', 'option')): ?>
						<span style="background-image: url('<?php the_field('form_button_icon_sidebar', 'option'); ?>');"></span>
					<?php endif; ?>

					<?php the_field('form_button_label_sidebar', 'option'); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-5')) ?>
</aside>
