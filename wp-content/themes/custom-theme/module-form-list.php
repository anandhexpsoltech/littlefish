<div class="form-wrap list">
    <div class="bgr btn-list"></div>

    <div class="form">
        <a class="close btn-list fa fa-times aqua size-25" href="#"></a>

        <?php if( get_field('form_title', 'option') ): ?>
            <div class="title">
                <?php the_field('form_title', 'option'); ?>
            </div>
        <?php endif; ?>

        <?php if( get_field('form_subtitle', 'option') ): ?>
            <div class="subtitle">
                <?php the_field('form_subtitle', 'option'); ?>
            </div>
        <?php endif; ?>

        <?php if( get_field('form_background', 'option') ): ?>
        	<?php $image = get_field('form_background', 'option'); ?>

        	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endif; ?>

        <div class="_form_5"></div><script src="<?php echo get_template_directory_uri(); ?>/js/activehosted.min.js" type="text/javascript" charset="utf-8"></script>

        <div class="notice">
            <i class="fa fa-lock lock aqua size-20" aria-hidden="true"></i>

            <?php _e('Your Information will never be shared with any third party', 'html5blank'); ?>
        </div>
    </div>
</div>
