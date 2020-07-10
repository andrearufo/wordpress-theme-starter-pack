<?php

/**
* Template name: Home page
*/

get_header();

?>

<div id="homepage">
    <?php
    $args = [
        'post_type' => 'clienti',
        'posts_per_page' => -1,
    ];

    $query = new WP_Query($args);
    if ( $query->have_posts() ) :

        ?>

        <div id="homepage-slider">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <div class="homepage-slider-item">
                    <a href="<?php the_permalink() ?>">

                        <?php the_post_thumbnail('1920') ?>

                        <div class="homepage-slider-item-content">
                            <div class="homepage-slider-item-content-body">

                                <?php

        						$settori = get_the_terms(get_the_ID(), 'settori');
        						if ($settori) :

        							?>
        							<ul class="homepage-slider-item-content-body-pretitle">
        								<?php foreach ($settori as $settore): ?>
        									<li><?php echo $settore->name ?></li>
        								<?php endforeach; ?>
        							</ul>
        							<?php

        						endif;

        						?>
                                <div class="homepage-slider-item-content-body-title"><?php the_title() ?></div>
                                <div class="homepage-slider-item-content-body-discover">Dettagli</div>

                            </div>
                        </div>

                    </a>
                </div>

            <?php endwhile; ?>
        </div>

        <?php

    endif;

    wp_reset_query();
    wp_reset_postdata();

    ?>

    <div id="homepage-gotoprojects">
        <a href="<?php echo get_post_type_archive_link('lavori') ?>">
            Vedi tutti i progetti
        </a>
    </div>

</div>

<?php get_footer() ?>
