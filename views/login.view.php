<?php $BSQL = new BaseSQL();
$settings = $BSQL->getAllById('settings', 1);
$logo = ($settings['logo'])?$settings['logo']:null; 
$address = ($settings['address'])?$settings['address']:null;
$sitename = ($settings['sitename'])?$settings['sitename']:null;

$style = ($settings['theme'])?$settings['theme']:'default';


?>

<!-- Requis pour les notifs -->
<div id="notifications"></div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo DIRNAME; ?>public/js/global.js"></script>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo DIRNAME; ?>public/css/themes/<?php echo $style; ?>.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,400,500,700|Ubuntu:300,400,500" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?
if ($logo) {
?>

<div class="school-infos" style="width: 180px;background-color: white;padding:10px">
	<img style=" width: 100%;" title="Logo de l'établissement" src="public/img/<?php echo $logo; ?>">
	<p><b><?php echo $sitename."</b><br>".$address ?></p>
</div>

<?php } ?>
<body id="loginBody">
	<main>		
		
		<section id="loginForm">
			<header>				
			</header>
			<main>
				<?php $this->addModal("login", $config, $errors); ?>	
			</main>			
			<footer>
				<div class="row">
					<div id="help" class="col-xs-6 col-xs-offset-3">	
						<a href="#">Problème de connexion</a>
					</div>
				</div>				
			</footer>
		</section>
	</main>		
	
	<!-- Requis pour les notifs -->
	<?php if (!empty($_SESSION['ntf'])) {
		echo $_SESSION['ntf'];
		$_SESSION['ntf'] = null;
	}
	?>

</body>
</html>