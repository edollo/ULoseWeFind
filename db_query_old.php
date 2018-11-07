<?php 
// AJAX for dynamic request //OPT 


//error_reporting(0);
include("db_con.php");

if(isset($_POST['login_btn'])) {

$bindun = $_POST["uname"];
$bindpw = md5($_POST["psw"]); 
$query = "SELECT uname FROM users";

if ($result = $db->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        if ($bindun == $row["uname"]) {

			$query = "SELECT pswd FROM users";	

				if ($result = $db->query($query)) {
					
					while ($row = $result->fetch_assoc()) {
						if ($bindpw == $row["pswd"]) {	
						
							header ('Location:db_upload.php');
						}
						else {
							
							header ('Location:psw_failure.html');	
						}
					}
				}
		}
		else {
			header ('Location:un_failure.html');	
		}
    }

    /* free result set */
    $result->free();
}	
	$db->close();
}

if(isset($_POST['signup_btn'])) {

    header('Refresh: 0 ; url=sign_up.php');
}

?>
