<?php

// DB Connection

$db = new mysqli("localhost", "root", "", "ulwf");

if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

?>