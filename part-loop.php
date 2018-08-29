<?php if( have_posts() ) : ?>
    <div class="post-list">

        <?php while( have_posts() ) : the_post(); ?>

            <article <?php post_class() ?>>

                <?php
                the_title(
                    (is_single())?'<h1>':'<h2>',
                    (is_single())?'</h1>':'</h2>'
                )
                ?>

                <p><a href="<?php the_permalink() ?>"><?php the_permalink() ?></a></p>

                <?php if( has_post_thumbnail() ) : ?>

                    <div class="article-thumbnail"><?php the_post_thumbnail() ?></div>

                <?php endif; ?>

                <div class="article-content"><?php (is_single()) ? the_content() : the_excerpt(); ?></div>

                <hr>

            </article>

        <?php endwhile; ?>

        <div class="pages">
            <?php echo paginate_links([
                'type' => 'list',
                'end_size' => 2,
                'mid_size' => 2,
                'prev_text' => __('Prev'),
                'next_text' => __('Next'),
            ]); ?>
        </div>

    </div>
<?php endif; ?>
