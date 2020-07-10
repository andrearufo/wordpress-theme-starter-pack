<?php get_header(); ?>

<div id="heading">
	<div class="container">

		<h1><span><?php the_archive_title() ?></span></h1>

	</div>
</div>

<div id="archive">
	<div class="container">

		<?php
		$post_type = $wp_query->query['post_type'];
		$servizi = get_terms('servizi', ['hide-empty'=>true]);
		?>

		<ul id="archive-menutaxonomy">
			<?php foreach ($servizi as $servizio) : ?>
				<li>
					<a href="#<?php echo $servizio->slug ?>">
						<?php echo $servizio->name ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

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

				<div class="archive-settore" id="<?php echo $servizio->slug ?>">

					<h2><?php echo $servizio->name ?></h2>

					<div class="archive-settore-list">
						<div class="row">

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-lg-6">

									<?php

									$cliente = get_field('cliente');
									$cliente = $cliente[0];
									$permalink = get_the_permalink($cliente->ID) ?: '#';

									?>

									<div class="archive-settore-list-item">
										<article <?php post_class() ?>>

											<a href="<?php echo $permalink ?>">
												<?php
												if ($post_type == 'clienti' && $logo = get_field('logo')):
													echo wp_get_attachment_image($logo, '800x600');
												else:
													the_post_thumbnail('800x600');
												endif;
												?>

												<div class="archive-settore-list-item-extra">
													<?php echo $cliente->post_title ?>
												</div>

												<h3><?php the_title() ?></h3>

											</a>

										</article>
									</div>

								</div>
							<?php endwhile; ?>

						</div>
					</div>

				</div>
				<?php

			endif;

		endforeach;

		?>

	</div>
</div>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
