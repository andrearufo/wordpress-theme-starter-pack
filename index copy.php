<?php get_header(); ?>

<div class="container">
	<?php if (have_posts()) : ?>

		<div class="content">

			<ul class="posts-list">
				<?php while (have_posts()) : the_post(); ?>
					<li>

						<article <?php post_class() ?>>

							<?php if (has_post_thumbnail()) : ?>

								<div class="content-thumbnail">
									<?php the_post_thumbnail('1200') ?>
								</div>

							<?php endif; ?>

							<div class="content-main">
								<div class="content-main-inner">

									<time><?php echo get_the_date() ?></time>
									<h2>
										<a href="<?php the_permalink() ?>">
											<?php the_title() ?>
										</a>
									</h2>

									<div>
										<?php the_excerpt() ?>
									</div>

									<div class="row aling-items-end">
										<div class="col-lg-9 col-6">

											<div class="extrainfo"><strong><?php the_author() ?></strong> in <?php the_category('; ') ?></div>
											<div class="extrainfo"><?php the_tags('', '; ', '') ?></div>

										</div>
										<div class="col-lg-3 col-6 text-end">

											<a class="btn btn-primary" href="<?php the_permalink() ?>">
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

			<hr>

			<div class="row text-center">
				<div class="col-lg">
					<?php previous_posts_link('Older posts'); ?>
				</div>
				<div class="col-lg">
					<?php next_posts_link('Newer posts'); ?>
				</div>
			</div>

		</div>

	<?php endif; ?>
</div>

<?php get_footer(); ?>