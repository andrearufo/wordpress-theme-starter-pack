<?php get_header(); ?>

<div id="heading">
	<div class="container">

		<h1><span><?php the_archive_title() ?></span></h1>

	</div>
</div>

<div id="archive">
	<div class="container">

		<?php $settori = get_terms('settori'); ?>

		<ul>
			<?php foreach ($settori as $settore) : ?>
				<li>
					<a href="#<?php echo $settore->slug ?>">
						<?php echo $settore->name ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php foreach ($settori as $settore) : ?>
			<div class="archive-settore" id="<?php echo $settore->slug ?>">

				<h2><?php echo $settore->name ?></h2>

				<?php
				$args = [
					'post_type' => $wp_query->query['post_type'],
					'posts_per_page' => -1,
					'tax_query' => [
						[
							'taxonomy' => 'settori',
							'field'    => 'slug',
							'terms'    => $settore->slug,
						],
					],
				];

				$query = new WP_Query($args);
				if ( $query->have_posts() ) :

					?>

					<div class="archive-settore-list">
						<div class="row">

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-lg-6">

									<div class="archive-settore-list-item">
										<article <?php post_class() ?>>

											<a href="<?php the_permalink() ?>">
												<?php the_post_thumbnail('800x600') ?>

												<ul>
													<?php

													$settori = get_the_terms(get_the_ID(), 'settori');
													if ($settori) :

														?>
														<li>
															<ul>
																<?php foreach ($settori as $settore): ?>
																	<li><?php echo $settore->name ?></li>
																<?php endforeach; ?>
															</ul>
														</li>
														<?php

													endif;

													?>

													<?php

													$servizi = get_the_terms(get_the_ID(), 'servizi');
													if ($servizi) :

														?>
														<li>
															<ul>
																<?php foreach ($servizi as $servizio): ?>
																	<li><?php echo $servizio->name ?></li>
																<?php endforeach; ?>
															</ul>
														</li>
														<?php

													endif;

													?>
												</ul>

												<h3><?php the_title() ?></h3>
											</a>

										</article>
									</div>

								</div>
							<?php endwhile; ?>

						</div>
					</div>

				<?php endif; ?>

			</div>
		<?php endforeach; ?>

	</div>
</div>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
