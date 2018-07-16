
<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>">
<div class="row">
	<?php foreach ($config['input'] as $name => $params): ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>
				<div class="col-sm-6 col-sm-offset-3">
					<input
						type="<?php echo $params['type']; ?>"
						name="<?php echo $name; ?>"
						placeholder="<?php echo $params['placeholder']; ?>"
						id="<?php echo $params['id']; ?>"
						<?php echo (isset($params['required']))?'required="required"':''; ?>
						<?php echo (!empty($config['post'][$name]) ? 'value="'. $config['post'][$name].'"' : ""); ?>
					>
				</div>
		<?php }elseif ($params['type'] == "select"){ ?>
			
				<div class="col-xs-12">					
					<input name="<?php echo $name; ?>" id="<?php echo $params['id']; ?>" value="<?php echo (!empty($config['post'][$name]) ? $config['post'][$name] : "1"); ?>" type="text" hidden/>
				</div>
				<div class="col-xs-10 col-xs-offset-1 col-sm-4 offset-sm-reset text-center profileChoiceContainer">
					<a href="#" class="<?php echo (empty($config['post'][$name]) || $config['post'][$name] == 1 ? "active" : ""); ?>"  onclick="toggleProfile(this)" id="profileAdmin">Admin</a>
				</div>
					<div class="col-xs-10 col-xs-offset-1 col-sm-4 offset-sm-reset text-center profileChoiceContainer">
					<a href="#" class="<?php echo (!empty($config['post'][$name]) && $config['post'][$name] == 2 ? "active" : ""); ?>" onclick="toggleProfile(this)" id="profileTeacher">Professeur</a>
				</div>
				<div class="col-xs-10 col-xs-offset-1 col-sm-4 offset-sm-reset text-center profileChoiceContainer">
					<a href="#" class="<?php echo (!empty($config['post'][$name]) && $config['post'][$name] == 3 ? "active" : ""); ?>" onclick="toggleProfile(this)" id="profileStudent">Etudiant</a>
				</div>
							
		<?php } ?>
	<?php endforeach; ?>
</div>
	<div class="row">
		<div class="col-xs-12 col-sm-2 col-sm-offset-10 btnAddSubscribe">	
			<input type="submit" class="addProfile" value="<?php echo $config['submit']; ?>" name="submit_signin">
		</div>
	</div>

</form>


