<?php get_header(); ?>

<div class="container">
	<?php if ( have_posts() ) : ?>

		<div class="content">

			<ul class="posts-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<li>

						<article <?php post_class() ?>>

							<?php if (has_post_thumbnail()): ?>

								<div class="content-thumbnail">
									<?php the_post_thumbnail('1200') ?>
								</div>

							<?php endif; ?>

							<div class="content-main">
								<div class="content-main-inner">

									<time><?php echo get_the_date() ?></time>
									<h2><?php the_title() ?></h2>

									<div>
										<?php the_excerpt() ?>
									</div>

									<div class="row aling-items-end">
										<div class="col-lg-9 col-6">

											<div class="extrainfo"><strong><?php the_author() ?></strong> in <?php the_category('; ') ?></div>
											<div class="extrainfo"><?php the_tags('', '; ', '') ?></div>

										</div>
										<div class="col-lg-3 col-6">

											<a href="<?php the_permalink() ?>" class="btn btn-outline-primary btn-block">
												<?php _e('Read more...', 'wtsp') ?>
											</a>

										</div>
									</div>

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
