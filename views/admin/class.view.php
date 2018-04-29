
<?php $rank = [1 => 'Administrateur', 2 => 'Professeur', 3 => 'Elève']; ?>
<main id="classeContainer">	
	<div class="row">
		<div class="col-xs-12">
			<header>
				<div class="row">
					<div class="col-xs-12 text-center">
						<div id="className"><?php echo $classe['classname']; ?></div>
						<a class="actionEditBlue" href="<?php echo DIRNAME.'classe/edit/'.$classe['id']; ?>"></a>
					</div>
					<div id="nothing" class="col-xs-8 col-sm-4">
					</div>
					<div id="studentsCount" class="col-xs-4 col-sm-2 col-sm-offset-6 text-left"><?php echo $countTeachers; ?><a href="<?php echo DIRNAME.'classe/addTeach/'.$classe['id']; ?>" id="addStudent">+</a></div>
				</div>
			</header>
			<main>
				<div class="row">
					<div class="col-xs-12">
						<table id="eleveTable">
							<thead>
								<tr>
									<th>nom</th>
									<th>prénom</th>
									<th>Adresse e-mail</th>
									<th>Rôle</th>
									<th class="actionCol">actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($teachers as $teacher) { ?>
									<tr>
									<td><?php echo $teacher['lastname']; ?></td>
									<td><?php echo $teacher['firstname']; ?></td>
									<td><?php echo $teacher['email']; ?></td>
									<td><?php echo $rank[$teacher['rank']]; ?></td>
									<td>
										<a class="actionEditBlue" href="#"></a>
										<a class="actionDeleteBlue" href="<?php echo DIRNAME.'classe/removeTeacher/'.$teacher['id'].'/'.$classe['id']; ?>" onClick="return confirm('Souhaitez vous retirer à <?php echo $teacher['firstname'].' '.$teacher['lastname']; ?> le rôle de professeur pour cette classe ?')"></a>
									</td>
								</tr>
								<?php } ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</main>
		</div>
	</div>	

	<div class="row">
		<div class="col-xs-12">
			<header>
				<div class="row">
					<div class="col-xs-12 text-center">
						<div id="className"></div>
					</div>
					<div id="nothing" class="col-xs-8 col-sm-4">
					</div>
					<div id="studentsCount" class="col-xs-4 col-sm-2 col-sm-offset-6 text-left"><?php echo $count; ?><a href="<?php echo DIRNAME.'classe/addStud/'.$classe['id']; ?>" id="addStudent">+</a></div>
				</div>
			</header>
			<main>
				<div class="row">
					<div class="col-xs-12">
						<table id="eleveTable">
							<thead>
								<tr>
									<th>nom</th>
									<th>prénom</th>
									<th>Adresse e-mail</th>
									<th class="actionCol">actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($students as $student) { ?>
									<tr>
									<td><?php echo $student['lastname']; ?></td>
									<td><?php echo $student['firstname']; ?></td>
									<td><?php echo $student['email']; ?></td>
									<td>
										<a class="actionEditBlue" href="#"></a>
										<a class="actionDeleteBlue" href="<?php echo DIRNAME.'classe/removeStudent/'.$student['id']; ?>"></a>
									</td>
								</tr>
								<?php } ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</main>
		</div>
	</div>						
</main>	
