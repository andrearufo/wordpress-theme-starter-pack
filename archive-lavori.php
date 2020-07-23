<?php get_header(); ?>

<div id="heading">
	<div class="container">

		<div class="row">
			<div class="col-lg-8">

				<h1>
					<span>
						Cosa facciamo
					</span>
				</h1>

			</div>
			<div class="col-lg-4">

				<?php
				$post_type = $wp_query->query['post_type'];
				$servizi = get_terms('servizi', ['hide-empty'=>true]);
				?>

				<ul id="heading-submenu">
					<?php foreach ($servizi as $servizio) : ?>
						<li>
							<a href="#<?php echo $servizio->slug ?>">
								<?php echo $servizio->name ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>
		</div>

	</div>
</div>

<div id="lavori">
	<div class="container">

		<?php

		foreach ($servizi as $servizio) :

			$args = [
				'post_type' => $post_type,
				'posts_per_page' => -1,
				'tax_query' => [
					[
						'taxonomy' => 'servizi',
						'field'    => 'slug',
						'terms'    => $servizio->slug,
					],
				],
			];

			$query = new WP_Query($args);

			if ( $query->have_posts() ) :

				?>

				<section>
					<div class="lavori-settore" id="<?php echo $servizio->slug ?>">

						<h2><span><?php echo $servizio->name ?></span></h2>

						<div class="lavori-settore-list">
							<div class="row justify-content-center">

								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<div class="col-lg-4">
										<div class="lavori-settore-list-item">

											<?php

											$infos = get_lavoro_infos();

											?>

											<article <?php post_class() ?>>
												<a href="<?php echo $infos['permalink'] ?>">

													<div class="lavori-settore-list-item-img">
														<?php
														if(has_post_thumbnail()):
															the_post_thumbnail('800x600');
														else:
															echo '<img src="https://placehold.it/800x600&text=Mandarino" />';
														endif;
														?>
													</div>

													<div class="lavori-settore-list-item-content">
														<?php echo $infos['cliente']->post_title ?>

														<h3><?php the_title() ?></h3>
													</div>

												</a>
											</article>

										</div>
									</div>
								<?php endwhile; ?>

							</div>
						</div>

					</div>
				</section>

				<?php

			endif;

		endforeach;

		?>

	</div>
</div>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
