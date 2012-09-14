<?php

class Event {
	public $id;
	public $organizer_userid;
	public $name;
	public $reason;
	public $location;
	public $lat;
	public $longi;
	public $date;
	public $time;
	public $duration;
	public $category;
	public $descr;
	private $picURL;
	
	function __construct() 
    { 
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    } 

	/*public function __construct()  
    {  
	} */
	
	public function __construct1($db_event_row)
	{
		$this->id                = $db_event_row['eventid'];
		$this->organizer_userid  = $db_event_row['userid'];
		$this->name              = $db_event_row['name'];
		$this->reason            = $db_event_row['reason'];
		$this->location          = $db_event_row['location'];
		$this->lat               = $db_event_row['lat'];
		$this->longi             = $db_event_row['longi'];
		$this->date              = $db_event_row['date'];
		$this->time              = $db_event_row['time'];
		$this->duration          = $db_event_row['duration'];
		$this->category          = $db_event_row['category'];
		$this->descr             = $db_event_row['descr'];
		$this->setPicURL($db_event_row['pic']);
	}
	
	public function getEventURL()
	{
		return "event.php?id=" . $this->id;
	}
	
	public function getPicURL()
	{
		return $this->picURL;
	}
	
	private function setPicURL($pic) 
	{
		if ($pic != Null) {
			$this->picURL = "picscript.php?id=" . $this->id;
			return;
		}
		
		switch ($this->category) {
			case "Shortterm":
				$this->picURL = "images/shorttterm.jpg";
				break;
			case "HealthNdisability":
				$this->picURL = "images/disabled.jpg";
				break;
			case "Animals":
				$this->picURL = "images/animals.jpg";
				break;
			case "ArtsNCulture":
				$this->picURL = "images/arts.jpg";
				break;
			case "Politics":
				$this->picURL = "images/politics.jpg";
				break;
			case "ChildrenNAdolescents":
				$this->picURL = "images/children.jpg";
				break;
			case "Fundraising":
				$this->picURL = "images/fundraising.jpg";
				break;
			case "Legal":
				$this->picURL = "images/legal.jpg";
				break;
			case "Office":
				$this->picURL = "images/office.jpg";
				break;
			case "Olderpeople":
				$this->picURL = "images/older.jpg";
				break;
			case "Physicalwork":
				$this->picURL = "images/physical.jpg";
				break;
			case "SportsNrecreation":
				$this->picURL = "images/sports.jpg";
				break;
			case "Computers":
				$this->picURL = "images/computers.jpg";
				break;
			case "Religion":
				$this->picURL = "images/religion.jpg";
				break;
			default:
				$this->picURL = "images/Volunteering.jpg";	
				break;
		}
	}
	
	public function getUserJoinURL($userid)
	{
		return "join_store.php?id=" . $this->id . "&uid=" . $userid;
	}
}

?>