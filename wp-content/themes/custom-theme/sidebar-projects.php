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

    <div class="widget related">
        <?php get_template_part('loop-projects-related'); ?>
    </div>
</aside>
