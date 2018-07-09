<?php

class QCMController {

    public function indexAction($params){
        $BSQL = new BaseSQL();
        $user = $BSQL->userInfoByToken();
        $qcms = $BSQL->getQCMByTeacherId($user['id']);
        $qcm['nbQuestions'] = "fgvv";
        foreach($qcms as $key => $qcm){
            $qcms[$key]['nbQuestions'] = $BSQL->countQuestionsByQCM($qcm['id'])['nbQuestions'];
        }
        $v = new View("myQCM", "front");
        $v->assign("qcms", $qcms);
    }

	public function participateAction($params) {

		
	}

    public function createAction($params) {

        $QCM = new QCM();
        $form = $QCM->generateFormQCM();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateQCM($form, $params['POST']);

            if (empty($errors)) {
                $db = new BaseSQL();
                $qcm = new QCM();
                $qcm->setLabel($params['POST']['label']);
                $qcm->setTeacher($db->userInfoByToken()['id']);
                $qcm->setClasse($params['POST']['classe']);
                $qcmId = $qcm->save();

                $notify = new Notify("Le QCM a été créé avec succés","success");

                header('Location: '.DIRNAME.'QCM/createQuestion/'. $qcmId);
                exit();
            }else{
                $form['post'] = $params['POST'];
                $notify = new Notify($errors,"danger");
            }

        }

        $v = new View("addQCM");
        $v->assign("config", $form);
        $v->assign("errors", $errors);

    }

    public function editAction($params) {
        if($params['URL'][0]){
            $QCM = new QCM();
            // $questionQCM = new QuestionQCM();
            $form = $QCM->generateFormQCM();
            $form['prefill'] = $QCM->getQCMById($params['URL'][0]);
            if($form['prefill']){
                $errors = null;

                if (!empty($params['POST'])) {
                    // Vérification des saisies
                    $errors = Validator::validateQCM($form, $params['POST']);

                    if (empty($errors)) {
                        $db = new BaseSQL();
                        $qcm = new QCM();
                        $qcm->setLabel($params['POST']['label']);
                        $qcm->setTeacher($db->userInfoByToken()['id']);
                        $qcm->setClasse($params['POST']['classe']);
                        $qcmId = $qcm->save();

                        $notify = new Notify("Le QCM a été modifié avec succés","success");

                        header('Location: '.DIRNAME.'QCM/createQuestion/'. $qcmId);
                        exit();
                    }else{
                        $form['post'] = $params['POST'];
                        $notify = new Notify($errors,"danger");
                    }

                }

                $v = new View("editQCM");
                $v->assign("config", $form);
                $v->assign("errors", $errors);
            }else{
                header('Location: ' . DIRNAME . 'QCM/create');
            }

        }else{
            header('Location: ' . DIRNAME . 'QCM/create');
        }

    }

    public function createQuestionAction($params) {
        if($params['URL'][0]){
            $qcm = new QCM($params['URL'][0]);
            $questionQCM = new QuestionQCM();
            $form = $questionQCM->generateFormQCM();
            $form['label'] = $qcm->getLabel();

            $errors = null;

            if (!empty($params['POST'])) {
                // Vérification des saisies
                $errors = Validator::validateQuestionQCM($form, $params['POST']);

                if (empty($errors)) {
                    $questionQCM = new QuestionQCM();
                    $questionQCM->setQuestion($params['POST']['question']);
                    $questionQCM->setAnswer1($params['POST']['answer1']);
                    $questionQCM->setAnswer2($params['POST']['answer2']);
                    $questionQCM->setAnswer3($params['POST']['answer3']);
                    $questionQCM->setAnswer4($params['POST']['answer4']);
                    $questionQCM->setResult($params['POST']['response']);
                    $questionQCM->setIdQCM($params['URL'][0]);
                    $questionQCM->save();

                    $notify = new Notify("La question a été créée avec succés", "success");

                    header('Location: ' . DIRNAME . 'QCM/createQuestion/'. $params['URL'][0]);
                    exit();
                } else {
                    $form['post'] = $params['POST'];
                    $notify = new Notify($errors, "danger");
                }
            }

        }else{
            $notify = new Notify("Le QCM n'a pas pu etre créé", "danger");
            header('Location: ' . DIRNAME . 'QCM/create');
            exit();
        }

        $v = new View("addQCM");
        $v->assign("config", $form);
        $v->assign("errors", $errors);

    }
	
}