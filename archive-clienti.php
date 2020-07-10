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
		$settori = get_terms('settori', ['hide-empty'=>true]);
		?>

		<ul id="archive-menutaxonomy">
			<?php foreach ($settori as $settore) : ?>
				<li>
					<a href="#<?php echo $settore->slug ?>">
						<?php echo $settore->name ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php

		foreach ($settori as $settore) :

			$args = [
				'post_type' => $post_type,
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

				<div class="archive-settore" id="<?php echo $settore->slug ?>">

					<h2><?php echo $settore->name ?></h2>

					<div class="archive-settore-list">
						<div class="row">

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-lg-6">

									<?php

									if ($post_type == 'lavori') {
										$cliente = get_field('cliente');
										$cliente = $cliente[0];
										$pemalink = get_the_permalink($cliente->ID);
									}else{
										$permalink = get_the_permalink();
									}

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
													<?php if ($post_type == 'lavori') : ?>

														<?php echo $cliente->post_title ?>

													<?php else: ?>

														<?php $servizi = get_the_terms(get_the_ID(), 'servizi'); ?>

														<ul>
															<?php if ($servizi) : foreach ($servizi as $servizio): ?>
																<li><?php echo $servizio->name ?></li>
															<?php endforeach; endif; ?>
														</ul>

													<?php endif; ?>
												</div>

												<?php if ($post_type != 'clienti') : ?>
													<h3><?php the_title() ?></h3>
												<?php endif; ?>

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
