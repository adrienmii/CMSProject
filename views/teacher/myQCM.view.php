<main class="row blockContainer">
	<section id="coursesList" class="col-xs-12">	
		<header>
			Tous les chapitres
		</header>					
		<main class="row">
			<div class="col-xs-12">
				<div class="row">
					<?php var_dump($qcms);foreach ($qcms as $qcm) { ?>
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<div class="blueBlock">	
								<div class="row">
									<div class="col-xs-7 blockName">
										<?php echo ucfirst($qcm['label'])." (".$qcm['classname'].")"; ?>
									</div>
									<div class="actionCol text-right col-xs-5 ">
										<a class="actionViewWhite" href="<?php echo DIRNAME.'chapter/view/'.$qcm['id']; ?>"></a>
										<a class="actionEditWhite" href="<?php echo DIRNAME.'chapter/edit/'.$qcm['id']; ?>"></a>
										<a class="actionDeleteWhite" href="<?php echo DIRNAME.'chapter/delete/'.$qcm['id']; ?>" onclick="return confirm('Souhaitez vous supprimer ce chapitre ?')"></a>
									</div>
									<div class="col-xs-10">
										0 cours 
									</div>													
								</div>							
							</div>
						</div>

					<?php } ?>
					
																
				</div>
			</div>										
		</main>
	</section>						
					
</main>				




