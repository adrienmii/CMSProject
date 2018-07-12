<?php

class QCMController {

    public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

    public function indexAction($params){
        $BSQL = new BaseSQL();
        $user = $BSQL->userInfoByToken();
        $qcms = [];

        if($user['rank'] == 2){
            $qcms = $BSQL->getQCMByTeacherId($user['id']);
            foreach($qcms as $key => $qcm){
                $qcms[$key]['nbQuestions'] = $BSQL->countQuestionsByQCM($qcm['id'])['nbQuestions'];
            }

        }elseif($user['rank'] == 3){
            $qcms = $BSQL->getQCMByClassId($user['classe']);
            foreach($qcms as $key => $qcm){
                $qcms[$key]['nbQuestions'] = $BSQL->countQuestionsByQCM($qcm['id'])['nbQuestions'];

                if($BSQL->isQCMDone($user['id'], $qcm['id'])['isDone'] != 0){
                    unset($qcms[$key]);
                }
            }
        }

        $v = new View("myQCM", "front");
        $v->assign("qcms", $qcms);
    }

	public function participateAction($params) {
        if($params['URL'][0]){
            $BSQL = new BaseSQL();
            $user = $BSQL->userInfoByToken();

            if($BSQL->isQCMDone($user['id'], $params['URL'][0])['isDone'] == 0){
                if(!isset($_SESSION['qcm_'.$params['URL'][0]])){
                    $BSQL = new BaseSQL();
                    $questions = $BSQL->getQuestionsByQCM($params['URL'][0]);
                    foreach ($questions as $question){
                        $_SESSION['qcm_'.$params['URL'][0]][] = $question['id'];
                    }
                    $_SESSION['nbQuestions'] = sizeof($_SESSION['qcm_'.$params['URL'][0]]);
                    $_SESSION['idCurrentQuestion'] = $_SESSION['qcm_'.$params['URL'][0]][0];
                    unset($_SESSION['qcm_'.$params['URL'][0]][0]);
                    array_splice($_SESSION['qcm_'.$params['URL'][0]], 0, 0);
                    if(empty($_SESSION['qcm_'.$params['URL'][0]]))
                        $_SESSION['qcm_'.$params['URL'][0]][] = "end";
                    $_SESSION['currentQuestion'] = 1;
                    $_SESSION['mark'] = 0;
                    $_SESSION['goodAnswer'] = 0;
                }

                if(($_SESSION['qcm_'.$params['URL'][0]][0]) && ($_SESSION['qcm_'.$params['URL'][0]][0] != "end")){
                    $BSQL = new BaseSQL();
                    $qcm = new QCM();
                    $form = $qcm->generateFormParticipateQCM();
                    $form['question'] = $BSQL->getQuestionById($_SESSION['idCurrentQuestion']);
                    $_SESSION['goodAnswer'] = $form['question']['result'];
                    $form['currentQuestion'] = $_SESSION['currentQuestion'];

                    if(isset($_POST['submit_signin']) && !empty($_POST['submit_signin'])){
                        $goodAnswer = $BSQL->getQuestionById($_POST['idQuestion'])['result'];
                        if(isset($_POST['answer']) && !empty($_POST['answer']) && $_POST['answer'] == $goodAnswer){
                            $_SESSION['mark'] ++;
                        }
                        unset($_SESSION['qcm_'.$params['URL'][0]][0]);
                        array_splice($_SESSION['qcm_'.$params['URL'][0]], 0, 0);
                        if(empty($_SESSION['qcm_'.$params['URL'][0]]))
                            $_SESSION['qcm_'.$params['URL'][0]][] = "end";

                        $_SESSION['currentQuestion'] ++;
                        $form['currentQuestion'] = $_SESSION['currentQuestion'];
                        //header('Location: '.DIRNAME.'QCM/participate/'. $params['URL'][0]);
                        $_SESSION['idCurrentQuestion'] = $_SESSION['qcm_'.$params['URL'][0]][0];
                    }
                    
                    $form['nbQuestion'] = $_SESSION['nbQuestions'];
                    $v = new View("QCM", "front");
                    $v->assign("config", $form);

                }else{
                    if(isset($_POST['submit_signin']) && !empty($_POST['submit_signin'])){
                        $BSQL = new BaseSQL();
                        $goodAnswer = $BSQL->getQuestionById($_POST['idQuestion'])['result'];
                        if(isset($_POST['answer']) && !empty($_POST['answer']) && $_POST['answer'] == $goodAnswer){
                            $_SESSION['mark'] ++;
                        }

                    }
                    $participateQCM = new ParticipateQCM();
                    $participateQCM->setIdQCM($params['URL'][0]);
                    $participateQCM->setIdUser($participateQCM->userInfoByToken()['id']);
                    $mark = round((($_SESSION['mark']/$_SESSION['nbQuestions']) * 20)* 2) / 2;
                    $participateQCM->setMark($mark);
                    if($participateQCM->save()){
                        unset($_SESSION['qcm_'.$params['URL'][0]]);
                        $notify = new Notify("Vos réponses ont bien été enregistrées","success");
                        header('Location: '. DIRNAME .'QCM');
                    }else{
                        $notify = new Notify("Erreur encourue lors de l'enregistrement en bdd","danger");
                    }



                }
            }else{
                $notify = new Notify("Vous avez déjà réalisé ce QCM","danger");
                header('Location: '. DIRNAME .'QCM');
            }



        }else{
            $notify = new Notify("Veuillez choisir un QCM","danger");
            header('Location: '. DIRNAME .'QCM');
        }

        //echo "Mark : ".$_SESSION['mark']."<br>";
        //var_dump($_SESSION['qcm_'.$params['URL'][0]]);
        //echo "Nb Questions : ".$_SESSION['nbQuestions']."<br>";
        //echo "Current Questions : ".$_SESSION['currentQuestion']."<br>";
        //echo "Good Answer : ".$_SESSION['goodAnswer']."<br>";
        //echo "ID Current Questions : ".$_SESSION['idCurrentQuestion']."<br>";

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
                        $qcm = new QCM($params['URL'][0]);
                        $qcm->setLabel($params['POST']['label']);
                        $qcm->setTeacher($db->userInfoByToken()['id']);
                        $qcm->setClasse($params['POST']['classe']);
                        $qcm->save();

                        $notify = new Notify("Le QCM a été modifié avec succés","success");

                        header('Location: '.DIRNAME.'QCM/edit/'. $params['URL'][0]);
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

    public function deleteAction($params) {
        // modifier en ajoutant les supressions en cascades ?

        $qcm = new QCM($params['URL'][0]);
        $qcm->delete();

        new Notify("Le QCM a bien été supprimé", "success");

        header('Location: '.DIRNAME.'chapter/list');
        exit();


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

                    if(isset($params['POST']['terminer']) && !empty($params['POST']['terminer'])) {
                        $notify = new Notify("QCM enregistré", "success");
                        header('Location: ' . DIRNAME . 'QCM');
                    }
                    else {
                        $notify = new Notify("La question a été créée avec succés", "success");
                        header('Location: ' . DIRNAME . 'QCM/createQuestion/' . $params['URL'][0]);
                    }
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