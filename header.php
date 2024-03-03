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

			<div class="row align-items-center">
				<div class="col-lg-1">
				
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>" height="24">
					</a>

				</div>
				<div class="col">

					<?php
					if (has_nav_menu('mainmenu')) :
						wp_nav_menu([
							'menu' => 'mainmenu',
							'theme_location' => 'mainmenu',
							'menu_id' => 'mainmenu',
							'depth' => 1
						]);
					endif;
					?>

				</div>
				<div class="col-lg-3">

					<form id="searchform" class="d-flex" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="s" value="<?php echo get_search_query(); ?>">
						<button class="btn btn-outline-primary" type="submit">Search</button>
					</form>

				</div>
			</div>

		</div>
	</header>

	<main>