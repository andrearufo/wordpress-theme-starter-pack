<?php get_header(); ?>

<div class="container">
    <?php if ( have_posts() ) : ?>

        <div class="content content__single">
            <?php while ( have_posts() ) : the_post(); ?>

                <article <?php post_class() ?>>

                    <?php if (has_post_thumbnail()): ?>
                        <div class="content-thumbnail"><?php the_post_thumbnail('large') ?></div>
                    <?php endif; ?>

                    <div class="content-main">
                        <div class="content-main-inner">

                            <h1><?php the_title() ?></h1>
                            <div><?php the_content() ?></div>
                            
                        </div>
                    </div>

                </article>

            <?php endwhile; ?>
        </div>

    <?php endif; ?>
</div>

<?php get_footer(); ?>
