<?php
if(!isset($_FILES['image']))
    {
    echo '<b>Please select a file</b><br>';
    }
else
    {
	echo $_FILES['image'];
	echo "<b> YESSSSSSS</b>";
	}

?>