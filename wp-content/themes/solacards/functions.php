<?php
/**
 * Solacards functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Solacards
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function solacards_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Solacards, use a find and replace
		* to change 'solacards' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'solacards', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'solacards' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'solacards_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'solacards_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function solacards_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'solacards_content_width', 640 );
}
add_action( 'after_setup_theme', 'solacards_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function solacards_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'solacards' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'solacards' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'solacards_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function solacards_scripts() {
	wp_enqueue_style( 'solacards-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'solacards-style', 'rtl', 'replace' );

	wp_enqueue_script( 'solacards-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'solacards_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_theme_support( 'woocommerce' );


// Header menu

class Custom_Nav_Walker extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="card-header__menu-list">';
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }


    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
         $output .= '<li>';
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}

// footer menu footer__nav

class Custom_Nav_Walker_footer extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<div class="footer__nav">';
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</div>';
    }


    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
      
        $output .= '<a class="footer__nav-link font-16" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

}

// Remove bradcrumb
add_action('wp', function() {
    if (is_product() || is_shop()) {
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }
});

add_action('wp_ajax_get_variation_image', 'get_variation_image_callback');
add_action('wp_ajax_nopriv_get_variation_image', 'get_variation_image_callback');

// Get variation image
function get_variation_image_callback() {
    if (!isset($_POST['variation_id'])) {
        wp_send_json_error(['message' => 'Invalid variation ID']);
    }

    $variation_id = intval($_POST['variation_id']);
    $image_id = get_post_thumbnail_id($variation_id);
    $image_url = wp_get_attachment_image_url($image_id, 'full');

    if ($image_url) {
        wp_send_json_success(['image_url' => $image_url]);
    } else {
        wp_send_json_error(['message' => 'Image not found']);
    }
}

// same product variation item add in cart so automatically remove previous add product
add_filter('woocommerce_add_to_cart_validation', function ($passed, $product_id, $quantity, $variation_id = 0,$variation = []) {
    if (!$variation_id) {
        return $passed;
    }

    $cart = WC()->cart->get_cart();

    foreach ($cart as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
             if (isset($cart_item['variation']['attribute_color'])) {
                 
             }else{
                 // Remove previous variation from cart
                WC()->cart->remove_cart_item($cart_item_key);
             }
        }
    }

    return $passed;
}, 10, 4);

