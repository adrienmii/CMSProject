<main id="classesContainer">	
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-4">
			<div id="addBlock">
				<div id="iconAddBlockContainer">
					<a href="<?php echo DIRNAME."classe/add";?>" id="addItem">+</a>
					<p>Ajouter une nouvelle classe</p>
				</div>						
			</div>
		</div>

		<?php foreach ($classes as $class) {
			$BaseSQL = new BaseSQL(); 
			$teachers = $BaseSQL->getCountTeachers($class['id']);
			$count = $BaseSQL->getCountClasse($class['id']);
		 ?>

		<div class="col-xs-12 col-sm-6 col-lg-4">
			<div class="blueBlock">	
				<div class="row">
					<div class="col-xs-7 blockName">
						<?php echo $class['classname']; ?>
					</div>
					<div class="actionCol text-right col-xs-5 ">
						<a class="actionEditWhite" href="<?php echo DIRNAME.'classe/edit/'.$class['id']; ?>"></a>
						<a class="actionDeleteWhite" href="<?php echo DIRNAME.'classe/delete/'.$class['id']; ?>" onClick="return confirm('Souhaitez vous supprimer la classe <?php echo strtoupper($class['classname']); ?> définitivement ?')"></a>
					</div>
					<div class="col-xs-10">
						<?php echo $count; ?> élève(s)  •  <?php echo $teachers; ?> professeur(s)
					</div>
					<div class="addStudents col-xs-12">
						<div id="addStudentsIcon"></div>
						<div class="addStudentsText">Gérer cette classe</div>
						<a href="<?php echo DIRNAME.'classe/list/'.$class['id']; ?>" class="actionAdd">+</a>
					</div>							
				</div>							
			</div>
		</div>
			
		<?php }	?>

	</div>						
</main>	
