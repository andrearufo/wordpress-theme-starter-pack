<?php get_header() ?>

<header>
	<div class="container">

		<div class="row align-items-center">
			<div class="col-lg-1">

				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<?php bloginfo('name'); ?>
					<!-- <img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>"> -->
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

<hr>

<main>

	<div>

		<h1>Theme</h1>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore autem nihil deserunt in ad non veritatis voluptatibus consequatur repudiandae consequuntur! Expedita id repellendus consequuntur! Quidem temporibus odit laudantium quisquam excepturi.</p>

	</div>


</main>

<footer id="footer">
	<div class="container">

		<div class="row justify-content-center text-center">
			<div class="col-lg-3">

				<?php bloginfo('name'); ?> &copy; <?php echo date('Y') ?>

			</div>
			<div class="col-lg-3">

				Made by <a href="https://axio.studio/">axio.studio</a>

			</div>
			<div class="col-lg-3">

				<a href="https://github.com/axiostudio/wordpress-theme-starter-pack">Visit the repo</a>

			</div>
		</div>

	</div>
</footer>
<?php get_footer() ?>