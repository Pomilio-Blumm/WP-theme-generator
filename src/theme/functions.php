<?php
// Start remembering everything that would normally be outputted, but don't quite do anything with it yet.
ob_clean();
ob_start();
/**
 * pb functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pb
 */
if (!function_exists('pb_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function pb_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on pb, use a find and replace
         * to change 'pb' to the name of your theme in all the template files.
         */
        load_theme_textdomain('pb', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'pb'),
            'menu-2' => esc_html__('Top', 'pb'),
            'menu-3' => esc_html__('Secondary Top', 'pb'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('pb_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }

endif;
add_action('after_setup_theme', 'pb_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pb_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('pb_content_width', 640);
}

add_action('after_setup_theme', 'pb_content_width', 0);

/**
 * Delete A Field from Your Comment Form
 *
 * @link https://developer.wordpress.org/reference/hooks/comment_form_default_fields/
 */
function remove_website_field($fields)
{
    unset($fields['url']);
    return $fields;
}

add_filter('comment_form_default_fields', 'remove_website_field');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pb_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'pb'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'pb'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'pb_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function pb_scripts()
{
    $version = uniqid();

    /*
     * Styles
     */
    /* wp_enqueue_style('pb-style', get_stylesheet_uri());
    wp_enqueue_style('pb-bootstrap', get_template_directory_uri() . '/assets/styles/vendors/bootstrap.min.css', array(), '4.1.3', 'all');
    wp_enqueue_style('pb-fontawesome-all', get_template_directory_uri() . '/assets/styles/vendors/fontawesome-all.min.css', array(), '5.0.13', 'all');
    wp_enqueue_style('pb-google-fonts-montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700', null);
    wp_enqueue_style('pb-google-fonts-exo', 'https://fonts.googleapis.com/css?family=Exo:300,400,500,600', null);
    wp_enqueue_style('pb-animate', get_template_directory_uri() . '/assets/styles/vendors/animate.min.css', array(), $version, 'all');
    wp_enqueue_style('pb-owl.carousel', get_template_directory_uri() . '/assets/styles/vendors/owl.carousel.min.css', array(), $version, 'all');
    wp_enqueue_style('pb-owl.theme.default', get_template_directory_uri() . '/assets/styles/vendors/owl.theme.default.min.css', array(), $version, 'all');
    wp_enqueue_style('pb-aos', get_template_directory_uri() . '/assets/styles/vendors/aos.css', array(), $version, 'all');
    wp_enqueue_style('pb-lightbox-css', get_template_directory_uri() . '/assets/styles/vendors/lightbox.min.css', array(), '2.10.0', 'all');
    wp_enqueue_style('pb-style-custom', get_template_directory_uri() . '/assets/styles/style.min.css', array(), $version, 'all'); */

    /*
     * Scripts
     */

    // deregister default jQuery included with Wordpress
    // wp_deregister_script('jquery');

    /* wp_enqueue_script('pb-jquery', get_template_directory_uri() . '/assets/scripts/vendors/jquery.min.js', array(), $version, false);
    wp_enqueue_script('pb-bootstrap', get_template_directory_uri() . '/assets/scripts/vendors/bootstrap.bundle.min.js', array(), '4.1.3', true);
    wp_enqueue_script('pb-owl.carousel-js', get_template_directory_uri() . '/assets/scripts/vendors/owl.carousel.min.js', array(), '2.3.4', true);
    wp_enqueue_script('pb-aos', get_template_directory_uri() . '/assets/scripts/vendors/aos.js', array(), $version, true);
    wp_enqueue_script('pb-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
    wp_enqueue_script('pb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
    wp_enqueue_script('pb-waypoints', get_template_directory_uri() . '/assets/scripts/vendors/jquery.waypoints.min.js', array(), $version, true);
    wp_enqueue_script('pb-counterup', get_template_directory_uri() . '/assets/scripts/vendors/jquery.counterup.min.js', array(), $version, true);
    wp_enqueue_script('pb-countdown', get_template_directory_uri() . '/assets/scripts/vendors/jquery.countdown.min.js', array(), $version, false);
    wp_enqueue_script('pb-modernizr', get_template_directory_uri() . '/assets/scripts/vendors/modernizr.custom.js', array(), '2.6.2', false);
    wp_enqueue_script('pb-masonry-layout', get_template_directory_uri() . '/assets/scripts/vendors/masonry.pkgd.min.js', array(), '4.2.2', true);
    wp_enqueue_script('pb-imagesloaded', get_template_directory_uri() . '/assets/scripts/vendors/imagesloaded.pkgd.min.js', array(), '4.1.4', true);
    wp_enqueue_script('pb-classie', get_template_directory_uri() . '/assets/scripts/vendors/classie.js', array(), '1.0.1', true);
    wp_enqueue_script('pb-animonscroll', get_template_directory_uri() . '/assets/scripts/vendors/AnimOnScroll.js', array(), $version, true);
    wp_enqueue_script('pb-lightbox-js', get_template_directory_uri() . '/assets/scripts/vendors/lightbox.min.js', array(), '2.10.0', true);
    if (is_page(1609)) { // censipuzzle
        wp_enqueue_script('pb-wordfind', get_template_directory_uri() . '/assets/scripts/vendors/wordfind.js', array(), $version, false);
        wp_enqueue_script('pb-wordfindgame', get_template_directory_uri() . '/assets/scripts/vendors/wordfindgame.js', array(), $version, false);
    }
    wp_enqueue_script('pb-actions', get_template_directory_uri() . '/assets/scripts/actions.min.js', array(), $version, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    } */
}

add_action('wp_enqueue_scripts', 'pb_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom shortcodes for this theme.
 */
require get_template_directory() . '/inc/template-shortcodes.php';

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
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

// Register Custom Navigation Walker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);

function add_classes_on_li($classes, $item, $args)
{
    $classes[] = 'nav-item';

    return $classes;
}

add_filter('wp_nav_menu', 'add_classes_on_a');

function add_classes_on_a($ulclass)
{
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}

// Remove Bootstrap-Components-Button in Tiny-MCE for Editors 

add_filter('mce_buttons_3', 'remove_bootstrap_buttons', 999);

function remove_bootstrap_buttons($buttons)
{
    return array();
}

add_filter('mce_buttons', 'remove_toggle_button', 999);

function remove_toggle_button($buttons)
{
    $remove = array('css_components_toolbar_toggle');
    return array_diff($buttons, $remove);
}