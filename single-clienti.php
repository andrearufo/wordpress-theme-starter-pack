<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<?php

	$args = [
		'post_type' => 'lavori',
		'posts_per_page' => -1,
		'meta_query' => [
			[
				'key' => 'cliente',
				'value' => '"' . get_the_ID() . '"',
				'compare' => 'LIKE'
			]
		]
	];

	?>
	<div id="cliente">
		<article <?php post_class() ?>>

			<div id="cliente-header">

				<?php the_post_thumbnail('1920') ?>
				<div id="cliente-header-content">
					<div class="container">

						<?php

						$settori = get_the_terms(get_the_ID(), 'settori');
						if ($settori) :

							?>
							<ul id="cliente-header-content-pretitle">
								<?php foreach ($settori as $settore): ?>
									<li><?php echo $settore->name ?></li>
								<?php endforeach; ?>
							</ul>
							<?php

						endif;

						?>
						<h1><?php the_title() ?></h1>

						<?php

						$query = new WP_Query($args);
						if ( $query->have_posts() ) :
							$list = [];

							while ( $query->have_posts() ) :
								$query->the_post();

								$id = get_the_ID();
								$servizi = get_the_terms(get_the_ID(), 'servizi');

								foreach ($servizi as $servizo) {
									if (!in_array($servizo->name, $list)) {
										$list[$id] = $servizo->name;
									}
								}

							endwhile;
						endif;

						?>

						<ul id="cliente-header-content-elenco">
							<?php foreach ($list as $key => $value): ?>
								<li>
									<a href="#lavoro-<?php echo $key ?>">
										<?php echo $value ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>


					</div>
				</div>

			</div>

			<section id="cliente-content">
				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-12">

							<?php the_content() ?>

						</div>
					</div>

				</div>
			</section>

			<?php

			// echo '<pre>'.print_r($args, 1).'</pre>';

			$query = new WP_Query($args);
			if ( $query->have_posts() ) :

				?>
				<div id="cliente-lavori">

					<ul id="cliente-lavori-list">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>

							<li class="cliente-lavori-list-item" id="lavoro-<?php echo get_the_ID() ?>">

								<section <?php post_class() ?>>
									<div class="container">

										<div class="row justify-content-between">
											<div class="col-lg-4">

												<small class="text-uppercase d-block">
													<?php
													$servizi = get_the_terms(get_the_ID(), 'servizi');
													if ($servizi){
														echo $servizi[0]->name;
													}
													?>
													—
													<?php the_field('anno') ?>
												</small>

											</div>
										</div>
										<div class="row justify-content-between">
											<div class="col-lg-4">

												<h3><?php the_title() ?></h3>

											</div>
											<div class="col-lg-6">

												<?php the_content() ?>

											</div>
										</div>

									</div>
								</section>

								<?php if( have_rows('media') ): ?>
									<ul class="cliente-lavori-list-item-media">

										<?php while( have_rows('media') ) : the_row(); ?>
											<li class="cliente-lavori-list-item-media-item">

												<?php

												// echo '<pre>'.print_r(get_row_layout(), 1).'</pre>';

												switch (get_row_layout()) {
													case 'immagine':
														get_template_part('part-media-immagine');
														break;
													case 'galleria':
														get_template_part('part-media-galleria');
														break;
													case 'video':
														get_template_part('part-media-video');
														break;
													case 'testogrande':
														get_template_part('part-media-testogrande');
														break;
													default:
														echo 'Errore!';
														break;
												}

												?>

											</li>
										<?php endwhile; ?>

									</ul>
								<?php endif; ?>

							</li>
						<?php endwhile; ?>
					</ul>

				</div>
				<?php

			endif;

			wp_reset_query();
			wp_reset_postdata();

			?>

		</article>
	</div>
<?php endwhile; endif; ?>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
