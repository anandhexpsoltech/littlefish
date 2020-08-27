<div class="comments">
	<?php if (post_password_required()) : ?>
		<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'html5blank' ); ?></p>
	<?php return; endif; ?>

	<?php if (have_comments()) : ?>

		<ul class="message-display">
			<?php wp_list_comments('type=comment&callback=html5blankcomments'); // Custom callback in functions.php ?>
		</ul>

	<?php elseif ( !have_comments() ) : ?>
		<p><?php _e( 'There are currently no comments on the message board.', 'html5blank' ); ?></p>
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p><?php _e( 'Comments are closed here.', 'html5blank' ); ?></p>

	<?php endif; ?>

	<?php $comments_args = array(
		'fields' =>  '',
		'comment_notes_before' => '',
        'label_submit'=>'Submit',
        'title_reply'=>'Leave a message',
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
		'logged_in_as' => false,
	);?>

	<?php comment_form($comments_args); ?>
</div>
