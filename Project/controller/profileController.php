<?php
include_once("model/personModel.php");

class ProfileController {
     public $model;	

     public function __construct()
     {
          $this->model = new PersonModel();
     } 

     public function invoke()
     {
		$userId = $this->model->getCurrentUserId();
        if ($userId == False)
        {
            include 'view/pleaseLogin.php';
        }
        else
        {
            // show the requested person
		    $person = $this->model->getPerson($userId);
			$personPastEventsOrganized = $this->model->getPersonPastEventsOrganized($userId);
			$personFutureEventsOrganizing = $this->model->getPersonFutureEventsOrganizing($userId);
			$personEventsJoined = $this->model->getPersonEventsJoined($userId);
			include 'view/profileView.php';
          }
     }
}
?>