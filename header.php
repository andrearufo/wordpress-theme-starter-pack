<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head() ?>

	<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri() ?>/images/logo.svg">

</head>
<body <?php body_class() ?>>

	<header>
		<div class="container">

			<div class="header-wrapper">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="logo">
					<img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
				</a>

				<?php

				if( has_nav_menu('mainmenu') ) :
					wp_nav_menu([
						'menu' => 'mainmenu',
						'theme_location' => 'mainmenu',
						'menu_id' => 'mainmenu',
						'container' => 'nav',
						'container_class' => 'mainmenu-wrapper',
						'depth' => 1
					]);
				endif;

				?>
			</div>

		</div>
	</header>
