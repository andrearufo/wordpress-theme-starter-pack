<?php get_header(); ?>

<div id="heading">
	<div class="container">

		<div class="row">
			<div class="col-lg-8">

				<h1><span><?php the_archive_title() ?></span></h1>

			</div>
			<div class="col-lg-4">

				<?php $settori = get_terms('settori', ['hide-empty'=>true]); ?>

				<ul id="heading-submenu">
					<?php foreach ($settori as $settore) : ?>
						<li>
							<a href="#<?php echo $settore->slug ?>">
								<?php echo $settore->name ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>
		</div>

	</div>
</div>

<div id="clienti">
	<div class="container">

		<?php foreach ($settori as $settore): ?>

			<section id="<?php echo $settore->slug ?>">

				<h2><?php echo $settore->name ?></h2>

				<?php

				$args = [
					'post_type' => 'clienti',
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

					<div class="clienti-list">

						<div class="row">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>

								<div class="col-6 col-lg-3">

									<div class="clienti-list-item">
										<a href="<?php the_permalink() ?>" <?php post_class() ?>>

											<div class="clienti-list-item-name">
												<?php the_title() ?>
											</div>

										</a>
									</div>

								</div>

							<?php endwhile; ?>
						</div>

					</div>

					<?php

				endif;

				?>
			</section>

		<?php endforeach; ?>

	</div>
</div>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
