<div class="form-wrap normal pinned" style="background-color: <?php the_field('form_pinned_background_color', 'option'); ?>; border-color: <?php the_field('form_pinned_border_color', 'option'); ?>">
    <span class="close fa fa-times grey-light"></span>

    <div class="form">
        <div class="content">
            <?php if( get_field('form_pinned_content', 'option') ): ?>
                <?php the_field('form_pinned_content', 'option'); ?>
            <?php endif; ?>

            <div class="_form_11"></div><script src="https://little-fish.activehosted.com/f/embed.php?id=11" type="text/javascript" charset="utf-8"></script>

            <p class="notice"><a href="<?php get_bloginfo('url'); ?>/privacy-notice/" target="_blank">Privacy policy</a></p>
        </div>
    </div>
</div>
