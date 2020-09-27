<?php get_header(); ?>

<div class="container">
	<?php if ( have_posts() ) : ?>

		<ul class="posts-list">
			<?php while ( have_posts() ) : the_post(); ?>
				<li>

					<article <?php post_class() ?>>

						<h3><?php the_title() ?></h3>
						<div><?php the_excerpt() ?></div>

					</article>

				</li>
			<?php endwhile; ?>
		</ul>

	<?php endif; ?>
</div>

<?php get_footer(); ?>
