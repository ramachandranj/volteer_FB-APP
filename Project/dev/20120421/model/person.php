<?php

class Person {
	public $id;
	public $name;
	public $first_name;
	public $access_token;
	public $motto;
	public $category1;
	public $category2;
	public $category3;
	public $fb_link;
	public $fb_logoutURL;
	public $gender;
	public $location;
	public $geo_location;
	
	function __construct() 
    { 
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    } 
	
	public function __construct1($db_user_row)
	{
		$this->__construct3($db_user_row['id'], $db_user_row['name'], $db_user_row['access_code']);
		$this->motto      = $db_user_row['motto'];
		$this->category1  = $db_user_row['category1'];
		$this->category2  = $db_user_row['category2'];
		$this->category3  = $db_user_row['category3'];
	}
	
	public function __construct3($id, $name, $access_token)  
    {  
		$this->id = $id;
        $this->name = $name;
		$name_split = explode(" ", $name);
		if (count($name_split) < 1) {
			$this->first_name = '';
		} else {
			$this->first_name = $name_split[0];
		}
	    $this->access_token = $access_token;
		$this->fb_link = '#';
		$this->fb_logoutURL = '#';
		$this->gender = '';
		$this->location = '';
		$this->geo_location = Null;
    } 
	
	public function getLargePicURL()
	{
		return "https://graph.facebook.com/" . $this->id . "/picture?type=large";
	}
	
	public function getSquarePicUrl()
	{
		return "https://graph.facebook.com/" . $this->id . "/picture?type=square";
	}
}

?>