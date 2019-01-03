﻿<?php 
####################################################
#+------------------------------------------------+#
#|Project:       ULWF                             |#
#|Filename:      db_query.php                     |#
#|Licence:       © Open Licence			          |#
#|Created by:    Anto Ivankovic / Samuel Maissen  |#
#+------------------------------------------------+#
####################################################
session_start();

//error_reporting(0);
include("db_con.php");

//Login Prozedur
if(isset($_POST['login_btn'])) {


//Security /Variablenauslesen
$bindpw = mysqli_real_escape_string($db, $_POST['psw']);
$bindun = mysqli_real_escape_string($db, $_POST['uname']);

$query = "SELECT Email, Passwort, idPerson FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		//überprüfung benutzer vorhanden
		if (mysqli_num_rows($result) !== 0)
		{	
			while ($row = $result->fetch_assoc()) {

				//password in hash verwandeln (anhand userid)
				$pw = hash('sha256', $bindpw . $row["idPerson"]);

				//überprüfen ob Benutzerdaten korrekt sind
				if ($bindun == $row["Email"] and $pw == $row["Passwort"])  {
	
					$_SESSION['uname'] = $bindun;
					echo "valid";
				}
				else {
					echo "invalidpw";
					
					//Vorgägnge damit Session komplett entfernt wird
					session_unset();
					session_destroy();
					session_write_close();
					setcookie(session_name(),'',0,'/');
					session_regenerate_id(true);
					session_destroy();
					
				}
			}
		}	
		else{
			
			echo "invaliduname";
			session_destroy();			
			
		}	
	}
	$result->free();	
		
}

//weiterleiten auf SignUp Seite
if(isset($_POST['signup_btn'])) {
    header('Refresh: 0 ; url=sign_up.php');
}

//Überprüfung email
if(isset($_POST['ValidateUname'])) {


	//validieren ob richtige Emailadresse
	if (!filter_var($_POST['su_email'], FILTER_VALIDATE_EMAIL)) {
		echo "emailincorrect";
		$mailcorrect = false;
		return;
	}
	else
	{
		$mailcorrect = true;
	}

	//Security /Variablenauslesen
	$bindun = mysqli_real_escape_string($db, $_POST['su_email']);
	
	$query = "SELECT Email FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		//Rückgabewert 0 --> Benutzer nicht vorhanden
		if (mysqli_num_rows($result) == 0)
		{
			echo "existsnot";
			$userexists = false;
		}
		else
		{
			while ($row = $result->fetch_assoc()) 
			{
				//eigener Name ist ok
				if($row["Email"] == $_SESSION['uname'])
				{
					echo "existsnot";
					$userexists = false;

				}
				else
				{
					echo "exists";
					$userexists = true;
				}
			}
		}
	}	
}

//überprüfung ob passwörter übereinstimmen
if(isset($_POST['su_psw_2'])) {
	
	$bindpw1 = $_POST['su_psw_1'];
	$bindpw2 = $_POST['su_psw_2'];

	if ($bindpw1 == $bindpw2) 
	{
		echo "matching";

		$pwcorrect = true;

	}
	else
	{
		echo "doesnotmatch";
		
		$pwcorrect = false;
	}
}

if(isset($_POST['up_psw_old'])) {


//Security /Variablenauslesen
$bindpw = mysqli_real_escape_string($db, $_POST['up_psw_old']);
$bindun = mysqli_real_escape_string($db, $_SESSION['uname']);

$query = "SELECT Email, Passwort, idPerson FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		//überprüfung benutzer vorhanden
		if (mysqli_num_rows($result) !== 0)
		{	
			while ($row = $result->fetch_assoc()) {

				//password in hash verwandeln (anhand userid)
				$pw = hash('sha256', $bindpw . $row["idPerson"]);

				//überprüfen ob Benutzerdaten korrekt sind
				if ($bindun == $row["Email"] and $pw == $row["Passwort"])  {
	
					echo "valid";
					$oldpwcorrect = true;
					
				}
				else {
					echo "invalidpw";
					$oldpwcorrect = false;
	
				}
			}
		}	
	}
	$result->free();	
}




//Registrierungs Prozedur
if(isset($_POST['su_signup_btn'])) {


	if (!$pwcorrect || $userexists || !$mailcorrect)
	{
		return;
	}

	//Security /Variablenauslesen
	$bindemail = mysqli_real_escape_string($db, $_POST['su_email']);
	$bindfirstname = mysqli_real_escape_string($db, $_POST['su_vorname']);
	$bindlastname = mysqli_real_escape_string($db, $_POST['su_name']);
	$bindpw2 = mysqli_real_escape_string($db, $_POST['su_psw_2']);
	
	//query's bilen
	//für password wird defaultwert gesetzt, falls das setzen des passworts fehlschlägt und der Datensatz nicht entfernt werden kann
	$queryinsert = "INSERT INTO `Person`(`Name`, `Nachname`, `Email`, `Anrede_idAnrede`, `Passwort`) VALUES ('".$bindfirstname."','".$bindlastname."','".$bindemail."',1,'default526607929f8bc596763776ee8204d68b17d105db293c373818d99d1')";
		
	if ($result = $db->query($queryinsert)) {
	
		if($db->affected_rows > 0)
		{
			//generieren des hash passworts
			$id = mysqli_insert_id($db);
			$pw = hash('sha256', $bindpw2 . $id);
			$querysetpw = "UPDATE `Person` SET `Passwort` = '".$pw."' WHERE `idPerson` = ".$id;

			if ($result = $db->query($querysetpw)) {
				if($db->affected_rows > 0)
				{
					echo "success";
				}
				else
				{
					//datensatz löschen falls password nicht gesetzt werden konnte
					$deletequery = "DELETE FROM `Person` WHERE idPerson=".$id." LIMIT 1";
					mysqli_query($db, $deletequery);
				}
			}
			else
			{
				//datensatz löschen falls password nicht gesetzt werden konnte
				$deletequery = "DELETE FROM `Person` WHERE idPerson=".$id." LIMIT 1";
				mysqli_query($db, $deletequery);
				echo "fail";
			}

				
		}
		else
		{
			echo "fail";
		
		}
	
	}	
}

if(isset($_POST['up_save_settings_btn'])) {

	///id holen
	$bindun = mysqli_real_escape_string($db, $_SESSION['uname']);
	$query = "SELECT idPerson FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		//überprüfung querry erfolgreich
		if (mysqli_num_rows($result) !== 0)
		{	
			while ($row = $result->fetch_assoc()) 
			{
				$id = $row["idPerson"];
			}
		}
		else 
		{
			echo "fail";
		}
		
	}
	else 
	{
		echo "fail";
	}
	
	$result->free();	
	
	
	///werte auslesen
	$bindemail = mysqli_real_escape_string($db, $_POST['su_email']);
	$bindfirstname = mysqli_real_escape_string($db, $_POST['up_vorname']);
	$bindlastname = mysqli_real_escape_string($db, $_POST['up_name']);
	
	


	//abfrage ob passwort auch gesetzt wird (passwort nicht ändern = neues passwort wird gesetzt)
	if ($_POST['up_change_pw_btn'] == "Passwort nicht Ändern")
	{
		//werte überprüfen
		if (!$pwcorrect || $userexists || !$mailcorrect || !$oldpwcorrect)
			{
				return;
				//abbruch
				
			}
			else
			{
				$bindpw2 = mysqli_real_escape_string($db, $_POST['su_psw_2']);
				$pw = hash('sha256', $bindpw2 . $id);
				$querychange = "UPDATE `Person` SET `Passwort` = '".$pw."', `Name` = '".$bindfirstname."', `Nachname` = '".$bindlastname."', `Email` = '".$bindemail."', `Anrede_idAnrede` = 1  WHERE `idPerson` = ".$id;
			}
	}
	else
	{
		//wenn passwort nicht geändert wird muss nur email überprüft werden
			if ($userexists || !$mailcorrect )
			{
				return;
				//abbruch
			}
			else
			{
				$querychange = "UPDATE `Person` SET `Name` = '".$bindfirstname."', `Nachname` = '".$bindlastname."', `Email` = '".$bindemail."', `Anrede_idAnrede` = 1 WHERE `idPerson` = ".$id;

			}
	}

	
	///daten schreiben
	
	if ($result = $db->query($querychange)) {
		if($db->affected_rows > 0)
		{
			echo "success";
			
			//Neue Mail in SESSION setzen
			$_SESSION['uname'] = $bindemail;
			
		}
		else
		{
			echo "fail";
		}
	}
	
}




$db->close();
?>
