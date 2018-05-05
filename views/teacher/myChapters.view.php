					
<main class="row" id="teacherClassesContainer">					
	<section id="coursesList" class="col-xs-12">	
		<header>
			Les cours de mes classes
		</header>					
		<main class="row">
			<div class="col-xs-12">
				<div class="row">
					<?php foreach ($chapters as $chapter) { ?>

						<article class="col-xs-6 col-md-3">
							<div class="chapterBlock">
		
									<div class="teacherClassName"><?php echo ucfirst($chapter['label'])." (".$chapter['classname'].")"; ?></div>
									<div class="teacherClassChapter">0 cours</div>
									<a href="<?php echo DIRNAME.'chapter/delete/'.$chapter['id']; ?>" onclick="return confirm('Souhaitez vous supprimer ce chapitre ?')">Supprimer</a>
									<a href="<?php echo DIRNAME.'chapter/edit/'.$chapter['id']; ?>" >Modifier</a>
						
							</div>
						</article>	

					<?php } ?>
					
																
				</div>
			</div>										
		</main>
	</section>						
					
</main>				




