<main class="row blockContainer">
	<section id="coursesList" class="col-xs-12">	
		<header>
			Tous mes QCM
		</header>					
		<main class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div id="addBlock">
							<div id="iconAddBlockContainer">
								<a href="<?php echo DIRNAME."QCM/create";?>" id="addItem">+</a>
								<p>Créer un nouveeau QCM</p>
							</div>
						</div>
					</div>
					<?php foreach ($qcms as $qcm) { ?>
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<div class="blueBlock">	
								<div class="row">
									<div class="col-xs-7 blockName">
										<?php echo ucfirst($qcm['label'])." "; echo (isset($qcm['classname']) && !empty($qcm['classname'])) ? "(".$qcm['classname'].")" : ""; ?>
									</div>
									<div class="actionCol text-right col-xs-5 ">
										<?php if(isset($qcm['classname']) && !empty($qcm['classname'])){ ?>
											<a class="actionEditWhite" href="<?php echo DIRNAME.'QCM/edit/'.$qcm['id']; ?>"></a>
											<a class="actionDeleteWhite" href="<?php echo DIRNAME.'QCM/delete/'.$qcm['id']; ?>" onclick="return confirm('Souhaitez vous supprimer ce chapitre ?')"></a>
										<?php }else{ ?>
											<a class="actionEditWhite" href="<?php echo DIRNAME.'QCM/participate/'.$qcm['id']; ?>"></a>
										<?php } ?>
									</div>
									<div class="col-xs-10">
										<?php echo $qcm['nbQuestions']; ?> question(s)
									</div>													
								</div>							
							</div>
						</div>

					<?php } ?>
					<?php foreach ($qcmsDone as $qcmDone) { ?>
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<div class="blueBlock">
								<div class="row">
									<div class="col-xs-7 blockName">
										<?php echo ucfirst($qcmDone['qcm']['label'])." "; echo (isset($qcm['classname']) && !empty($qcm['classname'])) ? "(".$qcm['classname'].")" : ""; ?>
									</div>
									<div class="actionCol text-right col-xs-5 ">
										<span class=""><?php echo $qcmDone['mark']; ?>/20</span>
									</div>
									<div class="col-xs-10">
										QCM réalisé
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




