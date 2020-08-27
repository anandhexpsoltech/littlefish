<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<div class="wou-notification-item" style="display:none;">
    <div class="wou-close-modal"><i class="fas fa-times" aria-hidden="true"></i>&nbsp;</div>
    <div class="wou-ni-left">
        <?php if (($avatar = get_avatar($userInfo["email"], 64))) { ?>
            <div class="wou-user-avatar"><?php echo $avatar; ?></div>
        <?php } ?>
    </div>
    <div class="wou-ni-right">        
        <div class="wou-user-title"><i class="fas fa-circle" aria-hidden="true"></i> &nbsp;<?php echo $userInfo["name"]; ?> <?php _e($this->options->phraseUserIsOnline, "wpdiscuz-ou"); ?></div>
        <?php if ($userInfo["comment"]) { ?>
            <?php $comment = $userInfo["comment"]; ?>
            <div class="wou-user-comment"><span>&ldquo;</span><?php echo wp_trim_words($comment->comment_content, 10); ?><span>&bdquo;</span></div>
            <div class="wou-user-comment-link">
                <a target="_blank" href="<?php echo get_comment_link($comment); ?>"><?php _e($this->options->phraseReadMore, "wpdiscuz-ou"); ?></a>
            </div>
        <?php } ?>
    </div>    
    <input type="hidden" value="<?php echo $user["email"]; ?>" class="wou-notification-item-uuid" />
    <input type="hidden" value="<?php echo $this->options->notificationPopupTimeout; ?>" class="wou-notification-item-time" />
    <div style="clear:both"></div>
</div>

