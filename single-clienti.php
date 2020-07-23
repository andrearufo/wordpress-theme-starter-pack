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

	$query = new WP_Query($args);
	if ( $query->have_posts() ) :
		$list = [];

		while ( $query->have_posts() ) :
			$query->the_post();

			$id = get_the_ID();
			$servizi = get_the_terms(get_the_ID(), 'servizi');

			foreach ($servizi as $servizio) {
				if (!isset($list[$servizio->slug])) {

					$list[$servizio->slug] = [
						'lavoro' => $id,
						'servizio' => $servizio->name
					];

				}
			}

		endwhile;

	else :

		$list = false;

	endif;

	wp_reset_query();
	wp_reset_postdata();

	?>

	<div id="cliente">
		<article <?php post_class() ?>>

			<div id="cliente-header">

				<div id="cliente-header-img">
					<?php the_post_thumbnail('1920') ?>
				</div>

				<div id="cliente-header-content">
					<div class="container">

						<div class="row align-items-center">
							<div class="col-lg-8">

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

								<?php the_content() ?>

							</div>
							<div class="col-lg-4">

								<?php if ($list): ?>
									<ul id="cliente-header-content-elenco">
										<?php foreach ($list as $value): ?>
											<li>
												<a href="#lavoro-<?php echo $value['lavoro'] ?>">
													<?php echo $value['servizio'] ?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>

							</div>
						</div>

					</div>
				</div>

			</div>

			<?php

			$query = new WP_Query($args);
			if ( $query->have_posts() ) :

				?>
				<div id="cliente-lavori">

					<ul id="cliente-lavori-list">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>

							<li class="cliente-lavori-list-item" id="lavoro-<?php echo get_the_ID() ?>">

								<section>
									<div <?php post_class() ?>>
										<div class="container">

											<div class="row justify-content-between">
												<div class="col-lg-12">

													<div class="cliente-lavori-list-item-meta">
														<?php
														$servizi = get_the_terms(get_the_ID(), 'servizi');
														if ($servizi){
															$s = [];
															foreach ($servizi as $servizio) {															// code...
																$s[] = $servizio->name;
															}
															echo implode(', ', $s);
														}
														?>

														<?php if (get_field('anno')): ?>
															<span class="px-1">—</span>
															<?php the_field('anno') ?>
														<?php endif; ?>
													</div>

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
									</div>
								</section>

								<?php if( have_rows('media') ): ?>
									<ul class="cliente-lavori-list-item-media">

										<?php while( have_rows('media') ) : the_row(); ?>
											<li class="cliente-lavori-list-item-media-item">

												<?php get_template_part('part-media-'.get_row_layout()); ?>

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

		<?php

		$query = new WP_Query([
			'post_type' => 'clienti',
			'posts_per_page' => 2,
			'post__not_in' => [get_the_ID()],
			'orderby' => 'rand',
		]);

		if ( $query->have_posts() ) :

			?>

			<div id="cliente-nav">
				<div class="container text-center">
					<h4>Altri lavori interessanti</h4>
				</div>

				<div class="row no-gutters">

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-md">

							<div class="cliente-nav-item">
								<a href="<?php the_permalink() ?>">

									<?php echo the_post_thumbnail('1200') ?>

									<div class="cliente-nav-item-label">
										<div>
											<div><?php the_title() ?></div>
											<div class="discover">Dettagli</div>
										</div>
									</div>

								</a>
							</div>

						</div>
					<?php endwhile; ?>

				</div>
			</div>

			<?php

		endif;

		wp_reset_query();
		wp_reset_postdata();

		?>

	</div>
<?php endwhile; endif; ?>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
