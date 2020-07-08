<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	
	<div id="heading">
		<div class="container">

			<h1><span><?php the_title() ?></span></h1>

		</div>
	</div>

	<div id="page">
		<div class="container">

			<?php the_content() ?>

		</div>
	</div>

<?php endwhile; endif; ?>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
