
<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>" enctype="multipart/form-data">
<div class="row">
    <?php foreach ($config['input'] as $name => $params): ?>
        <?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>

            
                <div class="col-sm-10 col-sm-offset-1">
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
            
                <div class="col-sm-10 col-sm-offset-1">
                    <img style=" width: 15%; margin-bottom:5px;" title="Logo de l'établissement" src="public/img/<?php echo $config['prefill'][$name]; ?>">
                    <input
                        type="<?php echo $params['type']; ?>"
                        name="<?php echo $name; ?>"
                        id="<?php echo $params['id']; ?>"
                        <?php echo (isset($params['required']))?'required="required"':''; ?>
                        <?php echo (!empty($config['post'][$name]) ? 'value="'. $config['post'][$name].'"' : ""); ?>
                    >
                </div>

        <?php }elseif ($params['type'] == "select"){ ?>
             <div class="col-sm-10 col-sm-offset-1">
                <select name="<?php echo $name; ?>" id="<?php echo $params['id']; ?>" <?php echo ($params['multiple'])?" style='height:100px' multiple":""; ?>>
                    <?php foreach ($params['options'] as $value => $key): ?>
                        <option value="<?php echo $key; ?>" <?php echo ($config['prefill'][$name] == $key)?'selected':''; ?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
                            
        <?php } ?>
    <?php endforeach; ?>
</div>
    <div class="row">
        <div class="col-xs-12 col-sm-2 col-sm-offset-10 btnAddSubscribe">   
            <input type="submit" class="addProfile" value="<?php echo $config['submit']; ?>" name="submit_signin"><br>
            <input type="button" value="Paramètres calendrier" class="addProfile" style="width:200px;font-size:13px" onclick="window.location='<?php echo DIRNAME.'schedule/editScheduleSettings'; ?>';">  
        </div>
    </div>

</form>


