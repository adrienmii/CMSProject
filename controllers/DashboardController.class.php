<?php

class DashboardController {

    public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

	public function indexAction($params) {		

		$BSQL = new BaseSQL();
		$userinfo = $BSQL->userInfoByToken();
		$user = new User($userinfo["id"]);

		
        $form = $user->generateNewPwdUserForm();
        $form['userInfo'] = $userinfo;
        $errors = null;

        if($userinfo['rank'] == 1){
            $form['countAllTeachers'] = $BSQL->countAllTeachers()['count'];
            $form['countAllStudents'] = $BSQL->countAllStudents()['count'];
            $form['countAllClasses'] = $BSQL->countAllClasses()['count'];
            $form['countAllChapters'] = $BSQL->countAllChapters()['count'];
        } elseif($userinfo['rank'] == 2){
            $form['countClassByTeachers'] = $BSQL->countClassByTeacher($userinfo["id"])['count'];
            $form['countStudentsByTeacher'] = $BSQL->countStudentsByTeacher($userinfo["id"])['count'];
            $form['countQCMByTeacher'] = $BSQL->countQCMByTeacher($userinfo["id"])['count'];
            $form['countCoursesByTeacher'] = $BSQL->countCoursesByTeacher($userinfo["id"])['count'];
        } else{
            $marks = $BSQL->getMarksFromStudentId($userinfo["id"]);
            $form['dataChart'] = [0, 0, 0, 0];
            $form['average'] = null;
            $form['myClass'] = $BSQL->classeInfoById($userinfo["classe"])['classname'];
            $form['nbQCMDone'] = $BSQL->countQCMDoneByUserId($userinfo["id"])['count'];
            if(isset($userinfo["classe"]) && !empty($userinfo["classe"]))
                $form['nbQCMNotDone'] = $BSQL->countQCMNotDoneByUserId($userinfo["classe"], $userinfo["id"])['count'];
            $total = 0;
            foreach ($marks as $mark){
                $total += $mark['mark'];
                if($mark['mark'] < 5)
                    $form['dataChart'][0] ++;
                elseif($mark['mark'] >= 5 && $mark['mark'] < 10)
                    $form['dataChart'][1] ++;
                elseif($mark['mark'] >= 10 && $mark['mark'] < 15)
                    $form['dataChart'][2] ++;
                else
                    $form['dataChart'][3] ++;
            }
            $form['average'] = (count($marks) != 0) ? round(($total/count($marks))*2)/2 : "-";
        }

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateEditUser($form, $params['POST']);

            $pwd = $params['POST']['pwd'];
            $pwd2 = $params['POST']['pwd2'];

            if($pwd != $pwd2){
                $errors = "Les mots de passe doivent être identiques";
            }

            if (empty($errors)) {
                $user->setPwdChanged(1);                
                $user->setPwd($params['POST']['pwd']);
                $user->save();

                $notify = new Notify("Votre mot de passe a été modifié avec succès","success");               
            }else{
                $notify = new Notify($errors,"danger");
            }

        }

		$v = new View("dashboard", "front");

		$v->assign("config", $form);
        $v->assign("errors", $errors);
	}
}