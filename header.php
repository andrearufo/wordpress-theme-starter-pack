<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head() ?>

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/images/favicons/apple-touch-icon.png">
	<link rel="shortcut icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() ?>/images/favicons/favicon-32x32.png">
	<link rel="shortcut icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() ?>/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri() ?>/images/favicons/site.webmanifest">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() ?>/images/favicons/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">

</head>
<body <?php body_class() ?>>

	<header>
		<div class="container">

			<div class="row">
				<div class="col-lg-1">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
					</a>

				</div>
				<div class="col-lg-11">

					<nav>
						<?php
						if( has_nav_menu('mainmenu') ) :
							wp_nav_menu([
								'theme_location' => 'mainmenu',
								'depth' => 1
							]);
						else:
							echo 'Accedi al pannello per popolare il menu...';
						endif;
						?>
					</nav>

				</div>
			</div>

		</div>
	</header>

	<main>
		<div class="container">
