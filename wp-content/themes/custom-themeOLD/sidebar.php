<aside class="sidebar" role="complementary">
	<div class="sidebar-widget">
		<?php if (is_singular('post')) : ?>
			<?php get_template_part('loop-news'); ?>

			<?php get_template_part('loop-projects'); ?>
		<?php elseif (is_singular('project')) : ?>
			<?php get_template_part('loop-projects'); ?>

			<?php get_template_part('loop-news'); ?>
		<?php elseif (is_home() || is_search() || is_archive()) : ?>
			<?php get_template_part('loop-projects-blog'); ?>
		<?php elseif (is_page_template('template-projects.php')) : ?>
			<?php get_template_part('loop-news'); ?>
		<?php endif; ?>
	</div>
</aside>
