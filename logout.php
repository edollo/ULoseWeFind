<?php
	//Vorg�gnge damit Session komplett entfernt wird
	session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
	session_destroy();

	header ('Location:index.html');
?>