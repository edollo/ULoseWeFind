<?php
//###################################################
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//|Project:       ULWF                             |#
//|Filename:      db_con.php                       |#
//|Licence:       © Open Licence			       |#
//|Created by:    Anto Ivankovic / Samuel Maissen  |#
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//###################################################


// DB Connection

$db = new mysqli("antoivan.mysql.db.hostpoint.ch", "antoivan_app", "Githubhustlers7000!", "antoivan_ULoseWeFind");

if ($db->connect_errno) {
	printf("Connect failed: %s\n", $db->connect_error);
	exit();
}

?>