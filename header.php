<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- icons -->
	<link href="<?php echo get_template_directory_uri() ?>/images/favicon.png" rel="icon" type="image/png" />
	<link href="<?php echo get_template_directory_uri() ?>/images/favicon.png" rel="apple-touch-icon" />

	<!-- wp head -->
	<?php wp_head() ?>

</head>
<body>

	<header>
		<div class="container">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo('name'); ?>
			</a>

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

	<main>
		<div class="container">
