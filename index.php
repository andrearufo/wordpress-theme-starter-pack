<?php get_header(); ?>


	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

		<article <?php post_class() ?>>
			<div class="jumbotron">

				<h2 class="display-3">
					<?php the_title() ?>
				</h2>

				<?php the_content() ?>

			</div>
		</article>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
