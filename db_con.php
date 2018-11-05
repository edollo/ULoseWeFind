<?php

// DB Connection

$db = new mysqli("antoivan.mysql.db.hostpoint.ch", "antoivan_root", "Githubhustlers7000!", "antoivan_ULoseWeFind");

if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

?>