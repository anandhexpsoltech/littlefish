<?php
/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 900, 500, true); // Large Thumbnail
    add_image_size('medium', 600, '', true); // Medium Thumbnail
    add_image_size('small', 500, 500, true); // Small Thumbnail
    add_image_size('sidebar', 300, 300, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    add_image_size('carousel', 500, 325, true); // Project Carousel
    add_image_size('testimonial', 1280, 400, true); // Testimonial Carousel
    add_image_size('news-home', 500, 280, true); // News Home

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Navigation
function html5blank_nav() {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load Scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr');

		wp_register_script('meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.min.js', array('jquery'), '2.0.6');
		//wp_enqueue_script('meanmenu');

        wp_register_script('wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '1.1.3');
        wp_enqueue_script('wow');

		wp_register_script('stickyheader', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '1.0.0');
        wp_enqueue_script('stickyheader');

        wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.jscroll.js', array('jquery'), '1.0.0');
        wp_enqueue_script('infinitescroll');

        wp_register_script('slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.0.0');
        wp_enqueue_script('slick');

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0');
        wp_enqueue_script('html5blankscripts');
    }
}

// Load Conditional Scripts
function html5blank_conditional_scripts()
{
    if (is_page_template('template-home.php')) {
        wp_register_script('home', get_template_directory_uri() . '/js/home.js', array('jquery'), '1.0.0');
        wp_enqueue_script('home');

        wp_register_script('project-carousel', get_template_directory_uri() . '/js/carousel-projects.js', array('jquery'), '1.0.0');
        wp_enqueue_script('project-carousel');
    }

    if (is_page_template('template-whoweare.php') || is_page_template('template-management.php')) {
        wp_register_script('project-carousel-about', get_template_directory_uri() . '/js/carousel-projects.js', array('jquery'), '1.0.0');
        wp_enqueue_script('project-carousel-about');
    }

    if (is_singular( 'client' )) {
        wp_register_script('dropzone', get_template_directory_uri() . '/js/dropzone.js', array('jquery'), '1.0.0');
        wp_enqueue_script('dropzone');

        wp_register_style('dropzonecss', get_template_directory_uri() . '/css/dropzone.css', array(), '1.0.0', 'all');
        wp_enqueue_style('dropzonecss');

        wp_register_script('numeric', get_template_directory_uri() . '/js/signature/numeric-1.2.6.min.js', array('jquery'), '1.2.6');
        wp_enqueue_script('numeric');

        wp_register_script('bezier', get_template_directory_uri() . '/js/signature/bezier.js', array('jquery'), '1.0.0');
        wp_enqueue_script('bezier');

        wp_register_script('signaturepad', get_template_directory_uri() . '/js/signature/jquery.signaturepad.js', array('jquery'), '1.0.0');
        wp_enqueue_script('signaturepad');

        wp_register_script('html2canvas', get_template_directory_uri() . '/js/signature/html2canvas.js', array('jquery'), '0.4.1');
        wp_enqueue_script('html2canvas');

        wp_register_script('json2', get_template_directory_uri() . '/js/signature/json2.min.js', array('jquery'), '1.0.0');
        wp_enqueue_script('json2');

        wp_register_script('soon', get_template_directory_uri() . '/js/soon.min.js', array('jquery'), '1.11.0');
        wp_enqueue_script('soon');

        wp_register_style('sooncss', get_template_directory_uri() . '/css/soon.css', array(), '1.11.0', 'all');
        wp_enqueue_style('sooncss');

        wp_register_script('tabs', get_template_directory_uri() . '/js/jquery.tabslet.js', array('jquery'), '1.0.0');
        wp_enqueue_script('tabs');

        wp_register_script('lightbox', get_template_directory_uri() . '/js/lightgallery.min.js', array('jquery'), '1.0.0');
        wp_enqueue_script('lightbox');

        wp_register_style('lightboxcss', get_template_directory_uri() . '/css/lightgallery.css', array(), '2.0.6', 'all');
        wp_enqueue_style('lightboxcss');

        wp_register_script('mixitup', get_template_directory_uri() . '/js/mixitup.min.js', array('jquery'), '1.0.0');
        wp_enqueue_script('mixitup');

        wp_register_script('client', get_template_directory_uri() . '/js/client.js', array('jquery'), '1.0.0');
        wp_enqueue_script('client');

        wp_enqueue_script('comments', get_template_directory_uri() . '/js/comments.js', array('jquery'), '1.0.2', true);
        wp_localize_script('comments', 'object', array( 'ajax_url' => admin_url('admin-ajax.php')));
    }

    if (is_page_template('template-contact.php') || is_singular( 'project' )) {
        wp_register_script('googlemapapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBjczDQ0CHAV9SUiCKx-rH4wlR4EZF5OgU&extension=.js', array('jquery'), '1.0.0');
        wp_enqueue_script('googlemapapi');

        wp_register_script('map', get_template_directory_uri() . '/js/map.js', array('jquery'), '1.0.0');
        wp_enqueue_script('map');
    }

    if (is_page_template('template-management.php')) {
        wp_register_script('management', get_template_directory_uri() . '/js/management.js', array('jquery'), '1.0.0');
        wp_enqueue_script('management');
    }
}

// Load Styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize');

	wp_register_style('meanmenucss', get_template_directory_uri() . '/css/meanmenu.css', array(), '2.0.6', 'all');
	//wp_enqueue_style('meanmenucss');

    wp_register_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '3.5.2', 'all');
	wp_enqueue_style('animate');

    wp_register_style('slickcss', get_template_directory_uri() . '/css/slick.css', array(), '2.0.6', 'all');
    wp_enqueue_style('slickcss');

    wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.7.0', 'all');
    wp_enqueue_style('fontawesome');

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
    wp_enqueue_style('html5blank');

}

// Register Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank') // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    global $current_user;

	$user_role = array_shift($current_user->roles);
    $user_ID = $current_user->ID;
	$classes[] = 'user-id-' . $user_ID;

    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'name' => __('Single Article Sidebar', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __('Blog Sidebar', 'html5blank'),
        'id' => 'widget-area-5',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __('Footer Area 1', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __('Footer Area 2', 'html5blank'),
        'id' => 'widget-area-3',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 30;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    //return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read More', 'html5blank') . '</a>';
    return '';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>

	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
        <?php $comment = get_comment();
        $author_id =  $comment->user_id; ?>
        <?php if( get_field('user_avatar', 'user_'.$author_id) ): ?>
            <img src="<?php the_field('user_avatar', 'user_' . $author_id); ?>"/>
        <?php endif; ?>
	    <?php printf(__('<p><cite class="fn">%s</cite>'), get_comment_author_link()) ?>
        <span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
    		<?php
    			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
    		?>
    	</span></p>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>
    <?php if(get_field('featured', $comment) == 'No'): ?>
        <?php $featured = 'Yes'; ?>
    <?php else: ?>
        <?php $featured = 'No'; ?>
    <?php endif; ?>

    <div class="comment-wrap <?php the_field('featured', $comment); ?>">
        <?php comment_text(); ?>

        <div class="reply">
            <?php
                $id = 'comment_' . $comment->comment_ID;
                $user_id = apply_filters('determine_current_user', false);
                $views = array();

                if(get_field('viewed_by', $comment, false)) {
                    $views = get_field('viewed_by', $comment, false);
                }

                if (in_array($user_id, $views)) {
                    $class = 'active';
                }
            ?>

            <div class="seen-by">
                <p>
                    <?php _e('Seen by: '); ?>
                </p>

                <?php foreach ($views as $view) : ?>
                    <img src="<?php the_field('user_avatar', 'user_' . $view); ?>" />
                <?php endforeach; ?>
            </div>

            <span class="btn-featured <?php the_field('featured', $comment); ?>" data-comment="<?php echo $id; ?>" data-value="<?php echo $featured; ?>"></span>

            <span class="sep"></span>

            <span class="btn-thumb <?php echo $class; ?>" data-comment="<?php echo $id; ?>"></span>

            <span class="sep"></span>

            <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    </div>

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_post_type_html5()
{
    register_post_type('project',
        array(
        'labels' => array(
            'name' => __('Featured', 'html5blank'),
            'singular_name' => __('Featured', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Featured', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Featured', 'html5blank'),
            'new_item' => __('New Featured', 'html5blank'),
            'view' => __('View Featured', 'html5blank'),
            'view_item' => __('View Featured', 'html5blank'),
            'search_items' => __('Search Featured', 'html5blank'),
            'not_found' => __('No Featured found', 'html5blank'),
            'not_found_in_trash' => __('No Featured found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ),
        'can_export' => true
    ));

    register_post_type('client',
        array(
        'labels' => array(
            'name' => __('Projects', 'html5blank'),
            'singular_name' => __('Project', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Project', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Project', 'html5blank'),
            'new_item' => __('New Project', 'html5blank'),
            'view' => __('View Projects', 'html5blank'),
            'view_item' => __('View Project', 'html5blank'),
            'search_items' => __('Search Projects', 'html5blank'),
            'not_found' => __('No Projects found', 'html5blank'),
            'not_found_in_trash' => __('No Projects found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => false,
        'exclude_from_search' => true,
        'supports' => array(
            'title',
            'comments'
        ),
        'can_export' => true
    ));

    register_post_type('testimonial',
        array(
        'labels' => array(
            'name' => __('Testimonials', 'html5blank'),
            'singular_name' => __('Testimonial', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Testimonial', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Testimonial', 'html5blank'),
            'new_item' => __('New Testimonial', 'html5blank'),
            'view' => __('View Testimonials', 'html5blank'),
            'view_item' => __('View Testimonial', 'html5blank'),
            'search_items' => __('Search Testimonials', 'html5blank'),
            'not_found' => __('No Testimonials found', 'html5blank'),
            'not_found_in_trash' => __('No Testimonials found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'supports' => array(
            'title'
        ),
        'can_export' => true
    ));
}

/*------------------------------------*\
	Add First/Last Class to Menu
\*------------------------------------*/

function html5_first_and_last_menu_class($items) {
    $items[1]->classes[] = 'first';
    $items[count($items)]->classes[] = 'last';
    return $items;
}
add_filter('wp_nav_menu_objects', 'html5_first_and_last_menu_class');


/*------------------------------------*\
 ACF Options Page
\*------------------------------------*/

if ( function_exists( 'acf_add_options_page' ) ) {
    $parent = acf_add_options_page( array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'redirect'   => 'Theme Settings',
        'menu_slug'  => 'options',
    ) );

    acf_add_options_sub_page( array(
        'page_title' => 'Global Options',
        'menu_title' => __('Global Options', 'html5blank'),
        'menu_slug'  => 'global-options',
        'parent'     => $parent['menu_slug']
    ) );

}

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyBjczDQ0CHAV9SUiCKx-rH4wlR4EZF5OgU');
}

add_action('acf/init', 'my_acf_init');

function my_acf_input_admin_footer() { ?>
    <script type="text/javascript">
        (function($) {
            acf.add_filter('color_picker_args', function( args, $field ){
            	// do something to args
            	args.palettes = ['#2ec0c0', '#f4627e', '#8e9196']
            	// return
            	return args;
            });
        })(jQuery);
    </script>
<?php }

add_action('acf/input/admin_footer', 'my_acf_input_admin_footer');

/*------------------------------------*\
 Login Page
\*------------------------------------*/

function custom_login_style() {
    wp_register_style('logincss', get_template_directory_uri() . '/css/login.css', array(), '1.0.0', 'all');
    wp_enqueue_style('logincss');
}

function custom_login_message( $message ) {
    if ( empty($message) ){
        return "<div class='login-message'>Log in below and enjoy the ride</div>";
    } else {
        return $message;
    }
}

function custom_login_labels() {
	function custom_username_label( $translated_text, $text, $domain ) {
		if ('Username or Email Address' === $text) {
			$translated_text = __( 'Username or Email' , 'html5blank' );
		}
		return $translated_text;
	}

	add_filter('gettext', 'custom_username_label', 20, 3);
}

add_filter('login_message', 'custom_login_message');
add_action('login_enqueue_scripts', 'custom_login_style');
add_action('login_head', 'custom_login_labels');

/*------------------------------------*\
 Menu Items
\*------------------------------------*/

add_filter('wp_nav_menu_items', 'add_loginout_link', 10, 2);

function add_loginout_link($items, $args) {
    if ($args->theme_location == 'header-menu') {
        if (is_user_logged_in()) {
            $items .= '<li><a href="'. get_option('siteurl') .'/my-projects/">My Projects</a></li>';
            $items .= '<li class="login"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
        } else {
            $items .= '<li class="login"><a href="'. wp_login_url(get_permalink()) .'">'. __("Log In") .'</a></li>';
        }
    }
    return $items;
}

/**
 * Redirect user after successful login.
 */

function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

/*------------------------------------*\
	Remove Slug From CPT
\*------------------------------------*/

function na_remove_slug($post_link, $post, $leavename) {
    if ('project' != $post->post_type && 'client' != $post->post_type || 'publish' != $post->post_status) {
        return $post_link;
    }

    $post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);

    return $post_link;
}
add_filter('post_type_link', 'na_remove_slug', 10, 3);

function na_parse_request($query) {
    if (!$query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'])) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set('post_type', array('post', 'project', 'client', 'page'));
    }
}
add_action('pre_get_posts', 'na_parse_request');

/* Custom Redirect */

function custom_redirect($content) {
    global $post;

    if(($post->post_type == 'client' && !is_user_logged_in()) || is_page_template('template-overview.php') && !is_user_logged_in()) {
        wp_redirect( get_home_url() . '/login/' );
        exit;
    }
    return $content;
}

add_filter('wp', 'custom_redirect', 0);

/* Update Comment Fields */

function update_featured_comment() {
    update_field('field_594555', $_POST['comment_value'], $_POST['comment_id']);
    die();
}

add_action('wp_ajax_nopriv_update_featured_comment', 'update_featured_comment');
add_action('wp_ajax_update_featured_comment', 'update_featured_comment');

function update_viewed_comment() {
    $user_id = get_current_user_id();
    $viewed = get_field('viewed_by', $_POST['comment_id'], false);

    if (!in_array($user_id, $viewed)) {
        $viewed[] = $user_id;
    }

    update_field('viewed_by', $viewed, $_POST['comment_id']);
    die();
}

add_action('wp_ajax_nopriv_update_viewed_comment', 'update_viewed_comment');
add_action('wp_ajax_update_viewed_comment', 'update_viewed_comment');

/* Remove Toolbar */

add_filter('show_admin_bar', '__return_false');

/*------------------------------------*\
	Add Wrapper To Iframes
\*------------------------------------*/

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}

add_filter('embed_oembed_html', 'custom_oembed_filter', 10, 4);

function div_wrapper($content) {
    // match any iframes
    $pattern = '~<p><iframe.*</iframe>|<embed.*</embed></p>~';
    preg_match_all($pattern, $content, $matches);

    foreach ($matches[0] as $match) {
        // wrap matched iframe with div
        $wrappedframe = '<div class="video-container">' . $match . '</div>';

        //replace original iframe with new in content
        $content = str_replace($match, $wrappedframe, $content);
    }

    return $content;
}
add_filter('the_content', 'div_wrapper');

/*------------------------------------*\
	Multidimensional array search
\*------------------------------------*/

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

function user_voted($comment){
    global $wpdb;
    $user_id = apply_filters('determine_current_user', false);
    $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM wp_hjsfh3_wc_users_voted WHERE user_id = %d AND comment_id='$comment'", $user_id));

    if($count == 1) {
        $voteClass = 'voted';
    } else {
        $voteClass = 'not-voted';
    }

    return $voteClass;
}

/* Change Notification Email */

function res_fromemail($email) {
    $wpfrom = 'no-reply@littlfishproperties.com.au';
    return $wpfrom;
}

add_filter('wp_mail_from', 'res_fromemail', 1, 1);

/*------------------------------------*\
	Slick Carousel Shortcode
\*------------------------------------*/

// Remove hook for the default shortcode...
remove_shortcode('gallery', 'gallery_shortcode');
// .. and create a new shortcode with the default WordPress shortcode name (tag) for the gallery

add_shortcode('gallery', function($atts) {
    $attrs =
        shortcode_atts(array(
            'slider'              => md5(microtime().rand()), // Slider ID (is per default unique)
            'slider_class_name'   => '', // Optional slider css class
            'ids'                 => '', // Comma separated list of image ids
            'size'                => 'large', // Image format (could be an custom image format)
            'slides_to_show'      => 1,
            'slides_to_scroll'    => 1,
            'dots'                => false,
            'infinite'            => true,
            'speed'               => 300,
            'touch_move'          => true,
            'autoplay'            => false,
            'autoplay_speed'      => 2000,
            'accessibility'       => true,
            'arrows'              => true,
            'center_mode'         => false,
            'center_padding'      => '50px',
            'css_ease'            => 'ease',
            'dots_class'          => 'slick-dots',
            'draggable'           => true,
            'easing'              => 'linear',
            'fade'                => false,
            'focus_on_select'     => false,
            'lazy_load'           => 'ondemand',
            'on_before_change'    => null,
            'pause_on_hover'      => true,
            'pause_on_dots_hover' => false,
            'rtl'                 => false,
            'slide'               => 'div',
            'swipe'               => true,
            'touch_move'          => true,
            'touch_threshold'     => 5,
            'use_css'             => true,
            'vertical'            => false,
            'wait_for_animate'    => true
        ), $atts);

    extract($attrs);

    // Verify if the chosen image format really exist
    if( !in_array($size, get_intermediate_image_sizes()) ) {
        echo 'Image Format <strong>'.$size.'</strong> Not Available!';
        exit;
    }

    // Iterate over attribute array, cleanup and make the array elements JavaScript ready
    foreach($attrs as $key => $attr) {
        // CamelCase the array keys
        $new_key_name = lcfirst(str_replace(array(' ', 'Css'), array('', 'CSS'), ucwords(str_replace('_', ' ', $key))));

        // Remove unnecessary array elements
        if( in_array($key, array('size', 'ids', 'slider_class_name')) || strpos($key, '_') !== false ) {
            unset($attrs[$key]);
        }

        // Fix the type before passing the array elements to JavaScript
        if( is_numeric($attr) ) {
            $attrs[$new_key_name] = (int) $attr;
        } else if( is_bool($attr) || (strpos($attr, 'true') !== false || strpos($attr, 'false') !== false) ) {
            $attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_BOOLEAN);
        } else if( is_int($attr) ) {
            $attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_INT);
        }
    }

    // Create an empty variable for return html content
    $html_output = '';

    // Check if the slider should be unique and do some unique stuff (*optional)
    if( ctype_xdigit($slider) && strlen($slider) === 32 ) {
        $is_unique = true;
    } else {
        $is_unique = false;
    }

    // Build the html slider structure (open)
    $html_output .= '<div class="'.$slider_class_name.' '.$slider.' slider wp-slick-slider">';

    // Iterate over the comma separated list of image ids and keep only the real numeric ids
    foreach( array_filter( array_map(function($id){ return (int) $id; }, explode(',', $ids)) ) as $media_id) {
        // Get the image by media id and build the html div group with the image source, width and height
        if( $image_data = wp_get_attachment_image_src($media_id, $size) ) {
            $html_output .= '<div><div class="image"><img src="'.esc_url($image_data[0]).'" /></div></div>';
        }
    }

    // Close the html slider structure and return the html output
    return $html_output.'</div>';
});

function custom_user_id(){
    if (is_user_logged_in()) {
        global $current_custom_user;
        $current_custom_user = get_current_user_id();
    }
}
add_action('init', 'custom_user_id');

/* Default Page on Login */

function admin_default_page() {
    return '/my-projects';
}

add_filter('login_redirect', 'admin_default_page');

/* Tasks Funcionality 2018-07-11 */

add_action('save_post', 'save_my_metadata');

function save_my_metadata($post){
	global $wpdb;
	$post = get_post($post);

	if($post->post_type == 'client'){
		$user_ids = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$post->ID." AND `meta_key` LIKE 'legal_files_2_%_doc_uploaded_for' ORDER BY meta_id ASC");
		$f = 0;

		foreach($user_ids as $user_id){
			$last_ids = array();
			$last_ids = get_option('action_notn_sent_to');
			//~ echo "<pre>"; print_r($last_ids); echo "</pre>";
			$meta_id = $user_id->meta_id;

			$user_info = get_userdata($user_id->meta_value);

			$header = "MIME-Version: 1.0\n";
			$header .= "Content-Type: text/html; charset=utf-8\n";
            $header .= "From: Little Fish <no-reply@littlefishproperties.com.au>";
			$dueDate = get_post_meta($post->ID,'legal_files_2_'.$f.'_due_date',true);

			$mailcontent = get_option('action_required_email_content');
			if($mailcontent == '' || $mailcontent === null || $mailcontent === false){
				$newMessage = 'A new document(s) has been uploaded to the '.get_the_title($post->ID).' project, action is required ';
				if($dueDate != '' && $dueDate !== false && $dueDate !== null){
					$duedate = date('d-m-Y',strtotime($dueDate));
					$newMessage .= 'before '.$duedate.'.';
				} else {
					$newMessage .= 'ASAP.';
				}
			} else {
				if(strpos($mailcontent, '##due_date##')){
					if($dueDate != '' && $dueDate !== false && $dueDate !== null){
						$duedate = date('d-m-Y',strtotime($dueDate));
					} else {
						$duedate = 'ASAP.';
						if(strpos($mailcontent, 'before ##due_date##')){
							$mailcontent = str_replace('before ##due_date##','##due_date##',$mailcontent);
						}
					}
					$mailcontent = str_replace('##due_date##',$duedate,$mailcontent);
				}
				$mailcontent = nl2br(str_replace(' ', '&nbsp;', $mailcontent), true);
				if(strpos($mailcontent, '##project_name##')){
					$post_title="<a href='' style='text-decoration:none;color: #222222;'>".get_the_title($post->ID)."</a>";
					$mailcontent = str_replace('##project_name##',$post_title,$mailcontent);
				}

				$newMessage = $mailcontent;
				//~ echo $newMessage = nl2br(str_replace(' ', '&nbsp;', $mailcontent), true); die();
			}



			$action_required = get_post_meta($post->ID,'legal_files_2_'.$f.'_action_required',true);

			$name = get_user_meta($user_info->ID,'first_name',true);
			if($action_required == 'Yes'){
				$message = "Hi $name,<br><br>
				$newMessage<br><br>
				<a href='".get_the_permalink($post->ID)."#action-required' target='_blank'>".get_the_permalink($post->ID)."#action-required</a><br>
				-<br>Regards,<br>
				Team Little Fish";
				$subject = '[Action Required] ' . get_the_title($post_id);
			} else {
				$post_info = get_post( $post->ID );
				$message = "Hi $name,<br><br>
				A new file has been uploaded to <a href='' style='text-decoration:none;color: #222222;'>".$post_info->post_title."</a>, click the link below to view and download the file.<br><br>
				<a href='".get_the_permalink($post->ID)."#file-uploaded' target='_blank'>".get_the_permalink($post->ID)."#file-uploaded</a><br>
				-<br>Regards,<br>
				Team Little Fish";
				$subject = '[File Uploaded] ' . get_the_title($post_id);
			}
			$to = $user_info->data->user_email;


			if(!in_array($meta_id, $last_ids)){
				if($action_required == 'Yes'){
					// send the email
					$attachment = get_option('action_required_email_attachment');

					if($attachment != '' && $attachment !== null && $attachment !== false){
						$attachments = array();
						$attachments[] = str_replace(home_url()."/wp-content",WP_CONTENT_DIR,wp_get_attachment_url( $attachment ));
						wp_mail($to, $subject, $message, $header, $attachments);
					} else {
						wp_mail($to, $subject, $message, $header);
					}
				} else {
					$blogusers = get_users('role=Administrator');
					foreach ($blogusers as $user) {
						$admin_email = $user->user_email;
						$admin_ID = $user->ID;
					}
					$subscribed_users = get_post_meta($post->ID,'client_id',true);
					foreach($subscribed_users as $subscriber){
						$subscriber_info = get_user_by( 'ID', $subscriber);
						$to_mail = $subscriber_info->user_email;
						$subscribername = get_user_meta($subscriber,'first_name',true);
						$message = "Hi $subscribername,<br><br>
						A new file has been uploaded to <a href='' style='text-decoration:none;color: #222222;'>".$post_info->post_title."</a>, click the link below to view and download the file.<br><br>
						<a href='".get_the_permalink($post->ID)."#file-uploaded' target='_blank'>".get_the_permalink($post->ID)."#file-uploaded</a><br>
						-<br>Regards,<br>
						Team Little Fish";
						if($subscriber != $admin_ID){
							wp_mail($to_mail, $subject, $message, $header);
						}
					}
				}
				//~ $mail_sent_ids[] = $meta_id;
			}

			$mail_sent_ids = array();
			if($last_ids === false || $last_ids === null || $last_ids == ''){
				$mail_sent_ids[] = $meta_id;
			} else {
				foreach($last_ids as $key=>$value){
					if($value != $meta_id){
						$mail_sent_ids[] = $value;
					}
				}
				$mail_sent_ids[] = $meta_id;
			}
			update_option('action_notn_sent_to',$mail_sent_ids);

			$f++;
		}
		//~ print_r($mail_sent_ids); die();


	}
}

add_action( 'admin_enqueue_scripts', 'load_custom_script' );
function load_custom_script() {
	if(is_admin()){
		wp_enqueue_script('custom_js_script', get_bloginfo('template_url').'/js/custom-script.js', array('jquery'));
	} else {
		return false;
	}
}

function myplugin_add_meta_box() {
	$screens = array( 'client' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'testdiv',
			__( 'Uploaded Files', 'myplugin_textdomain' ),
			'myplugin_meta_box_callback',
			$screen,
			'side'
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box', 2 );

function myplugin_meta_box_callback(){
	global $wpdb;
	$uploaded_files = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."uploaded_doc` where post_id=".$_GET['post']." AND status = 1 ORDER BY `id` DESC");
	if(empty($uploaded_files)){
		echo "-- No file uploaded yet --";
	} else {
		//~ echo "<pre>"; print_r($uploaded_files); echo "</pre>";
		?>
			<ul>
				<?php foreach($uploaded_files as $file){ ?>
					<li><i class="deleteUploaded dashicons dashicons-trash" attachment-id="<?php echo $file->id; ?>"></i><a href="<?php echo wp_get_attachment_url($file->file_id); ?>"><?php echo $file->file_name; ?></a></li>
				<?php } ?>
			</ul>
			<style>
				.deleteUploaded:hover{cursor:pointer;}
				.deleteUploaded.dashicons.dashicons-trash { margin: 0 5px 0 0; }
			</style>
		<?php
	}
}

function my_custom_tooltip() {
	wp_enqueue_script( 'my_custom_script', get_template_directory_uri() . '/js/custom_admin_script.js', array(), '1.0' );
}

add_action('admin_enqueue_scripts', 'my_custom_tooltip');


add_action("wp_ajax_delete_uploaded", "delete_uploaded");
add_action("wp_ajax_nopriv_delete_uploaded", "delete_uploaded");

function delete_uploaded() {
	global $wpdb;
	$id = $_POST['id'];

	if($id != ''){
		$table = $wpdb->prefix.'uploaded_doc';
		if($wpdb->delete( $table, array( 'id' => $id ) )){
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}
	die();
}


add_action("wp_ajax_last_uploaded", "last_uploaded");
add_action("wp_ajax_nopriv_last_uploaded", "last_uploaded");

function last_uploaded() {
	global $wpdb;
	$id = $_POST['metaId'];
	$userId = $_POST['userId'];
	if($id != '' && $userId != ''){
		update_user_meta($userId,'last_selected_file',$id);
		echo 1;
	} else {
		echo 0;
	}
	die();
}

add_action("wp_ajax_downloaded_files", "downloaded_files");
add_action("wp_ajax_nopriv_downloaded_files", "downloaded_files");

function downloaded_files() {
	global $wpdb;
	$metaId = $_POST['metaId'];
	$postId = $_POST['postId'];
	if($metaId != '' && $postId != ''){
		if($wpdb->insert($wpdb->prefix.'uploaded_doc', array('user_id' => get_current_user_id(),'post_id' => $postId,'meta_id' => $metaId, 'status' => 0, 'upload_date' => date('Y-m-d H:i:s')))){
			echo 1;
		} else {
			echo $wpdb->last_error;
			echo 2;
		}
	} else {
		echo 0;
	}
	die();
}

function wpse_288373_register_submenu_page(){
	add_submenu_page('edit.php?post_type=client', __('Email Settings','menu-test'), __('Email Settings','menu-test'), 'read', 'testsettings', 'mt_settings_page');
}
add_action('admin_menu', 'wpse_288373_register_submenu_page');
function mt_settings_page(){ ?>

	<div class="wrap">
		<h1>Email Settings</h1>
		<?php
			if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Update Content'){
				//~ echo "<pre>"; print_r($_REQUEST); echo "</pre>";

				if(!update_option( 'action_required_email_content', $_REQUEST['email_custom_content'] )){ ?>
					<div class='error notice is-dismissible'>
						<p>Error in updating content</p>
						<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
				<?php } else if(!update_option( 'action_required_email_attachment', $_REQUEST['email_custom_attachment'] )){ ?>
					<div class='error notice is-dismissible'>
						<p>Error in updating content</p>
						<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
				<?php } else { ?>
					<div id="message" class="updated notice notice-success is-dismissible">
						<p>Content uploaded Successfully</p>
						<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
				<?php }
			}
			$mailcontent = get_option('action_required_email_content');
			if($mailcontent === null || $mailcontent === false){
				$mailcontent = '';
			}
			$action_required_email_attachment = get_option('action_required_email_attachment');
			if($action_required_email_attachment === null || $action_required_email_attachment === false){
				$action_required_email_attachment = '';
			}
		?>
		<form method="post" action="">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label>Add content Here: </label></th>
						<td>
							<textarea name="email_custom_content" rows="10" cols="100"><?php echo $mailcontent; ?></textarea>
							<p class="description" id="tagline-description">
								Following shortcodes can be used<br>
								##project_name## (For project Name)<br>
								##due_date## (For added due date)
							</p>
						</td>
					</tr>
					<tr>
						<td colspan="2">

						</td>
					</tr>
					<tr>
						<td>Upload attachment:</td>
						<td>
							<?php $mime = get_post_mime_type( $action_required_email_attachment );
							$mime = explode('/',$mime);  ?>
							<div class="uploadedImage">
								<?php if($mime[0] == 'image'){ ?>
									<img src="<?php echo wp_get_attachment_url( $action_required_email_attachment ); ?>" width="250">
								<?php } else {
									echo "File Name: ".get_the_title($action_required_email_attachment).".".$mime[1];
								} ?>
							</div>
							<input id="process_custom_images" class="regular-text set_custom_images" value="" name="email_custom_attachment" type="hidden">
							<button class="set_custom_images button">Select Book</button>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Update Content" name="submit" class="button button-primary button-large"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
<?php }
function include_myuploadscript() {
	/*
	 * I recommend to add additional conditions just to not to load the scipts on each page
	 * like:
	 * if ( !in_array('post-new.php','post.php') ) return;
	 */
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
	wp_enqueue_script( 'myuploadscript', get_template_directory_uri() . '/js/admin.js', array('jquery'), null, false );

}

add_action( 'admin_enqueue_scripts', 'include_myuploadscript' );

function filter_handler( $data , $postarr ) {

	global $wpdb;
	$new_data_arr_acf_files = $_POST['acf']['field_597f3a9afa683'];
	$new_data_arr_acf_files_only = array();
	foreach($new_data_arr_acf_files as $new_data_arr_acf_file){
		$new_data_arr_acf_files_only[] = $new_data_arr_acf_file['field_597f3a9afa686'];
	}

	$old_data_arr_acf_files = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id` = ".$postarr['ID']." AND `meta_key` LIKE 'legal_files_2_%_legal_file'  ORDER BY `meta_id` ASC");
	$old_data_arr_acf_files_only = array();
	$value_different_for_doc_uploaded_for = array();
	$k = 0;
	foreach($old_data_arr_acf_files as $old_data_arr_acf_file){
		if($new_data_arr_acf_files_only[$k] != $old_data_arr_acf_file->meta_value){
			$meta_key_s = 'legal_files_2_'.$k.'_doc_uploaded_for';
			$mid = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $postarr['ID'], $meta_key_s) );
			if( $mid != '' ){
				$value_different_for_doc_uploaded_for[] = $mid[0]->meta_id;
			}
		}
		// $old_data_arr_acf_files_only[] = $old_data_arr_acf_file->meta_value;
		$k++;
	}



	foreach($value_different_for_doc_uploaded_for as $key=>$val){
		$wpdb->update($wpdb->prefix.'uploaded_doc', array('meta_id'=>'0'), array('meta_id'=>$val, 'post_id'=> $postarr['ID']));
	}

	$action_notn_sent_to_old = get_option('action_notn_sent_to');
	$action_notn_sent_to_new = array_values(array_diff($action_notn_sent_to_old, $value_different_for_doc_uploaded_for));

	update_option('action_notn_sent_to',$action_notn_sent_to_new);


	$value_different_for_doc_uploaded_for_u = array();
	$u = 0;
	foreach($old_data_arr_acf_files as $old_data_arr_acf_file){
		if($new_data_arr_acf_files_only[$u] != $old_data_arr_acf_file->meta_value){
			$meta_key_s = 'legal_files_2_'.$u.'_doc_uploaded_for';
			$mid = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $postarr['ID'], $meta_key_s) );
			if( $mid != '' ){
				$value_different_for_doc_uploaded_for_u[] = $mid[0]->meta_id;
			}
		}
		// $old_data_arr_acf_files_only[] = $old_data_arr_acf_file->meta_value;
		$u++;
	}
	$action_notn_sent_to_old_u = get_option('reminder_notn_sent_to');


	$action_notn_sent_to_new_u = array_values(array_diff($action_notn_sent_to_old_u, $value_different_for_doc_uploaded_for_u));
	//~ print_r($action_notn_sent_to_old_u);
	//~ print_r($value_different_for_doc_uploaded_for_u);
	//~ print_r($action_notn_sent_to_new_u);

	//~ die();
	update_option('reminder_notn_sent_to',$action_notn_sent_to_new_u);
	// $old_data = get_post($postarr['ID']);
	return $data;
}

add_filter( 'wp_insert_post_data', 'filter_handler', '8', 2 );

?>
