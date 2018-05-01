<?php

class ChapterController {

	public function addAction($params) {		

		$chapter = new Chapter();
        $form = $chapter->generateFormAddChapter();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateChapter($form, $params['POST']);

            if (empty($errors)) {

            	$chapter = new Chapter();
            	$chapter->setLabel($params['POST']['label']);
            	$chapter->setDescription($params['POST']['description']);
            	$chapter->setClasse($params['POST']['classe']); 
            	$chapter->save();    
               
                $notify = new Notify("Le chapitre ".$params['POST']['label']." a bien été crée", "success");

                header('Location: '.DIRNAME.'chapter/list');
                exit();
            }else{
                $notify = new Notify($errors,"danger");
            }

        }

		$v = new View("addChapter");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
		
	}

	public function editAction($params) {
        $chapter = new Chapter();
        $form = $chapter->generateFormAddChapter();
        $BaseSQL = new BaseSQL();
        $form['prefill'] = $BaseSQL->chapterInfoById($params['URL'][0]);

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateChapter($form, $params['POST']);

            if (empty($errors)) {

            	$chapter = new Chapter($params['URL'][0]);
            	$chapter->setLabel($params['POST']['label']);
            	$chapter->setDescription($params['POST']['description']);
            	$chapter->setClasse($params['POST']['classe']); 
            	$chapter->save(); 
               

                new Notify("La modification a bien été effectuée", "success");

              
                header('Location: '.DIRNAME.'chapter/list');
                exit();
            } else {
                new Notify($errors, "danger");
            }

        }

        $v = new View("addChapter");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
    }



	public function listAction($params) {
		$BSQL = new BaseSQL();
		$user = $BSQL->userInfoByToken();
        $chapters = $BSQL->getChapters('all'); // modifier 'all' par $user['id'] pour un listage perso selon le prof connecté

        $v = new View("myChapters");
        $v->assign("chapters", $chapters);
	}

	public function deleteAction($params) {
		// modifier en ajoutant les supressions en cascades ?
		
		$chapter = new Chapter($params['URL'][0]);
		$chapter->delete();

		new Notify("Le chapitre a bien été supprimé", "success");

        header('Location: '.DIRNAME.'chapter/list');
        exit();

      
	}

	
}