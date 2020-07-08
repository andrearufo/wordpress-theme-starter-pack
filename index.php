<?php get_header(); ?>

<div class="container">

	<p class="lead">Pagina in costruzione... i contenuti sono linkati a tiolo di esempio. Mica ve lo devo dire?</p>

	<?php if( have_posts() ) :  while( have_posts() ) : the_post(); ?>

		<h2>Clienti</h2>

		<?php
		$args = [
			'post_type' => 'clienti',
			'posts_per_page' => -1,
		];

		$query = new WP_Query($args);
		if ( $query->have_posts() ) :

			?>

			<ul>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li>
						<a href="<?php the_permalink() ?>">
							<?php the_title() ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>

			<?php

		endif;

		wp_reset_query();
		wp_reset_postdata();

		?>

		<hr>

		<h2>Lavori</h2>

		<?php
		$args = [
			'post_type' => 'lavori',
			'posts_per_page' => -1,
		];

		$query = new WP_Query($args);
		if ( $query->have_posts() ) :

			?>

			<ul>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li>
						<a href="<?php the_permalink() ?>">
							<?php the_title() ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>

			<?php

		endif;

		wp_reset_query();
		wp_reset_postdata();

		?>

		<hr>

		<h2>Settori</h2>

		<?php
		$terms = get_terms('settori');
		?>

		<ul>
			<?php foreach ($terms as $term) : ?>
				<li>
					<a href="<?php the_permalink() ?>">
						<?php echo $term->name; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<hr>

		<h2>Servizi</h2>

		<?php
		$terms = get_terms('servizi');
		?>

		<ul>
			<?php foreach ($terms as $term) : ?>
				<li>
					<a href="<?php the_permalink() ?>">
						<?php echo $term->name; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
