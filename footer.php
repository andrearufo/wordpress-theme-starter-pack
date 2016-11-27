				<footer class="py-3">
					<div class="container">
						
						<div class="row row-contatti">
							<div class="col-md-4">

								<div class="row row-nogutters flex-items-xs-middle">
									<div class="col-xs-4 text-xs-right">

										<span class="fa-stack fa-2x">
											<i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
										</span>

									</div>
									<div class="col-xs">

										<?php the_field('telefono', 'options') ?>

									</div>
								</div>

							</div>
							<div class="col-md-4">

								<div class="row row-nogutters flex-items-xs-middle">
									<div class="col-xs-4 text-xs-right">

										<span class="fa-stack fa-2x">
											<i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
										</span>

									</div>
									<div class="col-xs">
										
										<?php the_field('email', 'options') ?>

									</div>
								</div>

							</div>
							<div class="col-md-4">

								<div class="row row-nogutters flex-items-xs-middle">
									<div class="col-xs-4 text-xs-right">

										<span class="fa-stack fa-2x">
											<i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
										</span>

									</div>
									<div class="col-xs">
										
										<?php the_field('indirizzo', 'options') ?>

									</div>
								</div>

							</div>
						</div>

					</div>
				</footer>

			</div>

		</main>
	</div>
	
	<?php wp_footer() ?>
	
</body>
</html>