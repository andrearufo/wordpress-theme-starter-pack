<?php get_header(); ?>

<div id="homepage">
    <div class="container">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <article <?php post_class() ?>>

    			<h1><?php the_title() ?></h1>
    			<div><?php the_excerpt() ?></div>

			</article>

        <?php endwhile; endif; ?>

    </div>
</div>

<?php get_footer() ?>
