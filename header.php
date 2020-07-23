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
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="logo">
			<img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
		</a>
	</header>

	<nav>
		<div class="row no-gutters">
			<div class="col-xl-6 col-lg-8 nav-col-menu">

				<div class="nav-col-menu-inner">
					<div class="nav-col-menu-inner-wrapper">
						<?php
						if( has_nav_menu('mainmenu') ) :
							wp_nav_menu([
								'theme_location' => 'mainmenu',
								'container_class' => 'mainmenu-wrapper',
								'depth' => 1
							]);
						endif;
						?>

						<div id="nav-footer">
							<div id="nav-footer-info">
								Mandarino Adv - P.I. 02345120592
							</div>

							<?php
							if( has_nav_menu('footermenu') ) :
								wp_nav_menu([
									'theme_location' => 'footermenu',
									'container_class' => 'footermenu-wrapper',
									'depth' => 1
								]);
							endif;
							?>
						</div>
					</div>
				</div>

			</div>
			<div class="col-xl-6 col-lg-4 nav-col-outern d-none d-lg-block"></div>
		</div>


	</nav>
