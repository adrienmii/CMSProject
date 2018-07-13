
<main id="subscribeContainer">

	<section class="col-md-12">
		<header class="text-center">
			<?php if(isset($config['label'])){ ?>
			<h4><?php echo $config['label'];   ?></h4>
			<?php }else{ ?>
			<h4>Créer un QCM</h4>
			<?php } ?>
		</header>
		<main>
			<?php $this->addModal("qcm", $config, $errors); ?>
		</main>
	</section>

	<!--<form id="QCMForm" class="row">
		<div class="col-xs-12 col-md-7 displayInlineBlock">
			<label>Nom</label>
			<input placeholder="Nom de l'évaluation" type="text"/>
		</div>
		<div class="col-xs-12 col-md-5 displayInlineBlock">
			<label>Classe</label>
			<select>
				<option value="3A IW1">3A IW1</option>
			</select>
		</div>
	</form>
	<section class="col-xs-12">
		<header>
			<a href="#" id="previousQuestion">-</a>
			<a href="#" id="nextQuestion">+</a>
			<div id="questionNumber">Question<br><b>2</b><br>sur 2</div>
			<div id="question"><input type="text" placeholder="Saisir ici votre question" id="questionInput"/></div>
		</header>
		<main>
			<div class="answerRow">
				<div class="answerNumber"><span>1</span></div>
				<div class="answerAddQCM"><input type="text" placeholder="Réponse 1"/></div>
				<div class="goodAnswerCheckbox"><input type="checkbox"  /></div>
			</div>
			<div class="answerRow">
				<div class="answerNumber"><span>2</span></div>
				<div class="answerAddQCM"><input type="text" placeholder="Réponse 2"/></div>
				<div class="goodAnswerCheckbox"><input type="checkbox"  /></div>
			</div>
			<div class="answerRow addAnswer">
				<a href="#" id="addAnswer">+</a>
			</div>
			<div class="text-center btnNextContainer">
				<a id="btnCreate" href="#">Créer</a>
			</div>
		</main>
	</section>-->
</main>