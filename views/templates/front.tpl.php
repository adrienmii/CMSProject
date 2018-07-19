<?php $BSQL = new BaseSQL();
$settings = $BSQL->getAllById('settings', 1);
$style = (isset($settings['theme']))?$settings['theme']:'default'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo DIRNAME; ?>public/css/themes/<?php echo $style; ?>.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,400,500,700|Ubuntu:300,400,500" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo DIRNAME; ?>public/js/global.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>	

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

					//Définitions de chaque menu avec l'url correspondante
					$menuAdmin = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."user/list/2" => "Enseignants",
						DIRNAME."user/list/3" => "Elèves",
						DIRNAME."Classe" => "Classes",
						DIRNAME."Schedule/list" => "Emploi du temps",
						DIRNAME."settings" => "Paramètres"
					);

					$menuTeacher = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."chapter/list" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."schedule/view/".$userinfo['id']."/".date('W')."/".date('Y') => "Emploi du temps",
					);
					$menuStudent = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."chapter/list" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."Devoirs" => "Devoirs",
						DIRNAME."schedule/view/".$userinfo['classe']."/".date('W')."/".date('Y') => "Emploi du temps",
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
						<a style="font-size: 1rem; padding-left: 30px; color: #5A738E; top: 35%; position: relative;" href="<?php echo DIRNAME."logout"; ?>">Déconnexion</a>
					</div>
				</div>											
			</div>
			<div id="topBarMobile" class="hidden-md">
				<div class="row">
					<div class="col-xs-2">
						<a id="toggleIcon" onclick="toggleMenuMobile()" href="#"></a>
					</div>
					<div id="logoMobile" class="col-xs-6 col-xs-offset-1"><img src="<?php echo DIRNAME; ?>public/img/logoMobile.png"></div>
										
				</div>	
				<nav id="navBarMobile" class="menuMobileClose">
					<ul>
					<?php 

					//Définitions de chaque menu avec l'url correspondante
					$menuAdmin = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."#" => "Enseignants",
						DIRNAME."Class/getClassStundent" => "Elèves",
						DIRNAME."Class" => "Classes",
						DIRNAME."Schedule/list" => "Emploi du temps",
						DIRNAME."settings" => "Paramètres"
					);

					$menuTeacher = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."Course/Mycourses" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."Class" => "Ma classe",
						DIRNAME."Timetable" => "Emploi du temps",
					);

					$menuStudent = array(
						DIRNAME."dashboard" => "Dashboard",
						DIRNAME."Course/Mycourses" => "Mes cours",
						DIRNAME."QCM" => "Evaluations",
						DIRNAME."Devoirs" => "Devoirs",
						DIRNAME."Timetable" => "Emploi du temps",
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
	<?php if (!empty($_SESSION['ntf'])) {
		echo $_SESSION['ntf'];
		$_SESSION['ntf'] = null;
	}
	?>

</body>
</html>