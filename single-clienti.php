<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
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

						<ul>
							<li>Inserire qui i servizi associati ai lavori sottostanti e linkare con ancora (scroll)</li>
						</ul>

					</div>
				</div>

			</div>

			<div id="cliente-content">
				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-12">

							<?php the_content() ?>

						</div>
					</div>

				</div>
			</div>

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

			// echo '<pre>'.print_r($args, 1).'</pre>';

			$query = new WP_Query($args);
			if ( $query->have_posts() ) :

				?>
				<div id="cliente-lavori">

					<ul id="cliente-lavori-list">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>

							<li class="cliente-lavori-list-item">
								<article <?php post_class() ?>>

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

									<?php $media_type = get_field('media_type') ?>

									<div id="cliente-lavori-list-item-media">
										<div class="container">

											<?php if ($media_type == 'immagine'): ?>

												<?php $immagine = get_field('immagine') ?>
												<div id="cliente-lavori-list-item-media-image">
													<?php echo wp_get_attachment_image($immagine, '1920') ?>
												</div>

											<?php elseif ($media_type == 'galleria'): ?>

												<?php $galleria = get_field('galleria') ?>

												<div id="cliente-lavori-list-item-media-galleria">
													<?php foreach ($galleria as $immagine) : ?>
														<div class="cliente-lavori-list-item-media-galleria-item">
															<a href="#">
																<?php echo wp_get_attachment_image($immagine, '1200x1200') ?>
															</a>
														</div>
													<?php endforeach; ?>
												</div>

											<?php elseif ($media_type == 'video'): ?>

												<?php $video = get_field('video') ?>
												<div id="cliente-lavori-list-item-media-video">
													<div class="embed-responsive embed-responsive-16by9">
														<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $video ?>?rel=0" allowfullscreen></iframe>
													</div>
												</div>

											<?php endif; ?>

										</div>
									</div>

								</article>
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
