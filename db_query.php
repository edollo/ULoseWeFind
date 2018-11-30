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
	$db->close();
		
}

//weiterleiten auf SignUp Seite
if(isset($_POST['signup_btn'])) {
    header('Refresh: 0 ; url=sign_up.html');
}

//Überprüfung Benutzername
if(isset($_POST['ValidateUname'])) {

	//Security /Variablenauslesen
	$bindun = mysqli_real_escape_string($db, $_POST['ValidateUname']);
	
	$query = "SELECT Email FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		//Rückgabewert 0 --> Benutzer nicht vorhanden
		if (mysqli_num_rows($result) == 0)
		{
			echo "invalid";
		}
		else
		{
			echo "isvalid";
		}
	}	
	
$db->close();

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


//überprüfung ob email schon vorhanden
if(isset($_POST['su_email'])) {


	//Security /Variablenauslesen
	$bindemail = mysqli_real_escape_string($db, $_POST['su_email']);
		
	//query bilden
	$query = "SELECT Email FROM Person WHERE Email ='".$bindemail."'";

	if ($result = $db->query($query)) {
		
		
		//Rückgabewert 0 --> Benutzer nicht vorhanden
		if (mysqli_num_rows($result) !== 0)
		{
			echo "exists";
		}
		else
		{
			echo "existsnot";
		}
	}

	$db->close();
}

//Registrierungs Prozedur
if(isset($_POST['su_signup_btn'])) {

	//Security /Variablenauslesen
	$bindemail = mysqli_real_escape_string($db, $_POST['su_email']);
	$bindfirstname = mysqli_real_escape_string($db, $_POST['su_vorname']);
	$bindlastname = mysqli_real_escape_string($db, $_POST['su_name']);
	$bindpw2 = mysqli_real_escape_string($db, $_POST['su_psw_2']);
	
	//query's bilen
	$query = "SELECT Email FROM Person WHERE Email ='".$bindemail."'";
	$queryinsert = "INSERT INTO `Person`(`Name`, `Nachname`, `Email`, `Anrede_idAnrede`, `Passwort`) VALUES ('".$bindfirstname."','".$bindlastname."','".$bindemail."',1,'".$bindpw2."'";

	
	
	//noch anzupassen
	if ($result = $db->query($query)) {

		echo "Registrierung Erfolgreich";
			
	}	

	$db->close();

}
?>
