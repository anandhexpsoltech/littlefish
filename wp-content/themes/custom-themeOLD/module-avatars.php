<?php $users = get_users(); ?>

<style>
    <?php foreach($users as $user) : ?>
        <?php
            $user_id = 'user_' . $user->ID;
            $user_class = '.user-id-' . $user->ID;
        ?>

        <?php if(get_field('user_avatar', $user_id)): ?>
            <?php echo $user_class; ?> #comments #wpcomm .wc-form-wrapper::before {
            	background-image: url('<?php the_field('user_avatar', $user_id); ?>');
            }
        <?php endif; ?>
    <?php endforeach; ?>
<style>
