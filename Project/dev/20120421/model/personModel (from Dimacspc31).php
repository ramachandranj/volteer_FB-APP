<?php
include_once("model/person.php");
include_once("model/event.php");
require("facebook.php");
include_once("credentials.php");
include_once("mysql.php");

$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));

db_connect();

class PersonModel {
/*	public function getBookList()
	{
		// here goes some hardcoded values to simulate the database
		return array(
			"Jungle Book" => new Book("Jungle Book", "R. Kipling", "A classic book."),
			"Moonwalker" => new Book("Moonwalker", "J. Walker", ""),
			"PHP for Dummies" => new Book("PHP for Dummies", "Some Smart Guy", "")
		);
	}*/

	public function getCurrentUserId()
	{
		global $facebook;
		$userId = $facebook->getUser();
		if ($userId)
		{ 
			if (db_check_id($userId) == False) {
				return False;
			}
			return $userId;
		}
		return False;
	}
	
	public function getPerson($id)
	{
		// we use the previous function to get all the books and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		//$allBooks = $this->getBookList();
		//return $allBooks[$title];
		$person_row = db_get_user($id);
		if ($person_row == False) {
			return Null;
		}
		
		// get facebook data
		global $facebook;
		$fb_userdata = $facebook->api('/' . $id);
		
		// create person object and fill its data
		$person = new Person($person_row);
		$person->fb_link = $fb_userdata['link'];
		$person->gender = $fb_userdata['gender'];
		$person->first_name = $fb_userdata['first_name'];
		/*
		$fb_feed_response = $facebook->api('/'.$id.'/feed?limit=1&access_token='.$person_row['access_code']);
		try {
			$person->status = $fb_feed_response['data'][0]['message'];
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}*/	
		
		return $person;
	}
	
	private function fetchEvents($query)
	{
		$result = array();
		if ($query==False) {
			return $result;
		}
		while ($event_row = mysql_fetch_assoc($query)){
			$event = new Event($event_row);
			$result[$event->id] = $event;
		}
		return $result;
	}
	
	public function getPersonEventsOrganized($id)
	{
		$events_query = db_get_user_events_organizing($id);
		return $this->fetchEvents($events_query);
	}
	
	public function getPersonPastEventsOrganized($id)
	{
		$events_query = db_get_user_past_events_organized($id);
		return $this->fetchEvents($events_query);
	}
	
	public function getPersonFutureEventsOrganizing($id)
	{
		$events_query = db_get_user_future_events_organizing($id);
		return $this->fetchEvents($events_query);
	}
	
	public function getPersonEventsJoined($id)
	{
		$events_query = db_get_user_events_joined($id);
		return $this->fetchEvents($events_query);
	}
}
?>