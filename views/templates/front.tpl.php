<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo DIRNAME; ?>public/css/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,400,500,700|Ubuntu:300,400,500" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>	
	<div id="sideBar" class="hidden-xs visible-md">
		<header>
			<img src="<?php echo DIRNAME; ?>public/img/petitLogo.svg">
		</header>
		<main class="text-center">
			<div id="userPicture"></div>
			<div id="userName"><?php $BSQL = new BaseSQL(); $userinfo = $BSQL->userInfoByToken($_SESSION['token']); echo $userinfo['firstname']."<br>".$userinfo['lastname']; ?></div>
		</main>
		<nav id="navBar">
			<ul>

				<?php 

					$BSQL = new BaseSQL(); 
					$userinfo = $BSQL->userInfoByToken($_SESSION['token']);

					//Définitions de chaque menu avec l'url correspondante
					$menuAdmin = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."#" => "Enseignants",
						DIRNAME."user/list" => "Elèves",
						DIRNAME."Classe" => "Classes",
						DIRNAME."Timetable" => "Emploi du temps",
						DIRNAME."Param" => "Paramètres"
					);

					$menuTeacher = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."Course/Mycourses" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."Classe" => "Ma classe",
						DIRNAME."Timetable" => "Emploi du temps",
						DIRNAME."Param" => "Paramètres"
					);

					$menuStudent = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."Course/Mycourses" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."Devoirs" => "Devoirs",
						DIRNAME."Timetable" => "Emploi du temps",
						DIRNAME."Param" => "Paramètres"
					);
										

					//En fonction du rank de l'utilisateur on récupére son menu associé

					if($userinfo['rank'] == 1){
						$myArray = $menuAdmin;
					}elseif($userinfo['rank'] == 2){
						$myArray = $menuTeacher;
					}else{
						$myArray = $menuStudent;
					}

					//Génération du menu
					$i = 0;
					foreach($myArray as $key => $value){

						if($i==0){
							echo"<li id='li".$value."' class='active'><a href='".$key."'>".$value."</a></li>";
						}else{
							echo"<li id='li".str_replace(" ", "",$value)."'><a href='".$key."'>".$value."</a></li>";
						}						
						$i++;
					}
					
			
				?>
				
			</ul>			
		</nav>
	</div>
	<div id="pageContent">
		<header>
			<div id="topBar" class="col-md-12 hidden-xs visible-md">
				<div class="row">
					<div class="col-md-6">
						<a id="toggleIcon" onclick="toggleNav()" href="#"></a>
					</div>
					<div class="col-md-2 col-md-offset-4">
						<input  id="inputSearch" type="text">
					</div>
				</div>											
			</div>
			<div id="topBarMobile" class="hidden-md">
				<div class="row">
					<div class="col-xs-2">
						<a id="toggleIcon" onclick="toggleMenuMobile()" href="#"></a>
					</div>
					<div id="logoMobile" class="col-xs-6 col-xs-offset-1"><img src="<?php echo DIRNAME; ?>public/img/logoMobile.png"></div>
					<div id="iconSearch" class="col-xs-2 col-xs-offset-1" onclick="toggleSearchMobile()""></div>					
				</div>	
				<nav id="navBarMobile" class="menuMobileClose">
					<ul>
						<?php 

					$BSQL = new BaseSQL(); 
					$userinfo = $BSQL->userInfoByToken($_SESSION['token']);

					//Définitions de chaque menu avec l'url correspondante
					$menuAdmin = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."#" => "Enseignants",
						DIRNAME."Class/getClassStundent" => "Elèves",
						DIRNAME."Class" => "Classes",
						DIRNAME."Timetable" => "Emploi du temps",
						DIRNAME."Param" => "Paramètres"
					);

					$menuTeacher = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."Course/Mycourses" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."Class" => "Ma classe",
						DIRNAME."Timetable" => "Emploi du temps",
						DIRNAME."Param" => "Paramètres"
					);

					$menuStudent = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."Course/Mycourses" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."Devoirs" => "Devoirs",
						DIRNAME."Timetable" => "Emploi du temps",
						DIRNAME."Param" => "Paramètres"
					);
										

					//En fonction du rank de l'utilisateur on récupére son menu associé
					if($userinfo['rank'] == 1){						
						$myArray = $menuAdmin;
					}elseif($userinfo['rank'] == 2){
						$myArray = $menuTeacher;
					}else{
						$myArray = $menuStudent;
					}

					//Génération du menu					
					foreach($myArray as $key => $value){
						echo"<li id='li".str_replace(" ", "",$value)."'><a href='".$key."'>".$value."</a></li>";						
					}
					
			
				?>
					</ul>	
				</nav>
				<div id="divInputSearchMobile" class="row divInputSearchMobileClose">
					<div class="col-xs-12">
						<input id="SearchMobile" type="text">
					</div>					
				</div>	
			</div>			
			<div id="pathSection" class="col-md-12">
				<p>Dashboard</p>
			</div>			
		</header>
		<main>		
			<div class="col-md-12">
				<?php

					if (file_exists("views/admin/".$this->v)) {
						include("views/admin/".$this->v);
					}elseif (file_exists("views/teacher/".$this->v)) {
						include("views/teacher/".$this->v);
					}elseif(file_exists("views/student/".$this->v)) {
						include("views/student/".$this->v);
					}elseif(file_exists("views/shared/".$this->v)) {
						include("views/shared/".$this->v);
					}	

				?>				
			</div>							
		</main>	
	</div>	
	
	<div id="notifications">
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo DIRNAME; ?>public/js/global.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
	<script>		
		CKEDITOR.replace( 'editor1', {
		    language: 'fr',
		    height: '450px',		   
		});	
	</script>
	<script>
			var ctx = document.getElementById("myChart");		
			var myChart = new Chart(ctx, {
			    type: 'bar',		    
			    data: {
			        labels: ["De 0 à 5", "De 5 à 10", "De 10 à 15", "De 15 à 20",],
			        datasets: [{
			            label: 'nb eleves',
			            data: [2, 4, 12, 6],
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
	<?php if (!empty($_SESSION['ntf'])) {
		echo $_SESSION['ntf'];
		$_SESSION['ntf'] = null;
	}
	?>

</body>
</html>