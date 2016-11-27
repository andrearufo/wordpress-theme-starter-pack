<?php get_header(); ?>
	
	<div class="wrapper-content">

		<div class="breadcrumbs hidden-md-down">
			<div class="container">
				
				<div typeof="BreadcrumbList" vocab="http://schema.org/">
				    <?php if(function_exists('bcn_display')) bcn_display(); ?>
				</div>

			</div>
		</div>

		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		
		<article <?php post_class() ?>>
		
			<div class="hero">
	
				<div class="background" style="background-image: url(<?= mndr_post_thumbnail_url('screen') ?>)"></div>
				<div class="hover"></div>
				<div class="content">
					<div class="container">

						<div class="row">
							<div class="col-md-8 offset-md-2">
						
								<h1><?php the_title() ?></h1>

								<?php the_field('introduzione') ?>

							</div>
						</div>
					
					</div>
				</div>

			</div>
			
			<div class="text">
				<div class="container">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
				
							<?php the_content() ?>

							<?php 

								if( is_single() and get_post_type( get_the_ID() ) == 'soggetto' )
									get_template_part('part-problemi');
								
							?>

							<?php if( get_field('cta_active') ) : ?>
								
								<a class="btn btn-block btn-primary" href="<?php the_field('cta_link') ?>">
									<?php the_field('cta_label') ?>
								</a>

							<?php endif; ?>

						</div>
					</div>
				
				</div>
			</div>

		</article>

		<?php endwhile; endif; ?>

	</div>

	<?php 

		if( get_field('correlati') )
			get_template_part('part-correlati');
	?>

<?php get_footer(); ?>