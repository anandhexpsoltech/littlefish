<?php if( get_field('social_facebook', 'option') ): ?>
	<a class="fa fa-facebook facebook" href="<?php the_field('social_facebook', 'option'); ?>" target="_blank"></a>
<?php endif; ?>

<?php if( get_field('social_instagram', 'option') ): ?>
	<a class="fa fa-instagram instagram" href="<?php the_field('social_instagram', 'option'); ?>" target="_blank"></a>
<?php endif; ?>

<?php if( get_field('social_linkedin', 'option') ): ?>
	<a class="fa fa-linkedin linkedin" href="<?php the_field('social_linkedin', 'option'); ?>" target="_blank"></a>
<?php endif; ?>

<?php if( get_field('social_youtube', 'option') ): ?>
	<a class="fa fa-youtube-play youtube" href="<?php the_field('social_youtube', 'option'); ?>" target="_blank"></a>
<?php endif; ?>

<?php if( get_field('social_email', 'option') ): ?>
	<a class="fa fa-envelope email" href="mailto:<?php the_field('social_email', 'option'); ?>?subject=<?php the_field('social_email_subject', 'option'); ?>" target="_blank"></a>
<?php endif; ?>
