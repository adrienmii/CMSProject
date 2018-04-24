<?php 
	$BSQL = new BaseSQL(); 
	$userinfo = $BSQL->userInfo($_SESSION['token']);	
?>

<main class="col-xs-12">		
	
	<div id="rowBlockSchedule" class="row">
		

		<?php
			//Chargement du contenu du dashboard en fonction du rank
			if($userinfo['rank'] != 1){
				echo('

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
										<span>M. SCRYPZYK</span></div>
									</div>
									<div id="teacherCourseXs" class="hidden-sm visible-xs">
										<div>Développement PHP Avancé
										<span>M. SCRYPZYK</span></div>
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

				');
			}

			if($userinfo['rank'] == 3){
				echo('

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

				');
			}
		?>
		
	</div>	
	<div id="rowBlockInfo" class="row" >
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					moyenne général
				</div>
				<div class="blocValue">
					14.5/20
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					moyenne général
				</div>
				<div class="blocValue">
					14.5/20
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					moyenne général
				</div>
				<div class="blocValue">
					14.5/20
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 text-center">
			<div class="blocInfo">
				<div class="blocTitle">
					moyenne général
				</div>
				<div class="blocValue">
					14.5/20
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
</body>
</html>