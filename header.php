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
<body <?php body_class() ?>>

	<header>
		<div class="container">

			<div class="row">
				<div class="col-lg-1">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri() ?>/images/favicon.png" alt="<?php bloginfo('name'); ?>">
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
						endif;

						?>
					</nav>

				</div>
			</div>

		</div>
	</header>

	<main>
		<div class="container">
