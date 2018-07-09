<main class="row blockContainer">
	<section id="coursesList" class="col-xs-12">	
		<header>
			Tous mes QCM
		</header>					
		<main class="row">
			<div class="col-xs-12">
				<div class="row">
					<?php foreach ($qcms as $qcm) { ?>
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<div class="blueBlock">	
								<div class="row">
									<div class="col-xs-7 blockName">
										<?php echo ucfirst($qcm['label'])." (".$qcm['classname'].")"; ?>
									</div>
									<div class="actionCol text-right col-xs-5 ">
										<a class="actionEditWhite" href="<?php echo DIRNAME.'QCM/edit/'.$qcm['id']; ?>"></a>
										<a class="actionDeleteWhite" href="<?php echo DIRNAME.'QCM/delete/'.$qcm['id']; ?>" onclick="return confirm('Souhaitez vous supprimer ce chapitre ?')"></a>
									</div>
									<div class="col-xs-10">
										<?php echo $qcm['nbQuestions']; ?> question(s)
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




