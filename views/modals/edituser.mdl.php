<form method="<?php echo $config['form']['config']['method']; ?>" action="<?php echo $config['form']['config']['action']; ?>">
<div class="row">
	<?php foreach ($config['form']['input'] as $name => $params){ ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>

			<div class="col-sm-6 col-sm-offset-3">
				<input
					type="<?php echo $params['type']; ?>"
					value="<?php
					if(empty($config['post'][$name])){
						echo ($name != "pwd" ? $config['prefill'][$name] : "");
					}else{
						echo $config['post'][$name];
					} ?>"
					name="<?php echo $name; ?>"
					placeholder="<?php echo $params['placeholder']; ?>"
					id="<?php echo $params['id']; ?>"
					<?php echo (isset($params['required']))?'required="required"':''; ?>
				>
			</div>

		<?php }elseif ($params['type'] == "select"){ ?>			

			<div class="col-xs-12">					
				<input
					name="<?php echo $name; ?>"
					id="<?php echo $params['id']; ?>"
					value="<?php
					if(empty($config['post'][$name])){
						echo $config['prefill'][$name];
					}else{
						echo $config['post'][$name];
					} ?>"
					type="text"
					hidden
				>
			</div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-4 offset-sm-reset text-center profileChoiceContainer">
				<a href="#" class="<?php if(empty($config['post'][$name])){echo ($config['prefill'][$name] == 1 ? "active" : "");}else{echo ($config['post'][$name] == 1 ? "active" : "");} ?>" onclick="toggleProfile(this)" id="profileAdmin">Admin</a>
			</div>
				<div class="col-xs-10 col-xs-offset-1 col-sm-4 offset-sm-reset text-center profileChoiceContainer">
				<a href="#" class="<?php if(empty($config['post'][$name])){echo ($config['prefill'][$name] == 2 ? "active" : "");}else{echo ($config['post'][$name] == 2 ? "active" : "");} ?>"  onclick="toggleProfile(this)" id="profileTeacher">Professeur</a>
			</div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-4 offset-sm-reset text-center profileChoiceContainer">
				<a href="#" class="<?php if(empty($config['post'][$name])){echo ($config['prefill'][$name] == 3 ? "active" : "");}else{echo ($config['post'][$name] == 3 ? "active" : "");} ?>" onclick="toggleProfile(this)" id="profileStudent">Etudiant</a>
			</div>

		<?php } ?>
	<?php } ?>
</div>
	<div class="row">
		<div class="col-xs-12 col-sm-2 col-sm-offset-10 btnAddSubscribe">	
			<input type="submit" class="addProfile" value="<?php echo $config['form']['submit']; ?>" name="submit_signin">
		</div>
	</div>

</form>
