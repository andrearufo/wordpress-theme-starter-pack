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

			<div class="row align-items-center justify-content-between">
				<div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1">
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" id="logo">
						<img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
					</a>
				</div>
				<div class="col-6 col-lg-4">

					<form id="searchform" class="input-group" method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<input type="text" class="form-control" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
						<button class="btn btn-primary" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</form>

				</div>
			</div>

		</div>
	</header>

	<div id="menu">
		<div class="container">
			<div class="nav-wrapper">

				<?php

				if (has_nav_menu('mainmenu')) :
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
	</div>