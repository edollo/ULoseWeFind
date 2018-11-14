<?php 
// AJAX for dynamic request //OPT 

//error_reporting(0);
include("db_con.php");

if(isset($_POST['psw'])) {

$bindpw = $_POST['psw'];
$bindun = $_POST['uname'];

$query = "SELECT Email, Passwort FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
		if (mysqli_num_rows($result) !== 0)
		{	
			/* fetch associative array */
			while ($row = $result->fetch_assoc()) {
				if ($bindun == $row["Email"] and $bindpw == $row["Passwort"])  {

					//header('Location:declare_new_object.html');
		
					echo "valid";
				}
				else {
					echo "invalidpw";
				}
			}
			
			/* free result set */
			$result->free();
		}	
		else{
			
			echo "invaliduname";	
			
		}	
	}	
	

$db->close();
		
}


if(isset($_POST['signup_btn'])) {

    header('Refresh: 0 ; url=sign_up.html');
}


if(isset($_POST['ValidateUname'])) {

	$bindun = $_POST['ValidateUname'];
	$query = "SELECT Email FROM Person WHERE Email ='".$bindun."'";

	if ($result = $db->query($query)) {
		
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



if(isset($_POST['su_email'])) {
	
	$bindemail = $_POST['su_email'];
	$query = "SELECT Email FROM Person WHERE Email ='".$bindemail."'";

	if ($result = $db->query($query)) {
		
		if (mysqli_num_rows($result) !== 0)
		{
			echo "exists";
		}
		else
		{
			echo "existsnot";
		}
	}	
}


if(isset($_POST['su_signup_btn'])) {

	//$query = "SELECT Email FROM Person WHERE Email ='".$bindemail."'";

	//muss noch implementiert werden

	echo "success";
 
}


?>
