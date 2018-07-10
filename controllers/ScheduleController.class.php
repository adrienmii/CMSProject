<?php

class ScheduleController {

    public function listAction($params) {        

        $BSQL = new BaseSQL();
        $settings = $BSQL->getScheduleSettings();

        if(count($settings)>1){
            $v = new View("listSchedule");
        }else{
             header('Location: '.DIRNAME.'schedule/add');
        }

    }

    public function addAction($params) {        

        $settings = new ScheduleSettings();
        $form = $settings->generateForm();

        $errors = null;

        if (!empty($params['POST'])) {

            $errors = Validator::validateScheduleSettings($form, $params['POST']);

            if (empty($errors)) {

                $settings = new ScheduleSettings();
                $settings->setDays($params['POST']['days']);
                $settings->setFirstHour($params['POST']['firstHour']);
                $settings->setLastHour($params['POST']['lastHour']);
                $settings->setLunchTime($params['POST']['lunchTime']);
                $settings->setLunchHour($params['POST']['lunchHour']);
                $settings->setCourseTime($params['POST']['courseTime']);
                $settings->save();

                $notify = new Notify("Vos paramètres ont été créés avec succés", "success");

                header('Location: '.DIRNAME.'schedule/list');
                exit();
            }else{
                $notify = new Notify($errors,"danger");
            }

        }

        $v = new View("addScheduleSettings");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
        
    }

	
}