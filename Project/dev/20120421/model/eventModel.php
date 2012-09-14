<?php
include_once("model/event.php");
include_once("credentials.php");
include_once("mysql.php");

db_connect();

class EventModel {
	public function getEvent($id)
	{
		$event_row = db_get_event($id);
		if ($event_row == False) {
			return Null;
		}
		
		// create event object and fill its data
		$event = new Event($event_row);
		
		return $event;
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
	
	public function getUserJoinableEvents($userid)
	{
		$events_query = db_get_user_joinable_events($userid);
		return $this->fetchEvents($events_query);
	}
	
	public function getUserJoinableEventsForLoaction($userid, $loc)
	{
		$events_query = db_get_user_joinable_events_for_location($userid, $loc);
		return $this->fetchEvents($events_query);
	}
	
	public function getUserJoinableEventsForCategory($userid, $category)
	{
		$events_query = db_get_user_joinable_events_for_category($userid, $category);
		return $this->fetchEvents($events_query);
	}
	
	public function getNextEvents()
	{
		$events_query = db_get_next_events();
		return $this->fetchEvents($events_query);
	}
}
?>