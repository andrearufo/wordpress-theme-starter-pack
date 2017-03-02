<?php
	
/* Add the default style and some other */

add_action( 'wp_enqueue_scripts', 'odd_my_styles_method');
function odd_my_styles_method() {
	
	wp_enqueue_style( 
		'style', 
		get_stylesheet_uri()
	);
	
	wp_enqueue_style(
		'main',
		get_template_directory_uri() . '/dist/styles/main.css',
		array('style'),
		'0.1'
	);
	
	wp_enqueue_style(
		'font-awesome',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
		array(),
		'4.7.0'
	);
	
}

/* Add some js scripts */

add_action( 'wp_enqueue_scripts', 'odd_my_scripts_method');
function odd_my_scripts_method() {

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script(
		'tether',
		'https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js',
		array('jquery'),
		'1.3.7',
		true
	);
	
	wp_enqueue_script(
		'bootstrap',
		get_template_directory_uri() . '/dist/scripts/bootstrap.min.js',
		array('jquery', 'tether'),
		'4.0.0-alpha.5',
		true
	);
	
	wp_enqueue_script(
		'main',
		get_template_directory_uri() . '/dist/scripts/main.min.js',
		array('jquery', 'bootstrap'),
		'0.1',
		true
	);
	
}

/* Enamble custom thumbnail sizes */

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full', 1920 );
}
add_theme_support( 'post-thumbnails' );

/* Customize the excerpt lenght */

add_filter( 'excerpt_more', 'odd_new_excerpt_more' );
function odd_new_excerpt_more( $more ) {
	return '…';
}

/* Enable custom menu */

add_action( 'init', 'odd_register_my_menu' );
function odd_register_my_menu( ) {
	register_nav_menu( 'mainmenu', 'Main menu of the theme');
}

/* Add some theme support */
	
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
function odd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'odd_content_width', 1200 );
}
add_action( 'after_setup_theme', 'odd_content_width', 0 );

/* Get the post thumbnail url */

function odd_post_thumbnail_url($size = 'large', $id = null){

	if( is_null($id) ) $id = $post->id;

	$thumb_id = get_post_thumbnail_id( $id );
	$image = wp_get_attachment_image_src( $thumb_id, $size );

	return $image[0];

}