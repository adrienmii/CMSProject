
<main id="qcmContainer">
	<section class="col-XS-12">
		<header>
			<div id="questionNumber">Question<br><b><?php echo $config['currentQuestion'] ?></b><br>sur <?php echo $config['nbQuestion'] ?></div>
			<div id="question"><?php echo $config['question']['question']; ?></div>
		</header>
		<main>

			<?php $this->addModal("qcm", $config); ?>

		</main>
	</section>
</main>
			