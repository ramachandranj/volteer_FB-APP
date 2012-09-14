<?php
include_once("model/personModel.php");
include_once("model/eventModel.php");

class IndexController {
     public $personModel;	
	 public $eventModel;
	 
     public function __construct()
     {
          $this->personModel = new PersonModel();
		  $this->eventModel = new EventModel();
     } 

     public function invoke()
     {
		$userId = $this->personModel->getCurrentUserId();
		$person = Null;
		$nextEvents = array();
        if ($userId != False)
        {
            // get the requested person
			$this->personModel->updateUserToken($userId);
		    $person = $this->personModel->getPerson($userId);
			if ($person != Null) {
				$nextEvents = $this->personModel->getPersonComingEvents($person);
			}
        }
		
		if (count($nextEvents) < 3) {
			$nextEvents = $nextEvents + $this->eventModel->getNextEvents();
			$nextEvents = array_slice($nextEvents, 0, 3);
		}
		include 'view/indexView.php';
     }
}
?>