<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php is_front_page() ? bloginfo('description') : wp_title(''); ?>, <?php bloginfo('name'); ?></title>

	<!-- icons -->
	<link href="<?php echo get_template_directory_uri() ?>/images/favicon.png" rel="icon" type="image/png" />
	<link href="<?php echo get_template_directory_uri() ?>/images/favicon.png" rel="apple-touch-icon" />

	<!-- wp head -->
	<?php wp_head() ?>

</head>
<body>

	<div class="container">

      	<div class="header clearfix py-3">
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
        	<h3 class="text-muted">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo('name'); ?>
				</a>
			</h3>
      	</div>
