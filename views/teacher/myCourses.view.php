<main class="row" id="teacherClassesContainer">
    <section id="coursesList" class="col-xs-12">
        <header>
            Tous mes cours
        </header>
        <main class="row">
            <div class="col-xs-12">
                <div class="row">
                    <?php foreach ($courses as $course) { ?>

                        <article class="col-xs-6 col-md-3">
                            <div class="chapterBlock">

                                <div class="teacherClassName"><?php echo ucfirst($course['title'])." (".$course['label'].")"; ?></div>
                                <a href="<?php echo DIRNAME.'course/delete/'.$course['course']; ?>" onclick="return confirm('Souhaitez vous supprimer ce chapitre ?')">Supprimer</a>
                                <a href="<?php echo DIRNAME.'course/edit/'.$course['course']; ?>" >Modifier</a>
                                <a href="<?php echo DIRNAME.'course/view/'.$course['course']; ?>" >Afficher</a>

                            </div>
                        </article>

                    <?php } ?>


                </div>
            </div>
        </main>
    </section>

</main>