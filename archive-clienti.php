<?php get_header(); ?>

<div id="heading">
	<div class="container">

		<h1><span><?php the_archive_title() ?></span></h1>

	</div>
</div>

<div id="archive" class="archive-clienti">
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

				<section>
					<div class="archive-settore" id="<?php echo $settore->slug ?>">

						<h2><span><?php echo $settore->name ?></span></h2>

						<div class="archive-settore-list">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="archive-settore-list-item">
									<article <?php post_class() ?>>

										<a href="<?php the_permalink() ?>">
											<?php
											if ($post_type == 'clienti' && $logo = get_field('logo')):
												echo wp_get_attachment_image($logo, '800x600');
											else:
												the_post_thumbnail('800x600');
											endif;
											?>

											<div class="archive-settore-list-item-extra">
												<?php $servizi = get_the_terms(get_the_ID(), 'servizi'); ?>
												<ul>
													<?php if ($servizi) : foreach ($servizi as $servizio): ?>
														<li><?php echo $servizio->name ?></li>
													<?php endforeach; endif; ?>
												</ul>
											</div>
										</a>

									</article>
								</div>
							<?php endwhile; ?>
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
