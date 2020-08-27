<?php

namespace WP_Business_Reviews_Bundle\Includes;

class Collection_Serializer {

    protected $post_type = 'brb_collection';

    public function __construct() {
        add_action('admin_post_brb_collection_save', array($this, 'collection_save'), 30);
    }

    public function collection_save() {

        $raw_data_array = wp_unslash($_POST[$this->post_type]);

        $post_id = wp_insert_post(array(
            'ID'           => $raw_data_array['post_id'],
            'post_title'   => $raw_data_array['title'],
            'post_content' => $raw_data_array['content'],
            'post_type'    => $this->post_type,
            'post_status'  => 'publish',
        ));
        wp_safe_redirect(
            add_query_arg(array(
                'brb_collection_id' => $post_id,
            ), wp_get_referer())
        );
        exit;
    }

}
