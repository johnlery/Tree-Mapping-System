<?php

		$con = mysql_connect('localhost','root','');

		if(!$con)
		{
			echo "Could not connect to database!";
		}
		else
		

		mysql_select_db('db_mapping');
?>
