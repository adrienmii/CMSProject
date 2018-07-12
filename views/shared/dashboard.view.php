<?php 
	$BSQL = new BaseSQL(); 
	$userinfo = $BSQL->userInfoByToken();
?>

<main class="col-xs-12">		
	
	<div id="rowBlockSchedule" class="row">
		

		
			<?php //Chargement du contenu du dashboard en fonction du rank
			if($userinfo['rank'] != 1){?>
				

						<div id="blockSchedule" class="col-xs-12 col-lg-8">
							<div id="arrowLeftSchedule">
							</div>
							<div id="contentSchedule">
								<div id="currentCourse">						
									<div class="titleSchedule">Current course</div>
									<div class="timeSpanCours"><span>Today</span><br>9:45 - 13:00</div>							
									<hr class="timeLeft">								
									<div id="teacherCourse" class="hidden-xs visible-sm">
										<div>Développement PHP Avancé<br>
										<span>M. SKRZYPCZYK</span></div>
									</div>
									<div id="teacherCourseXs" class="hidden-sm visible-xs">
										<div>Développement PHP Avancé
										<span>M. SKRZYPCZYK</span></div>
									</div>
									<div id="roomCourse">
										Salle B21
										<a href="#">Accès cours</a>
									</div>
								</div>
								<div id="nextCourse">
									<div class="titleSchedule">Next course</div>
									<div class="timeSpanCours"><span>Today</span><br>9:45 - 13:00</div>							
									<hr class="timeLeft">								
									<div id="teacherCourse">
										<div>Algorithmique<br>
										<span>Mme. SANS</span></div>
									</div>
									<div id="roomCourse">
										Salle C02
										<a href="#">Accès cours</a>
									</div>
								</div>
							</div>
							<div id="arrowRightSchedule">
							</div>
						</div>						

			<?php } if($userinfo['rank'] == 3){?>
					<div id="blockHomeWork" class="col-xs-12 col-md-12 col-lg-4">
						<div id="blockHomeWorkContainer">
							<header>
								DEVOIRS
							</header>
							<table>							
								<tr>
									<td></td>
									<td>22/01/2018</td>
									<td>Contrôle Web Design</td>					
								</tr>
								<tr>
									<td></td>
									<td>22/01/2018</td>
									<td>Contrôle Web Design</td>					
								</tr>
								<tr>
									<td></td>
									<td>22/01/2018</td>
									<td>Contrôle Web Design</td>					
								</tr>
									<tr>
									<td></td>
									<td>22/01/2018</td>
									<td>Contrôle Web Design</td>					
								</tr>
							</table>
						</div>
					</div>				
			<?php } ?>
		
		
	</div>	
	<div id="rowBlockInfo" class="row" >
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					moyenne général
				</div>
				<div class="blocValue">
					<?php echo $config['average']; ?>/20
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					QCM réalisés
				</div>
				<div class="blocValue">
					<?php echo $config['nbQCMDone']; ?>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					QCM en attente
				</div>
				<div class="blocValue">
					<?php echo $config['nbQCMNotDone']; ?>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					Eleves dans la classe
				</div>
				<div class="blocValue">
					14
				</div>
			</div>
		</div>
	</div>
	<div id="rowChart" class="row" >
		<div class="col-xs-12 col-md-6">
			<canvas id="myChart"></canvas>
		</div>
		<div class="col-xs-12 col-md-6">			
			<canvas id="myChart2"></canvas>
		</div>				
	</div>
</main>
<script>
	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["De 0 à 5", "De 5 à 10", "De 10 à 15", "De 15 à 20",],
			datasets: [{
				label: 'Nombre de notes',
				data: [<?php echo implode(",", $config['dataChartMarks']); ?>],
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(75, 192, 192, 0.5)',
				],
				backgroundColor: [
					'#2A3F54',
					'#1ABB9C',
					'#172D44',
					'#70D4C1',
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			},
			title: {
				display: true,
				text:'Résultats Contrôle continu'
			},
			legend: {
				display: true,
				position: "bottom"
			}
		}
	});

	ctx = document.getElementById("myChart2");
	var myChart2 = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ["De 0 à 5", "De 5 à 10", "De 10 à 15", "De 15 à 20",],
			datasets: [{
				data: [2, 4, 12, 6],
				backgroundColor: [
					'#2A3F54',
					'#172D44',
					'#1ABB9C',
					'#70D4C1',
				],
			}]
		},
		options: {
			title: {
				display: true,
				text:'Résultats Contrôle continu'
			},
			legend: {
				display: true,
				position: "bottom"
			}
		}
	});
</script>
<?php

		if($userinfo['pwd_changed'] == 0){			
			echo("<script>showModal('myModal')</script>");
		}

	?>

	<div id="myModal" class="modal">
		<span onclick="hideModal()">&times;</span>
		<div class="modalHeader">			
			Votre mot de passe n'est pas sécurisé, veuillez le modifier
		</div>		
		<div class="modalBody">
			<?php $this->addModal("newPwdUser", $config, $errors); ?>			
		</div>
	</div>