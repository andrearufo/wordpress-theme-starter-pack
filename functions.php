<?php
/**
* wtsp functions and definitions
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
* @package wtsp
*/

// /* Starting the session... if you need */
// function register_my_session(){
//     if( !session_id() ) {
//         session_start();
//     }
// }
// add_action('init', 'register_my_session');

if ( ! function_exists( 'wtsp_setup' ) ) :
    /**
    * Sets up theme defaults and registers support for various WordPress features.
    *
    * Note that this function is hooked into the after_setup_theme hook, which
    * runs before the init hook. The init hook is too late for some features, such
    * as indicating support for post thumbnails.
    */
    function wtsp_setup() {
        /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on wtsp, use a find and replace
        * to change 'wtsp' to the name of your theme in all the template files.
        */
        load_theme_textdomain( 'wtsp', get_template_directory() . '/languages' );

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

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support( 'html5',[
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);
    }

endif;
add_action( 'after_setup_theme', 'wtsp_setup' );

// Function to change email address
function wpb_sender_email( $original_email_address ) {
    return 'no-reply@wordpress.test';
}
add_filter( 'wp_mail_from', 'wpb_sender_email' );

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return get_bloginfo('name'); //ex. 'Wordpress Test';
}
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

/* Add the default style and some other */
add_action( 'wp_enqueue_scripts', 'wtsp_my_styles_method');
function wtsp_my_styles_method() {

    wp_enqueue_style(
        'style',
        get_stylesheet_uri()
    );

    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css',
        false,
        '5.15.3'
    );

    wp_enqueue_style(
        'icons',
        get_template_directory_uri() . '/dist/icons/icons.css',
        ['style'],
        '20210422'
    );

    wp_enqueue_style(
        'slick-carousel',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css',
        false,
        '1.9.0'
    );

    wp_enqueue_style(
        'slick-carousel-theme',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css',
        ['slick-carousel'],
        '1.9.0'
    );

    wp_enqueue_style(
        'main',
        get_template_directory_uri() . '/dist/styles/main.css',
        ['style', 'fontawesome', 'icons'],
        '20210422'
    );

}

/* Add some js scripts */
add_action( 'wp_enqueue_scripts', 'wtsp_my_scripts_method');
function wtsp_my_scripts_method() {

    wp_enqueue_script( 'jquery' );

    wp_enqueue_script(
        'slick',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js',
        ['jquery'],
        '1.9.0',
        true
    );

    wp_enqueue_script(
        'main',
        get_template_directory_uri() . '/dist/scripts/main.js',
        ['jquery', 'slick'],
        '20210422',
        true
    );

}

/* Enamble custom thumbnail sizes */
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( '1920', 1920 );
    add_image_size( '1200', 1200 );
    add_image_size( '1200x1200', 1200, 1200, true );
    add_image_size( '800x600', 800, 600, true );
}

function unset_images_sizes( $sizes ){
    unset( $sizes[ 'thumbnail' ]);
    unset( $sizes[ 'medium' ]);
    unset( $sizes[ 'large' ]);
    unset( $sizes[ 'full' ] );

    return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'unset_images_sizes' );

/* Customize the excerpt lenght */
add_filter( 'excerpt_more', 'wtsp_new_excerpt_more' );
function wtsp_new_excerpt_more( $more ) {
    return '…';
}

/* Enable custom menu */
add_action( 'init', 'wtsp_register_my_menu' );
function wtsp_register_my_menu( ) {
    register_nav_menu( 'mainmenu', 'Main menu of the theme');
}

function wtsp_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'wtsp_content_width', 1200 );
}
add_action( 'after_setup_theme', 'wtsp_content_width', 0 );

/* Title Tag */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function wtsp_render_title() { ?>
        <title><?php wp_title( '-', true, 'right' ); ?></title>
    <?php }
    add_action( 'wp_head', 'wtsp_render_title' );
}

/* Archive title */
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }elseif ( is_tax() ){
        $title = single_term_title( '', false );
    }
    return $title;
});
