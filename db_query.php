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

    header('Refresh: 0 ; url=sign_up.php');
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

?>
