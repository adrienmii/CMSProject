<?php

class QCMController {
	

	public function participateAction($params) {		

		$v = new View("QCM", "front");
		
	}

    public function createAction($params) {

        $questionQCM = new QCM();
        $form = $questionQCM->generateFormQCM();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateQCM($form, $params['POST']);

            if (empty($errors)) {
                $qcm = new QCM();
                $qcm->setLabel($params['POST']['label']);
                $qcmId = $qcm->save();

                $notify = new Notify("La question a été créée avec succés","success");

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
            header('Location: ' . DIRNAME . 'QCM/createjezhzeoieh');
        }

        $v = new View("addQCM");
        $v->assign("config", $form);
        $v->assign("errors", $errors);

    }

    public function editAction($params) {

        $qcm = new QCM();
        $questionQCM = new QuestionQCM();
        $form = $questionQCM->generateFormQCM();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateQuestionQCM($form, $params['POST']);

            if (empty($errors)) {
                $questionQCM = new questionQCM();
                $questionQCM->setQuestion($params['POST']['question']);
                $questionQCM->setAnswer1($params['POST']['answer1']);
                $questionQCM->setAnswer2($params['POST']['answer2']);
                $questionQCM->setAnswer3($params['POST']['answer3']);
                $questionQCM->setAnswer4($params['POST']['answer4']);
                $questionQCM->setResult($params['POST']['result']);
                $questionQCM->save();

                $notify = new Notify("La question a été modifiée avec succés","success");

                header('Location: '.DIRNAME.'');
                exit();
            }else{
                $form['post'] = $params['POST'];
                $notify = new Notify($errors,"danger");
            }

        }

        $v = new View("editQCM");
        $v->assign("config", $form);
        $v->assign("errors", $errors);

    }
	
}