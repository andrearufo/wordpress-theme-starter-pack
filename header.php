<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	
	<meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	
	<title><?php is_front_page() ? bloginfo('description') : wp_title(''); ?>, <?php bloginfo('name'); ?></title>
	
	<link href="<?php echo get_template_directory_uri() ?>/images/favicon.png" rel="icon" type="image/png" />
	<link href="<?php echo get_template_directory_uri() ?>/images/favicon.png" rel="apple-touch-icon" />
	
	<?php wp_head() ?>
	
</head>
<body <?php body_class() ?>>
	
	<!--[if lt IE 8]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

	<div class="logo display-1">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a>

	</div>

	<nav>
		<?php
										
		if( has_nav_menu('mainmenu') ) :	
			wp_nav_menu( array(
				'theme_location'	=> 'mainmenu',
				'depth'				=> 1
			)
		);
		endif;
				 				
		?>
	</nav>

	<main>
	