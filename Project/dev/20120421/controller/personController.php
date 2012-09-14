<?php
include_once("model/personModel.php");

class PersonController {
     public $model;	

     public function __construct()
     {
          $this->model = new PersonModel();
     } 

     public function invoke()
     {
		if (!isset($_GET['id']))
		{
		   // TODO: do something if no user id is provided.
		}
		else
		{
			$userId = $this->model->getCurrentUserId();
			if ($userId == $_GET['id']) {
				header( 'Location: profile.php' ) ;
				return;
			}
			$person = $this->model->getPerson($userId);
			// show the requested person
			$user = $this->model->getPerson($_GET['id']);
			$userPastEventsOrganized = $this->model->getPersonPastEventsOrganized($_GET['id']);
			$userFutureEventsOrganizing = $this->model->getPersonFutureEventsOrganizing($_GET['id']);
			$userEventsJoined = $this->model->getPersonEventsJoined($_GET['id']);
			include 'view/personView.php';
		}
     }
}
?>