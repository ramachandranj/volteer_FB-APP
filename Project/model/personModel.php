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
	
	protected function createPerson($id, $name)
	{
		global $facebook;
		db_insert_id($id, $name, $facebook->getAccessToken());
	}
	
	public function updateUserToken($id)
	{
		global $facebook;
		db_update_token($id, $facebook->getAccessToken());
	}
	
	public function getPerson($id)
	{
		$person_row = db_get_user($id);
		
		// get facebook data
		global $facebook;
		$fb_userdata = $facebook->api('/' . $id . '?fields=id,name,first_name,link,gender,location');
		
		if ($person_row == False) {
			$this->createPerson($id, $fb_userdata['name']);
			$person_row = db_get_user($id);
			if ($person_row == False) {
				return Null;
			}
		}
		
		// create person object and fill its data
		$person = new Person($person_row);
		$person->fb_link = $fb_userdata['link'];
		$person->fb_logoutURL = $facebook->getLogoutUrl(array( 'next' => getAbsoluteBaseURL() . '/logout.php' ));
		$person->gender = $fb_userdata['gender'];
		$person->first_name = $fb_userdata['first_name'];
		if (array_key_exists('location', $fb_userdata)) {
			$person->location = $fb_userdata['location']['name'];
			$location_data = $facebook->api('/' . $fb_userdata['location']['id']);
			$person->geo_location = array("lat" => $location_data['location']['latitude'], "long" => $location_data['location']['longitude']);
		}
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
	
	private function fetchPeople($query)
	{
		$result = array();
		if ($query==False) {
			return $result;
		}
		while ($person_row = mysql_fetch_assoc($query)){
			$person = new Person($person_row);
			$result[$person->id] = $person;
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
	
	public function getPersonComingEvents($person)
	{
		if ($person->geo_location == Null) {
			return array();
		}
		$events_query = db_get_next_events_user($person->geo_location);
		return $this->fetchEvents($events_query);
	}
	
	public function getEventParticipants($eventid)
	{
		$users_query = db_get_event_participants($eventid);
		return $this->fetchPeople($users_query);
	}
	
	public function isEventParticipant($userid, $eventid)
	{
		return db_is_event_participant($userid, $eventid);
	}
}

function getAbsoluteBaseURL() 
{ 
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
    return $protocol."://".$_SERVER['SERVER_NAME'].$port.dirname($_SERVER['REQUEST_URI']); 
} 

function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
?>