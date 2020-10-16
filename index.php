<?php get_header(); ?>

<div class="container">
	<?php if ( have_posts() ) : ?>

		<div class="content">

			<ul class="posts-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<li>

						<article <?php post_class() ?>>

							<?php if (has_post_thumbnail()): ?>
								<div class="content-thumbnail"><?php the_post_thumbnail('large') ?></div>
							<?php endif; ?>

							<div class="content-main">
								<div class="content-main-inner">

									<time><?php echo get_the_date() ?></time>
									<h1><?php the_title() ?></h1>
									<div><?php the_excerpt() ?></div>
									<a href="<?php the_permalink() ?>" class="btn btn-outline-primary"><?php _e('Read more...', 'wtsp') ?></a>

								</div>
							</div>

						</article>

					</li>
				<?php endwhile; ?>
			</ul>

		</div>

	<?php endif; ?>
</div>

<?php get_footer(); ?>
