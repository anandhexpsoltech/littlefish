<?php
    $args = array(
        'meta_key' => 'field_594555',
        'meta_value' => 'Yes'
    );

    // The Query
    $page_id = get_the_ID();
    $comments_query = new WP_Comment_Query;
    $comments = $comments_query->query($args);
?>

<?php if ($comments) : ?>
    <div class="featured-comments">
        <?php foreach ($comments as $comment) : ?>
            <?php
                $author_id =  $comment->user_id;
                $page_comment_id =  $comment->comment_post_ID;
            ?>

            <?php if ($page_id == $page_comment_id) : ?>
                <div class="comment-body">
                    <div class="comment-author vcard">
                        <?php if( get_field('user_avatar', 'user_'.$author_id) ): ?>
                            <img src="<?php the_field('user_avatar', 'user_' . $author_id); ?>"/>
                        <?php endif; ?>
                    </div>

                    <div class="comment-wrap">
                        <p class="author" style="color: <?php the_field('user_color', 'user_' . $author_id); ?>">
                            <?php echo $comment->comment_author; ?>

                            <span class="comment-meta commentmetadata">
                                <?php printf( __('%1$s %2$s'), get_comment_date(), get_comment_time()); ?>
                            </span>
                        </p>

                        <?php comment_text(); ?>

                        <div class="reply">
                            <?php
                                $id = 'comment_' . $comment->comment_ID;
                            ?>

                            <span class="btn-featured <?php the_field('field_594555', $comment); ?>" data-comment="<?php echo $id; ?>" data-value="<?php echo $featured; ?>"></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
