
<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>" enctype="multipart/form-data">
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
                        value="<?php
                    if(empty($config['post'][$name])){
                        echo ($name != "pwd" ? $config['prefill'][$name] : "");
                    }else{
                        echo $config['post'][$name];
                    } ?>"
                    >
                </div>
            

        <?php } elseif ($params['type'] == "file"){ ?>
            
                <div class="col-sm-6 col-sm-offset-3">
                    <img style=" width: 10%; " src="public/img/<?php echo $config['prefill'][$name]; ?>">
                    <input
                        type="<?php echo $params['type']; ?>"
                        name="<?php echo $name; ?>"
                        id="<?php echo $params['id']; ?>"
                        <?php echo (isset($params['required']))?'required="required"':''; ?>
                        <?php echo (!empty($config['post'][$name]) ? 'value="'. $config['post'][$name].'"' : ""); ?>
                    >
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


