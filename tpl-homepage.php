<?php

/**
* Template name: Home page
*/

get_header();

?>

<div class="container">
    <?php if ( have_posts() ) : ?>

        <div class="content content__homepage">
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

    <?php
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 10,
    ];

    $query = new WP_Query($args);

    if ( $query->have_posts() ) :

        ?>

        <div id="slider">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="px-1">

                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title"><?php the_title() ?></h5>
                            <a href="<?php the_permalink() ?>" class="btn btn-outline-primary"><?php _e('Read more...', 'wtsp') ?></a>

                        </div>
                    </div>

                </div>
            <?php endwhile;  ?>
        </div>

    <?php endif;

    wp_reset_query();
    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
