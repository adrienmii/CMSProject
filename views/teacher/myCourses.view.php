<main class="row blockContainer">
    <section id="coursesList" class="col-xs-12">
        <header>
            Cours du chapitre <?php echo $chapter['label']; ?>
        </header>
        <main class="row">
            <div class="col-xs-12">
                <div class="row">
                    <?php 
                    $BSQL = new BaseSQL();
                    $user = $BSQL->userInfoByToken();
                    if ($user['rank'] == 2) {
                    ?>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div id="addBlock">
                            <div id="iconAddBlockContainer">
                                <a href="<?php echo DIRNAME."/course/add";?>" id="addItem">+</a>
                                <p>Créer un nouveau cours</p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php foreach ($courses as $course) { ?>                       
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="blueBlock"> 
                                <div class="row">
                                    <div class="col-xs-7 blockName">
                                       <?php echo ucfirst($course['title']); ?>
                                    </div>
                                    <div class="actionCol text-right col-xs-5 ">
                                        <a class="actionViewWhite" href="<?php echo DIRNAME.'course/view/'.$course['course']; ?>"></a>
                                        <a class="actionEditWhite" href="<?php echo DIRNAME.'course/edit/'.$course['course']; ?>"></a>
                                        <a class="actionDeleteWhite" href="<?php echo DIRNAME.'course/delete/'.$course['course']; ?>" onclick="return confirm('Souhaitez vous supprimer ce cours ?')"></a>
                                    </div>                                                                                
                                </div>                          
                            </div>
                        </div>

                    <?php } ?>


                </div>
            </div>
        </main>
    </section>

</main>