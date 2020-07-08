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
		<div class="container-fluid">

			<div class="row justify-content-between align-items-center">
				<div class="col-lg">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="logo">
						<img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
					</a>

				</div>
				<div class="col-lg">

					<div id="hamburger">
						<button type="button" class="btn btn-dark">
							<i class="ri-menu-3-line"></i>
						</button>
					</div>

				</div>
			</div>

		</div>
	</header>

	<nav>
		<?php
		if( has_nav_menu('mainmenu') ) :
			wp_nav_menu([
				'theme_location' => 'mainmenu',
				'container_class' => 'menu-wrapper',
				'depth' => 1
			]);
		endif;
		?>
	</nav>
