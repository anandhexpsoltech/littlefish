<div class="form-wrap normal full" style="border-color: <?php the_field('form_border_color', 'option'); ?>; background-color: <?php the_field('form_background_color', 'option'); ?>;">
    <span class="close wow animated btnScroll" style="background-image: url('https://www.littlefishproperties.com.au/wp-content/uploads/2019/10/arrow-expand-blue.png')"></span>

    <div class="form">
        <div class="content">
            <?php if( get_field('form_content', 'option') ): ?>
                <?php the_field('form_content', 'option'); ?>
            <?php endif; ?>

            <div class="_form_5"></div><script src="https://little-fish.activehosted.com/f/embed.php?id=5" type="text/javascript" charset="utf-8"></script>
        </div>

        <?php if( get_field('form_background', 'option') ): ?>
        	<?php $image = get_field('form_background', 'option'); ?>

        	<img class="img" src="<?php echo $image; ?>" alt="Want to Become an Expert in Townhouse Developments?" />
        <?php endif; ?>
    </div>
</div>
