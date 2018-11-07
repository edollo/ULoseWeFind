<?php 
// AJAX for dynamic request //OPT 



//error_reporting(0);
include("db_con.php");

if(isset($_POST['login_btn'])) {

$bindun = $_POST["uname"];
//$bindpw = md5($_POST["psw"]); 
$bindpw = $_POST["psw"];

$query = "SELECT Email, Passwort FROM Person WHERE Email ='".$bindun."'";


	if ($result = $db->query($query)) {

		/* fetch associative array */
		while ($row = $result->fetch_assoc()) {
			if ($bindun == $row["Email"] and $bindpw == $row["Passwort"])  {

				header ('Location:declare_new_object.html');				
			}
			else {
				echo "benutzerinfos falsch";
			}
		}

		/* free result set */
		$result->free();
	}	
	else{
		echo "benutzer nicht vorhanden";
	}

$db->close();
	
}


if(isset($_POST['signup_btn'])) {

    header('Refresh: 0 ; url=sign_up.php');
}


if(isset($_GET['ValidateUname'])) {

	echo "wrong lol lel";

}

?>
