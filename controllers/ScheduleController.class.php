<?php

class ScheduleController {

    public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

    public function listAction($params) {        

        $BaseSQL = new BaseSQL();
        $settings = $BaseSQL->getScheduleSettings();

        if(count($settings)>1){
            $classes = $BaseSQL->getAllClasses();
            $v = new View("listSchedule");
            $v->assign("classes", $classes);

        }else{
             header('Location: '.DIRNAME.'schedule/editScheduleSettingsAction');
        }

    }

    public function editScheduleSettingsAction($params) {        

        $BaseSQL = new BaseSQL();
        $settings = new ScheduleSettings(1);
        $form = $settings->generateForm();
        $form['prefill'] = $BaseSQL->getAllById('ScheduleSettings', 1);

        $errors = null;

        if (!empty($params['POST'])) {

            $errors = Validator::validateScheduleSettings($form, $params['POST']);

            if (empty($errors)) {

                $firstHour = $params['POST']['firstHour'];
                $lastHour = $params['POST']['lastHour'];
                $lunchTime = $params['POST']['lunchTime'];
                $lunchHour = $params['POST']['lunchHour'];
                $courseTime = $params['POST']['courseTime'];
                
                $settings->setDays($params['POST']['days']);
                $settings->setFirstHour($firstHour);
                $settings->setLastHour($lastHour);
                $settings->setLunchTime($lunchTime);
                $settings->setLunchHour($lunchHour);
                $settings->setCourseTime($courseTime);
                $settings->setNbCoursePerDay($this->getNbCoursePerDay($firstHour,$lastHour,$lunchTime,$lunchHour,$courseTime));
                $settings->save();

                $notify = new Notify("Vos paramètres ont été créés avec succés", "success");

                header('Location: '.DIRNAME.'schedule/list');
                exit();
            }else{
                $form['post'] = $params['POST'];
                $notify = new Notify($errors,"danger");
            }

        }

        $v = new View("scheduleSettings");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
        
    }

    public function addAction($params) {        

        $course = new ScheduleCourse();
        $form = $course->generateForm($params['URL'][1],$params['URL'][2],$params['URL'][3]);

        $errors = null;

        if (!empty($params['POST'])) {

            $errors = Validator::validateAddScheduleCourse($form, $params['POST']);

            if (empty($errors)) {

                $course = new ScheduleCourse();

                $course->setMatiere($params['POST']['matiere']);
                $course->setRoom($params['POST']['room']);
                $course->setUserID($params['POST']['userID']);
                $course->setClassID($params['URL'][0]);
                $course->setWeek($params['URL'][1]);
                $course->setDay($params['URL'][2]);
                $course->setStartHour($params['URL'][3]);

                $course->save();

                new Notify("La cours a bien été ajoutée", "success");

                 //à modifier
                header('Location: '.DIRNAME.'schedule/view/'.$params['URL'][0]."/".$params['URL'][1]."/".$params['URL'][4]);
                exit();
            } else {
                new Notify($errors, "danger");
            }

        }

		$v = new View("addScheduleCourse");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
       

    }

    public function editAction($params) {
        $course = new ScheduleCourse();
        $form = $course->generateForm($params['URL'][1],$params['URL'][2],$params['URL'][3]);
        $BaseSQL = new BaseSQL();
        $form['prefill'] = $BaseSQL->scheduleCourseInfoByID($params['URL'][5]);

        $errors = null;

        if (!empty($params['POST'])) {

            $errors = Validator::validateAddScheduleCourse($form, $params['POST']);

            if (empty($errors)) {

                $course = new ScheduleCourse($params['URL'][0]);

                $course->setMatiere($params['POST']['matiere']);
                $course->setRoom($params['POST']['room']);
                $course->setUserID($params['POST']['userID']);
                $course->save();

                new Notify("La modification a bien été effectuée", "success");

                header('Location: '.DIRNAME.'schedule/view/'.$course->getDay()."/".$params['URL'][1]."/".$params['URL'][4]);

                exit();
            } else {
                new Notify($errors, "danger");
            }

        }
        $v = new View("editScheduleCourse");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
    }

    public function deleteAction($params) {

        $course = new ScheduleCourse($params['URL'][0]);
        $course->delete();

        new Notify("La cours a bien été supprimée", "success");

        header('Location: '.$_SERVER['HTTP_REFERER'].'');
        exit();
	}

    public function viewAction($params) {        

        

        $BaseSQL = new BaseSQL();

        $user = $BaseSQL->userInfoByToken();

        if($user["rank"]==3 && $user["classe"] != $params['URL'][0]){

            header('Location: '.DIRNAME.'error');
            exit;

        }

        $scheduleSettings = $BaseSQL->getAllById("ScheduleSettings","1");

        $year = $params['URL'][2]; 
        $week = $params['URL'][1];
        $class = $BaseSQL->classeInfoById($params['URL'][0]);
        // nombre de jours de cours pas semaine configuré par admin
        $nbDaysPerWeek = $scheduleSettings["days"];
        // la semaine affiché (celle de la date courante de base)
        $currentWeek = $this->convertMonth(date('n', strtotime($year.'-W'.$week)));

        $firstHour = explode(':', $scheduleSettings['firstHour']);
        $firstHour = $firstHour[0] + floor(($firstHour[1]/60)*100) / 100;
        
        $lunchHour = explode(':', $scheduleSettings['lunchHour']);
        $lunchHour = $lunchHour[0] + floor(($lunchHour[1]/60)*100) / 100;

        $courseTime = explode(':', $scheduleSettings['courseTime']);
        $courseTime = $courseTime[0] + floor(($courseTime[1]/60)*100) / 100;

        $lunchTime = explode(':', $scheduleSettings['lunchTime']);
        $lunchTime = $lunchTime[0] + floor(($lunchTime[1]/60)*100) / 100;

        $nbCoursesPerDay = $this->getNbCoursePerDay($scheduleSettings["firstHour"],$scheduleSettings["lastHour"],$scheduleSettings["lunchTime"],$scheduleSettings["lunchHour"],$scheduleSettings["courseTime"]);

        // tout les créneaux horaire d'une journée de cours
        $hourTable = array();
        for($i = 0; $i <= $nbCoursesPerDay; $i++){
            if($i == 0){
                $hour = $firstHour ;
            }else{
                $hour += $courseTime ;
                if($hour - $courseTime == $lunchHour){
                  $hour = $hour - $courseTime + $lunchTime ;
                }
                
            }
            
            array_push($hourTable, floor($hour) . ':' . str_pad((($hour * 60) % 60), 2, "0", STR_PAD_RIGHT));
            
        }
       
        $weekDaysArray = array();
        $dto = new \DateTime();
        $dto->setISODate($year, $week);

        // tableau clé=>valeur avec les dates
        for($i = 0; $i < $nbDaysPerWeek; $i++) {
            $weekDaysArray[]= [
                'str' => $this->convertDay($dto->format('N')).$dto->format(' d/m/Y'),
                'str_short' => $this->convertDay($dto->format('N')).$dto->format(' d/m'),
                'd' => $dto->format('d'),
                'm' => $dto->format('m'),
                'y' => $dto->format('Y')
            ];
            $dto->modify("+1 days");
        }

        // important pour avancer d'une année en semaine 52
        $dto->modify("+1 week");

        $goToPreviousWeek = date( "W/Y", strtotime($year.'-W'.$week." -1 week"));
        $goToNextWeek = date( "W/", strtotime($year.'-W'.$week." +1 week")).$dto->format('Y');


        //Récupération des cours planifier en fonction de classe/n°semaine ou de l'id du prof 
        if($user["rank"]==1 || $user["rank"]==3){
            $courseList = $BaseSQL->getScheduleCourseByClassAndWeek($params['URL'][0],$week);
        }else{
            $courseList = $BaseSQL->getScheduleCourseTeacher($user["id"],$week);
        }

        $v = new View("edt");
        $v->assign("weekDaysArray", $weekDaysArray);
        $v->assign("goToPreviousWeek", $goToPreviousWeek);
        $v->assign("goToNextWeek", $goToNextWeek);
        $v->assign("lunchHour", $scheduleSettings['lunchHour']);
        $v->assign("hourTable", $hourTable);
        $v->assign("courseList", $courseList);
        $v->assign("class", $class);
        $v->assign("week", $week);
        $v->assign("year", $year);
        $v->assign("user",$user);
    }

    private function getNbCoursePerDay($firstHour,$lastHour,$lunchTime,$lunchHour,$courseTime){
        
        $firstHourExploded = explode(':', $firstHour);
        $lastHourExploded = explode(':', $lastHour);
        $lunchTimeExploded = explode(':', $lunchTime);

        //conversion en minute des variables
        $minutesLunchTime = ($lunchTimeExploded[0] * 60.0 + $lunchTimeExploded[1] * 1.0);
        $courseTimeExploded = explode(':', $courseTime);
        $minutesCourseTime = ($courseTimeExploded[0] * 60.0 + $courseTimeExploded[1] * 1.0);

        // Calcul du nombres de minutes dans une journée ex:8h45 à 17h30 = 9x60
        $minutesDay = 0;
        for($i = intval($firstHourExploded[0]); $i < intval($lastHourExploded[0]); $i++){
            $minutesDay += 60;
        }

        // on ajoute les minutes de la derniere heure de cours ex:+30 min de 17h30
        $minutesDay += $lastHourExploded[1];
        // on retire les minutes de la premiere heure de cours ex:-45 min de 8h45
        $minutesDay -= $firstHourExploded[1];
         // on retire les minutes de la pause lunch
        $minutesDay -= $minutesLunchTime;
        // on divise le nombre total de cours en minutes par la durée d'un cours en minutes 
        $nbCoursesPerDay = $minutesDay/$minutesCourseTime;

        return $nbCoursesPerDay;
    }

    private function convertDay($day){
        $days = array (1=>'Lundi',2=>'Mardi',3=>'Mercredi',4=>'Jeudi',5=>'Vendredi',6=>'Samedi',7=>'Dimanche');
        return $days[(int)$day];
    }

    private function convertMonth($month){
        $months = array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');
        return $months[(int)$month];
    }
	
}