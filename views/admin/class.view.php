
<main id="classeContainer">	
	<div class="row">
		<div class="col-xs-12">
			<header>
				<div class="row">
					<div class="col-xs-12 text-center">
						<div id="className"><?php echo $classe['classname']; ?></div>
						<a class="actionEditBlue" href="#"></a>
					</div>
					<div id="teacherName" class="col-xs-8 col-sm-4"><?php echo $teacher['firstname']." ".$teacher['lastname']; ?></div>
					<div id="studentsCount" class="col-xs-4 col-sm-2 col-sm-offset-6 text-left"><?php echo $count['count']; ?><a href="#" id="addStudent">+</a></div>
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
									<th>email</th>
									<th class="actionCol">action</th>
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
										<a class="actionDeleteBlue" href="#"></a>
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
