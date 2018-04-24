<main id="classesContainer">	
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-4">
			<div id="newClassBlock">
				<div id="iconAddClassContainer">
					<a href="<?php echo DIRNAME."classe/add";?>" id="addClasses">+</a>
					<p>Ajouter une nouvelle classe</p>
				</div>						
			</div>
		</div>

		<?php foreach ($classes as $class) {
			$BaseSQL = new BaseSQL(); 
			$teacher = $BaseSQL->userInfoById($class['teacher']);
			$count = $BaseSQL->getCountClasse($class['id']);
		 ?>

		<div class="col-xs-12 col-sm-6 col-lg-4">
			<div class="classBlock">	
				<div class="row">
					<div class="col-xs-7 className">
						<?php echo $class['classname']; ?>
					</div>
					<div class="actionCol text-right col-xs-5 ">
						<a class="actionEditWhite" href="classe.html"></a>
						<a class="actionDeleteWhite" href="<?php echo DIRNAME.'classe/delete/'.$class['id']; ?>" onClick="return confirm('Souhaitez vous supprimer la classe <?php echo $class['classname']; ?> définitivement ?')"></a>
					</div>
					<div class="col-xs-10">
						<?php echo $count['count']; ?> élève(s)  •  <?php echo $teacher['firstname']. " " . $teacher['lastname']?>
					</div>
					<div class="addStudents col-xs-12">
						<div id="addStudentsIcon"></div>
						<div class="addStudentsText">Ajouter des élèves</div>
						<a href="<?php echo DIRNAME.'classe/list/'.$class['id']; ?>" class="actionAdd">+</a>
					</div>							
				</div>							
			</div>
		</div>
			
		<?php }	?>

	</div>						
</main>	
