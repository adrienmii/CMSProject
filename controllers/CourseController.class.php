<?php

class CourseController {
	

	public function viewAction($params) {

        $BSQL = new BaseSQL();
        $course = $BSQL->courseInfoById($params['URL'][0]);

		$v = new View("course");
        $v->assign("course", $course);
		
	}

	public function addAction($params) {

        $course = new Course();
        $form = $course->generateFormAddCourse();

        $errors = null;
        $post = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateCourse($form, $params['POST']);

            if (empty($errors)) {

                $bdd = new BaseSQL();

                $course = new Course();
                $course->setTitle($params['POST']['title']);
                $course->setContent($params['POST']['content']);
                $course->setTeacher($bdd->userInfoByToken()['id']);
                $course->setChapter($params['POST']['chapter']);
                $course->save();

                $notify = new Notify("Le cours ".$params['POST']['title']." a bien été crée", "success");

                header('Location: '.DIRNAME.'course/list');
                exit();
            }else{
                $form['post'] = $params['POST'];
                $notify = new Notify($errors,"danger");
            }

        }

		$v = new View("addCourse");
        $v->assign("config", $form);
        $v->assign("errors", $errors);

	}

    public function listAction($params) {
        $BSQL = new BaseSQL();
        $user = $BSQL->userInfoByToken();
        $courses = $BSQL->getCoursesByTeacher($user['id']);

        $v = new View("myCourses");
        $v->assign("courses", $courses);
    }



	public function editAction($params) {

        $course = new Course();
        $form = $course->generateFormAddCourse();
        $BaseSQL = new BaseSQL();
        $form['prefill'] = $BaseSQL->courseInfoById($params['URL'][0]);

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateCourse($form, $params['POST']);

            if (empty($errors)) {

                $bdd = new BaseSQL();

                $course = new Course($params['URL'][0]);
                $course->setTitle($params['POST']['title']);
                $course->setContent($params['POST']['content']);
                $course->setTeacher($bdd->userInfoByToken()['id']);
                $course->setChapter($params['POST']['chapter']);
                $course->save();

                $notify = new Notify("Le cours ".$params['POST']['title']." a bien été modifié", "success");

                header('Location: '.DIRNAME.'course/list');
                exit();
            }else{
                $form['post'] = $params['POST'];
                $notify = new Notify($errors,"danger");
            }

        }

        $v = new View("addCourse");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
		
	}

    public function deleteAction($params) {
        // modifier en ajoutant les supressions en cascades ?

        $course = new Course($params['URL'][0]);
        $course->delete();

        new Notify("Le cours a bien été supprimé", "success");

        header('Location: '.DIRNAME.'course/list');
        exit();


    }
	
}