<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <article <?php post_class() ?>>

        <?php the_title('<h1>', '</h1>') ?>

        <?php if( has_post_thumbnail() ) : ?>

            <div><?php the_post_thumbnail() ?></div>

        <?php endif; ?>

        <?php the_content() ?>

    </article>

<?php endwhile; endif; ?>
