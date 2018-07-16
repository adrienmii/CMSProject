<main id="classesContainer">	
	<div class="row">
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
						<a class="actionEditWhite" href="<?php echo DIRNAME.'schedule/view/'.$class['id'].'/'.date('W').'/'.date('Y'); ?>"></a>
					</div>
					<div class="col-xs-10">
						<?php echo $count; ?> élève(s)  •  <?php echo $teachers; ?> professeur(s)
					</div>
					<div class="addStudents col-xs-12">
						<div id="addStudentsIcon"></div>
						<div class="addStudentsText">Gérer cet emploi du temps</div>
					</div>							
				</div>							
			</div>
		</div>
			
		<?php }	?>

	</div>						
</main>	