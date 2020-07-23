<?php get_header(); ?>

<div id="heading">
	<div class="container">

		<div class="row">
			<div class="col-lg-8">

				<h1><span><?php the_archive_title() ?></span></h1>

			</div>
			<div class="col-lg-4">

				<?php /*/ ?>
				<?php
				$post_type = $wp_query->query['post_type'];
				$settori = get_terms('settori', ['hide-empty'=>true]);
				?>

				<ul id="heading-submenu">
				<?php foreach ($settori as $settore) : ?>
				<li>
				<a href="#<?php echo $settore->slug ?>">
				<?php echo $settore->name ?>
				</a>
				</li>
				<?php endforeach; ?>
				</ul>
				<?php /*/ ?>

			</div>
		</div>

	</div>
</div>

<div id="clienti-clienti">
	<div class="container">

		<?php

		$args = [
			'post_type' => 'clienti',
			'posts_per_page' => -1
		];

		$query = new WP_Query($args);

		if ( $query->have_posts() ) :

			?>

			<section>
				<div class="row align-items-center">

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-lg-3">

							<article <?php post_class() ?>>
								<a href="<?php the_permalink() ?>">

									<?php
									if ($logo = get_field('logo')):
										echo wp_get_attachment_image($logo, '800x600');
									elseif(has_post_thumbnail()):
										the_post_thumbnail('800x600');
									else:
										echo '<img src="https://placehold.it/800x600&text=Mandarino" />';
									endif;
									?>

								</a>
							</article>

						</div>
					<?php endwhile; ?>

				</div>
			</section>

			<?php

		endif;

		?>

	</div>
</div>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
