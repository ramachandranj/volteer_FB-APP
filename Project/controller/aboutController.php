<?php
include_once("model/personModel.php");

class AboutController {
     public $personModel;

     public function __construct()
     {
          $this->personModel = new PersonModel();
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
		
		include 'view/aboutView.php';
     }
}
?>