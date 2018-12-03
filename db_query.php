<?php 
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

$query = "SELECT Email, Passwort FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		//überprüfung benutzer vorhanden
		if (mysqli_num_rows($result) !== 0)
		{	
			while ($row = $result->fetch_assoc()) {

				//überprüfen ob Benutzerdaten korrekt sind
				if ($bindun == $row["Email"] and $bindpw == $row["Passwort"])  {
	
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

	//Security /Variablenauslesen
	$bindun = mysqli_real_escape_string($db, $_POST['ValidateUname']);
	
	$query = "SELECT Email FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		//Rückgabewert 0 --> Benutzer nicht vorhanden
		if (mysqli_num_rows($result) == 0)
		{
			echo "existsnot";
		}
		else
		{
			
			//funktioniert nichr
			//eigener Name ist ok
			if($row["Email"] == "edollo" )
			{
				
				
			}
			else
			{
				
				echo "exists";
				
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
	}
	else
	{
		echo "doesnotmatch";	
	}
}


//Registrierungs Prozedur
if(isset($_POST['su_signup_btn'])) {

	//Security /Variablenauslesen
	$bindemail = mysqli_real_escape_string($db, $_POST['su_email']);
	$bindfirstname = mysqli_real_escape_string($db, $_POST['su_vorname']);
	$bindlastname = mysqli_real_escape_string($db, $_POST['su_name']);
	$bindpw2 = mysqli_real_escape_string($db, $_POST['su_psw_2']);
	
	//query's bilen
	//$query = "SELECT Email FROM Person WHERE Email ='".$bindemail."'";
	$queryinsert = "INSERT INTO `Person`(`Name`, `Nachname`, `Email`, `Anrede_idAnrede`, `Passwort`) VALUES ('".$bindfirstname."','".$bindlastname."','".$bindemail."',1,'".$bindpw2."')";
	
	echo $queryinsert;
	
	if ($result = $db->query($queryinsert)) {
	
		echo $query;
	
		if($db->affected_rows > 0)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		
		}
	
	}	
}


$db->close();
?>
