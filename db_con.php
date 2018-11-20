<?php
####################################################
#+------------------------------------------------+#
#|Project:       ULWF                             |#
#|Filename:      lib.core.php                     |#
#|Licence:       © Open Licence			          |#
#|Created by:    Anto Ivankovic / Samuel Maissen  |#
#+------------------------------------------------+#
####################################################

// DB Connection

$db = new mysqli("127.0.0.1", "root", "",/*"antoivan.mysql.db.hostpoint.ch", "antoivan_root", "Githubhustlers7000!",*/ "antoivan_ULoseWeFind");

if ($db->connect_errno) {
	printf("Connect failed: %s\n", $db->connect_error);
	exit();
}

?>