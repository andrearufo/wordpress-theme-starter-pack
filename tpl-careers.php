<?php

/**
* Template name: Careers
*/

get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<div id="heading">
		<div class="container">

			<h1><span><?php the_title() ?></span></h1>

		</div>
	</div>

	<div id="page">
		<div class="container">

			<?php the_content() ?>

		</div>
	</div>

	<?php if( have_rows('posizioni') ): ?>

		<div id="posizioni">
			<div class="container">

				<?php while( have_rows('posizioni') ) : the_row(); $c++; ?>

					<div class="posizioni-item" data-toggle="modal" data-target="#career-<?php echo $c ?>">
						<div class="posizioni-item-inner">

							<div class="row justify-content-around">
								<div class="col-lg-4">

									<h3><?php the_sub_field('posizione'); ?></h3>

								</div>
								<div class="col-lg-5">

									<div class="posizioni-item-inner-body"><?php the_sub_field('breve'); ?></div>
									<div class="posizioni-item-inner-discover">dettagli</div>

								</div>
							</div>

						</div>
					</div>

					<div class="modal fade" id="career-<?php echo $c ?>" tabindex="-1" role="dialog" aria-labelledby="careerLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">

									<h5 class="modal-title"><?php the_sub_field('posizione'); ?></h5>

									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>

								</div>
								<div class="modal-body">

									<div class="posizioni-item-inner-body"><?php the_sub_field('dettaglio'); ?></div>

									<div class="card">
										<div class="card-body bg-light">

											<form action="">

												<div class="row">
													<div class="form-group col-lg-12">
														<label for="">Posizione</label>
														<input type="text" class="form-control" name="" value="<?php the_sub_field('posizione'); ?>" readonly>
													</div>
													<div class="form-group col-lg-6">
														<label for="">Nome</label>
														<input type="text" class="form-control" name="" value="">
													</div>
													<div class="form-group col-lg-6">
														<label for="">Cognome</label>
														<input type="text" class="form-control" name="" value="">
													</div>
													<div class="form-group col-lg-6">
														<label for="">Email</label>
														<input type="text" class="form-control" name="" value="">
													</div>
													<div class="form-group col-lg-6">
														<label for="">Curriculum</label>
														<input type="file" class="form-control" name="" value="">
													</div>
													<div class="form-group col-lg-6">
														<label for="">LinekdIn</label>
														<input type="url" class="form-control" name="" value="">
													</div>
													<div class="form-group col-lg-6">
														<label for="">Portfolio online</label>
														<input type="url" class="form-control" name="" value="">
													</div>
													<div class="form-group col-lg-12">
														<label for="">Messaggio</label>
														<textarea name="name" rows="4" class="form-control"value=""></textarea>
													</div>
												</div>

												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="1" id="privacy">
													<label class="form-check-label" for="privacy">
														Confermo di aver letto e accettato la Privacy Policy – Adeguamento al GDPR
													</label>
												</div>

												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="1" id="termini">
													<label class="form-check-label" for="termini">
														Confermo di aver letto e accettato le Termini e condizioni d'uso
													</label>
												</div>

												<div class="form-group">
													<small>
														Vogliamo che tu sappia esattamente come funziona il nostro servizio, perché abbiamo
														bisogno dei tuoi dati di registrazione e di come quest'ultimi sono utilizzati.
														Prima di continuare con la registrazione accetti e confermi di aver letto tutte le
														informative complete Privacy Policy - Adeguamento al GDPR, Cookie Policy, Termini e
														condizioni d'uso.
													</small>
												</div>

												<button class="btn btn-primary btn-block" type="submit">Invia</button>

											</form>

										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

				<?php endwhile; ?>


			</div>
		</div>
	<?php endif; ?>

<?php endwhile; endif; ?>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
