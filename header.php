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

	<div class="row row-nogutters">
		<header class="header-desk hidden-md-down col-lg-2 col-md-12">

			<div class="wrapper wrapper-fixed">

				<div class="logo">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img 
							src="<?php echo get_template_directory_uri() ?>/images/logo.png" 
							alt="<?php bloginfo('name'); ?>" 
							class="img-fluid hidden-md-down" 
						>
					</a>

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

			</div>
			
		</header>
		<header class="header-mob hidden-lg-up">

			<div class="container py-1">

				<div class="row flex-items-xs-bottom">
					<div class="col-xs-9">

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img 
								src="<?php echo get_template_directory_uri() ?>/images/logo-alt.png" 
								alt="<?php bloginfo('name'); ?>" 
								class="img-fluid" 
							>
						</a>

					</div>
					<div class="col-xs-3 text-xs-right">
						
						<div class="hamburger">
							<span class="fa-stack fa-lg">
								<i class="fa fa-square fa-stack-2x"></i>
								<i class="fa fa-bars fa-stack-1x fa-inverse"></i>
								<i class="fa fa-times fa-stack-1x fa-inverse invisible"></i>
							</span>
						</div>

					</div>
				</div>

			</div>
			
		</header>
		<nav class="nav-mob">
			<div class="bottom">
				<?php
												
				if( has_nav_menu('mainmenu') ) :	
					wp_nav_menu( array(
						'theme_location'	=> 'mainmenu',
						'depth'				=> 1
					)
				);
				endif;
						 				
				?>
			</div>
		</nav>

		<!-- main -->
		<main class="col-lg-10 col-md-12">
			
			<div class="wrapper">
