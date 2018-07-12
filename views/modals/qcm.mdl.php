<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>">

	<?php foreach ($config['input'] as $name => $params): ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>

			<div class="row">
				<div class="col-xs-12">
					<?php if (isset($params['answer']) && $params['answer']){ ?>
						<div class="answerAddQCM">
					<?php } ?>
					<input type="<?php echo $params['type']; ?>" <?php echo (!empty($config['prefill']) && !empty($config['prefill'][$name]))?"value='".ucfirst($config['prefill'][$name])."'":""; ?> name="<?php echo $name; ?>" placeholder="<?php echo $params['placeholder']; ?>" id="<?php echo $params['id']; ?>" <?php echo (isset($params['required']))?'required="required"':''; ?>>
					<?php if (isset($params['answer']) && $params['answer']){ ?>
						</div>
						<div class="goodAnswerCheckbox"><input type="checkbox" name="response" value="<?php echo $params['answerId']; ?>" /></div>
					<?php } ?>
				</div>
			</div>


			<?php }elseif ($params['type'] == "select"){ ?>
			<div class="row">
				<div class="col-xs-12">
					<select name="<?php echo $name; ?>" id="<?php echo $params['id']; ?>" <?php echo ($params['multiple'])?" style='height:100px' multiple":""; ?>>
						<?php foreach ($params['options'] as $value): ?>
							<option value="<?php echo $value['id']; ?>" <?php if (!empty($config['prefill'][$name]) && $config['prefill'][$name] == $value['id']) { echo 'selected'; }?>> <?php echo $value['classname']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>


		<?php
			}elseif ($params['type'] == "radio"){

		?>
			<input type="hidden" name="idQuestion" value="<?php echo $config['question']['id']; ?>">
			<?php if($config['question']['answer1']){ ?>
				<div class="answerRow ">
					<div class="answerNumber"><span>1</span></div>
					<input type="radio" class="answer" name="answer" value="1"><?php echo $config['question']['answer1']; ?>
				</div>
			<?php } ?>

			<?php if($config['question']['answer2']){ ?>
				<div class="answerRow ">
					<div class="answerNumber"><span>2</span></div>
					<input type="radio" class="answer" name="answer" value="2"><?php echo $config['question']['answer2']; ?>
				</div>
			<?php } ?>

			<?php if($config['question']['answer3']){ ?>
				<div class="answerRow ">
					<div class="answerNumber"><span>3</span></div>
					<input type="radio" class="answer" name="answer" value="3"><?php echo $config['question']['answer3']; ?>
				</div>
			<?php } ?>

			<?php if($config['question']['answer4']){ ?>
				<div class="answerRow ">
					<div class="answerNumber"><span>4</span></div>
					<input type="radio" class="answer" name="answer" value="4"><?php echo $config['question']['answer4']; ?>
				</div>
			<?php } ?>

		<?php } ?>
	<?php endforeach; ?>

	<div class="row">
		<div class="col-xs-12 col-sm-2 col-sm-offset-7 btnAddSubscribe">
			<input class="addProfile" type="submit" value="<?php echo $config['submit'][0]; ?>" name="submit_signin">
		</div>
	</div>

</form>

