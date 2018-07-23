					
<main class="row blockContainer">					
	<section id="coursesList" class="col-xs-12">	
		<header>
			Tous les chapitres
		</header>					
		<main class="row">
			<div class="col-xs-12">
				<div class="row">
					<?php 
                    $BSQL = new BaseSQL();
                    $user = $BSQL->userInfoByToken();
                    if ($user['rank'] == 2) {
                    ?>
					<div class="col-xs-12 col-sm-6 col-lg-4">
                        <div id="addBlock">
                            <div id="iconAddBlockContainer">
                                <a href="<?php echo DIRNAME."/chapter/add";?>" id="addItem">+</a>
                                <p>Créer un nouveau chapitre</p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
					<?php foreach ($chapters as $chapter) { 
						$BaseSQL = new BaseSQL(); 
						$count = $BaseSQL->getCountCourse($chapter['id']);
					?>

						<div class="col-xs-12 col-sm-6 col-lg-4">
							<div class="blueBlock">	
								<div class="row">
									<div class="col-xs-7 blockName">
										<?php echo ucfirst($chapter['label'])." (".$chapter['classname'].")"; ?>
									</div>
									<div class="actionCol text-right col-xs-5 ">
										<a class="actionViewWhite" href="<?php echo DIRNAME.'chapter/view/'.$chapter['id']; ?>"></a>
										<?php if ($user['rank'] == 1 || $user['rank'] == 2) {
                                        ?>
										<a class="actionEditWhite" href="<?php echo DIRNAME.'chapter/edit/'.$chapter['id']; ?>"></a>
										<a class="actionDeleteWhite" href="<?php echo DIRNAME.'chapter/delete/'.$chapter['id']; ?>" onclick="return confirm('Souhaitez vous supprimer ce chapitre ?')"></a>
										<?php } ?>
									</div>
									<div class="col-xs-10" style="margin-top: -15px;">
										<?php echo $count; ?> cours 
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




