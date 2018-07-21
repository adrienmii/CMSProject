
<main id="classeContainer">	
	<div class="row">
		<div class="col-xs-12">
			<header>
				<div class="row">
					<div id="offset" class="col-xs-5 col-sm-4"></div>
					<div id="iconStudents" class="col-xs-4 col-sm-1 col-sm-offset-6 "></div>
					<div id="studentsCount" class="col-xs-3 col-sm-1 text-left"><?php echo $count; ?><a href="<?php echo DIRNAME.'user/add'; ?>" id="addStudent">+</a></div>
				</div>
			</header>
			<main>
				<div class="row">
					<div class="col-xs-12">
						<table id="eleveTable">
							<thead>
								<tr>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Adresse e-mail</th>
									<th>Rôle</th>
									<th class="actionCol">Actions</th>
								</tr>
							</thead>
							<tbody>

							<?php $rank = [1 => 'Administrateur', 2 => 'Professeur', 3 => 'Elève']; foreach ($users as $user): ?>
								<tr>
									<td><?php echo $user['lastname']; ?></td>
									<td><?php echo $user['firstname']; ?></td>
									<td><?php echo $user['email']; ?></td>
									<td><?php echo $rank[$user['rank']]; ?></td>
									<td>
										<a class="actionEditBlue" href="<?php echo DIRNAME.'user/edit/'.$user['id']."/".$user['rank']; ?>"></a>
										<a class="actionDeleteBlue" href="<?php echo DIRNAME.'user/remove/'.$user['id']."/".$user['rank']; ?>" onclick="return confirm('Souhaitez vous supprimer l\'utilisateur <?php echo $user['firstname'].' '.$user['lastname']; ?> ?')"></a>
									</td>
								</tr>
							<?php endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
			</main>
		</div>
	</div>						
</main>	
