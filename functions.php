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
		get_template_directory_uri() . '/dis/styles/main.css',
		array('fonts', 'style'),
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
		get_template_directory_uri() . '/dis/scripts/bootstrap.min.js',
		array('jquery', 'tether'),
		'4.0.0-alpha.5',
		true
	);
	
	wp_enqueue_script(
		'main',
		get_template_directory_uri() . '/dis/scripts/main.js',
		array('jquery', 'bootstrap'),
		'0.1',
		true
	);

	wp_enqueue_script(
		'acfpromaps',
		get_template_directory_uri() . '/dis/scripts/acfpromaps.js',
		array('googleapis'),
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

/* Custom pagination */

function custom_pagination($numpages = '', $pagerange = '', $paged='') {
	
	if (empty($pagerange)) {
		$pagerange = 2;
	}

	/**
	 * This first part of our function is a fallback
	 * for custom pagination inside a regular loop that
	 * uses the global $paged and global $wp_query variables.
	 * 
	 * It's good because we can now override default pagination
	 * in our theme, and use this function in default quries
	 * and custom queries.
	 */
	 
	global $paged;
	
	if (empty($paged)) {
		$paged = 1;
	}
	
	if ($numpages == '') {
		global $wp_query;
	
		$numpages = $wp_query->max_num_pages;
	
		if(!$numpages) {
			$numpages = 1;
		}
	}
	
	/** 
	 * We construct the pagination arguments to enter into our paginate_links
	 * function. 
	 */
	 
	$pagination_args = array(
		'base'			=> get_pagenum_link(1) . '%_%',
		'format'		=> 'page/%#%',
		'total'			=> $numpages,
		'current'		=> $paged,
		'show_all'		=> False,
		'end_size'		=> 1,
		'mid_size'		=> $pagerange,
		'prev_next'		=> True,
		'prev_text'		=> '<i class="fa fa-arrow-circle-left"></i>',
		'next_text'		=> '<i class="fa fa-arrow-circle-right"></i>',
		'type'			=> 'plain',
		'add_args'		=> false,
		'add_fragment'	=> ''
	);
	
	$paginate_links = paginate_links($pagination_args);
	
	if ($paginate_links) {
	
		echo '<nav class="custom-pagination">';
	
	//	echo '<span class="page-numbers page-num">Pagina ' . $paged . ' di ' . $numpages . '</span> ';
		echo $paginate_links;
	
		echo '</nav>';
	
	}
	
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
	
function odd_post_thumbnail_url($size = 'large', $id = null){

	if( is_null($id) ) $id = $post->id;

	$thumb_id = get_post_thumbnail_id( $id );
	$image = wp_get_attachment_image_src( $thumb_id, $size );

	return $image[0];

}

function odd_post_thumbnail($size = 'large', $attr = null){

	if( is_null($attr) ){
		$attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size",
			'alt'	=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )),
		);
	}

	if ( has_post_thumbnail() ) {
	
		the_post_thumbnail($size, $attr);
	
	}else{

		$default = get_field('default_post_thumbnail', 'option');
		echo '<img class="'.$attr['class'].'" alt="'.$default['alt'].'" src="'.$default['sizes'][$size].'">';
	
	} 

}

/* Posts correlati */

function related_posts() {
	global $post;
	$tags = wp_get_post_tags( $post->ID );

	if($tags) {
	
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
	
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 3, // Set the amount of posts you wish to display
			'post__not_in' => array($post->ID)
		);
	
		$related_posts = get_posts( $args );
	
		if($related_posts) {
			
			echo '<h4 class="text-uppercase">'._('Forse potrebbe interessarti anche...').'</h4>';
		
			foreach ( $related_posts as $post ) : 

				setup_postdata( $post ); 
				get_template_part('part-articlebox');

			endforeach;

			wp_reset_postdata();

		}
	}
}