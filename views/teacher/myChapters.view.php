					
<main class="row" id="teacherClassesContainer">					
	<section id="coursesList" class="col-xs-12">	
		<header>
			Les cours de mes classes
		</header>					
		<main class="row">
			<div class="col-xs-12">
				<div class="row">
					<?php foreach ($chapters as $chapter) { ?>

						

						<div class="col-xs-12 col-sm-6 col-lg-4">
							<div class="classBlock">	
								<div class="row">
									<div class="col-xs-7 className">
										<?php echo ucfirst($chapter['label'])." (".$chapter['classname'].")"; ?>
									</div>
									<div class="actionCol text-right col-xs-5 ">
										<a class="actionEditWhite" href="<?php echo DIRNAME.'chapter/edit/'.$chapter['id']; ?>"></a>
										<a class="actionDeleteWhite" href="<?php echo DIRNAME.'chapter/delete/'.$chapter['id']; ?>" onclick="return confirm('Souhaitez vous supprimer ce chapitre ?')"></a>
									</div>
									<div class="col-xs-10">
										0 cours 
									</div>
									<div class="addStudents col-xs-12">
										<div id="addStudentsIcon"></div>
										<div class="addStudentsText">add chapter</div>
										<a href="#" class="actionAdd">+</a>
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




