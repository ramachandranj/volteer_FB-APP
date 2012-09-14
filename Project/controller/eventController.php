<?php
include_once("model/personModel.php");
include_once("model/eventModel.php");

class EventController {
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
		
		// if not logged-in and trying to create/edit an event
		if ($person == Null && (!isset($_GET['id']) || (isset($_GET['mode']) && $_GET['mode'] == 'edit'))) {
			include 'view/pleaseLogin.php';
			return;
		}
		
		if (isset($_GET['id'])) 
		{
			// get the event
			$event = $this->eventModel->getEvent($_GET['id']);
			if ($event == Null) {
				print("Cannot find the requested event");
				return;
			}
			
			// edit or view mode
			if (isset($_GET['mode']) && $_GET['mode'] == 'edit') 
			{
				include 'view/editEventView.php';
			} else {
				$event_organizer = $this->personModel->getPerson($event->organizer_userid);
				$event_participants = $this->personModel->getEventParticipants($event->id);
				$is_user_a_participant = ($person == Null) ? False : $this->personModel->isEventParticipant($person->id, $event->id);
				include 'view/eventView.php';
			}
			
		} else {
			include 'view/createEventView.php';
		}
     }
}
?>