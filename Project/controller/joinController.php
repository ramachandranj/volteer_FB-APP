<?php
include_once("model/personModel.php");
include_once("model/eventModel.php");

class JoinController {
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
        if ($userId != False)
        {
            // get the current user
			$person = $this->personModel->getPerson($userId);
		}
		
		// if not logged-in 
		if ($person == Null)
		{
			include 'view/pleaseLogin.php';
			return;
		}
		
		if (isset($_POST['area'])) {
			$events = $this->eventModel->getUserJoinableEventsForLoaction($userId, $_POST['area']);
		} elseif (!isset($_GET['category'])) {
			$events = $this->eventModel->getUserJoinableEvents($userId);
		} else {
			$events = $this->eventModel->getUserJoinableEventsForCategory($userId, $_GET['category']);
		}
		include 'view/joinView.php';
     }
}
?>