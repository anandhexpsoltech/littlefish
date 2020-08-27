<style>
    <?php if(get_field('menu_link_color', 'option')): ?>
        .page-template-template-home .header .nav li a {
            color: <?php the_field('menu_link_color', 'option'); ?>;
        }

        .page-template-template-home .header .nav li a:hover {
            color: <?php the_field('menu_link_color_hover', 'option'); ?>;
        }
    <?php endif; ?>

    <?php if(get_field('form_button_color_sidebar', 'option')): ?>
        .widget.optin .btn {
            color: <?php the_field('form_button_color_sidebar', 'option'); ?>;
        }
    <?php endif; ?>

    <?php if(get_field('form_button_background_color_sidebar', 'option')): ?>
        .widget.optin .btn {
            background-color: <?php the_field('form_button_background_color_sidebar', 'option'); ?>;
        }
    <?php endif; ?>

    <?php if(get_field('form_button_background_color_sidebar_hover', 'option')): ?>
        .widget.optin .btn:hover {
            background-color: <?php the_field('form_button_background_color_sidebar_hover', 'option'); ?>;
        }
    <?php endif; ?>

    <?php if(get_field('form_button_icon', 'option')): ?>
        .form-wrap.list form button::before,
        button.btn.orange span {
            background-image: url(<?php the_field('form_button_icon', 'option'); ?>) !important;
        }
    <?php endif; ?>

    <?php if( get_field('testimonial_icon', 'option') ): ?>
        <?php $image = get_field('testimonial_icon', 'option'); ?>

        .plyr--video .plyr__control--overlaid,
        .plyr--video .plyr__control--overlaid:hover {
            background-image: url(<?php echo $image['url']; ?>);
            background-color: transparent;
            background-size: cover;
            box-shadow: none;
        }

        .plyr--video .plyr__control--overlaid svg {
            opacity: 0;
        }

        .plyr > .plyr--video .plyr__control--overlaid::before {
            background-color: <?php the_field('testimonial_icon_color', 'option'); ?>
        }
    <?php endif; ?>

    <?php if(get_field('social_icon_background', 'option')): ?>
        .share-wrap .addtoany_list a {
            background-color: <?php the_field('social_icon_background', 'option'); ?>;
        }
    <?php endif; ?>
</style>
