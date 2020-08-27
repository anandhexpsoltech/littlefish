<?php if(get_field('cta_content', 'option')): ?>
    <div class="box-wrap last animated wow fadeIn">
        <div class="wrapper overflow">
            <?php if(get_field('cta_title', 'option')): ?>
                <div class="title">
                    <h2>
                        <?php the_field('cta_title', 'option'); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <div class="content">
                <?php the_field('cta_content', 'option'); ?>

                <?php if(get_field('button_label', 'option')): ?>
                    <a class="btn orange btn-inquiry" href="#" style="color: <?php the_field('button_label_color', 'option'); ?>; background-color: <?php the_field('button_background_color', 'option'); ?>; border-color: <?php the_field('button_border_color', 'option'); ?>">
                        <?php if(get_field('button_icon', 'option')): ?>
                            <span style="background-image: url('<?php the_field('button_icon', 'option'); ?>');"></span>
                        <?php endif; ?>

                        <?php the_field('button_label', 'option'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
