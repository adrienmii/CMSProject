<div id="notifications">
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo DIRNAME; ?>public/js/global.js"></script>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo DIRNAME; ?>public/css/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,400,500,700|Ubuntu:300,400,500" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="installerBody" >
	<header class="row">
		<div class="col-xs-12" id="logoContainer"></div>
		<div class="col-xs-12 text-center" id="title" class="text-center">cms installer</div>
	</header>
	<main class="row">		
		<section class="col-xs-12 col-sm-8 col-sm-offset-2" id="installerForm">
			<header class="text-center">
				<div>
				<a href="<?php echo DIRNAME; ?>install"><div class="stepCircle <?php echo ($step == 'db' || $step == 'admin')?'active':''; ?>"></div></a>
				<div class="path <?php echo ($step == 'db' || $step == 'admin')?'active':''; ?>"></div>
				<div class="stepCircle <?php echo ($step == 'admin')?'active':''; ?>"></div>
				<div class="path <?php echo ($step == 'admin')?'active':''; ?>"></div>
				<div class="stepCircle"></div>
			</div>
			<div>
				<div class="stepTitle">général</div>
				<div class="stepTitle">base de données</div>
				<div class="stepTitle">administrateur</div>
			</div>
			</header>
			<?php if ($step == 'db' || $step == 'admin') { ?>
			<main>
				<header>
					<div class="row">
						<div id="formTitle" class="col-xs-12">Identifiants de la base de données</div>
						<div id="formDesc" class="col-xs-12">Veuillez saisir ci-dessous les informations de connexion à votre base de données.</div>
					</div>
				</header>
				<main>
					<?php $this->addModal("install", $config, $errors); ?>	
					
				</main>
			</main>	
		<?php } else { ?>
			<main>
				<header>
					<div class="row">
						<div id="formTitle" class="col-xs-12">Informations générales</div>
						<div id="formDesc" class="col-xs-12">Cliquez sur suivant pour débuter l'installation d'Edulab.®</div>
					</div>
				</header>
			</main>
			<main>
				<div class="row buttonContainer">
					<div class="col-xs-6 col-xs-offset-3 col-sm-2 col-sm-offset-10 clearfix">
						<a href="<?php echo DIRNAME; ?>install/db"><input type="submit" value="Suivant"></a>	
					</div>
				</div>
			</main>
		<?php } ?>
		</section>
	</main>		
<?php if (!empty($_SESSION['ntf'])) {
		echo $_SESSION['ntf'];
		$_SESSION['ntf'] = null;
	}
	?>

</body>
</html>