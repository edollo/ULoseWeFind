<?php
//###################################################
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//|Project:       ULWF                             |#
//|Filename:      lib_core.php                     |#
//|Licence:       © Open Licence			       |#
//|Created by:    Anto Ivankovic / Samuel Maissen  |#
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//###################################################

session_start();

$uname = $_SESSION['uname'];

include("db_con.php");




//Erstellen der Funktion Show Objects zum auslesen und anzeigen von Objekten
function show_objects($username, $db) {

	//security
	$username = mysqli_real_escape_string($db, $username);


	// Datenbankabfrage zur genauen Identifizierung des Benutzers
	$query = "SELECT idPerson FROM Person WHERE Email = '".$username."' LIMIT 1";
	$result = mysqli_query($db, $query);
	// While Schleife zur verarbeitung der ausgelesenen Daten
	while($row = mysqli_fetch_array($result))
	{
		// ID des momentan eingeloggten Benutzers
		$p_id = $row[0];

			// Datenbankabfrage zur Ausgabe der richtigen Objekten
			$query_so = "SELECT idMarker, Name, Beschreibung, FotoPfad FROM Gegenstand WHERE Person_idPerson = '".$p_id."' ORDER BY Name ASC";
			$result_so = mysqli_query($db, $query_so);

				// While Schleife zur Verarbeitung der ausgelesenen Dateien
				while($row = mysqli_fetch_array($result_so))
				{

					// Speicherung der Werte in Variablen
					$obj_marker = $row[0];
					$obj_name = $row[1];
					$obj_descript = $row[2];
					$obj_img_path = $row[3];
				

					echo "
						<section class=\"tiles\">
							<article class=\"style1\">
								<span class=\"image\">
									<img src=\"$obj_img_path\" alt=\"\" />
								</span>
								<a href=\"object_page.php?lp_marker=$obj_marker\">
									<h2>$obj_name</h2>
									<div class=\"content\">
										<p>$obj_descript</p>
									</div>
								</a>
							</article>
						</section>";

				}
	}

}


function get_user_information($db, $parm)
{
	//uname wird aus security gründen hier ausgelesen
	$bindun = $_SESSION['uname'];

	$query = "SELECT Email, Email_optional, Name, Nachname FROM Person WHERE Email ='".$bindun."'";
	$result = mysqli_query($db, $query);

	// While Schleife zur verarbeitung der ausgelesenen Daten
	while($row = mysqli_fetch_array($result))
	{
		if($parm == "Email")
		{
			echo $row["Email"];

		}
		else if($parm == "Email_optional")
		{
			echo $row["Email_optional"];

		}
		else if($parm == "Finderlohn")
		{
			echo $row["Finderlohn"];

		}
		else if($parm == "Name")
		{
			echo $row["Name"];

		}
		else if($parm == "Nachname")
		{
			echo $row["Nachname"];

		}
	}
}


function get_object_information($db, $parm, $op_marker)
{
	//uname wird aus security gründen hier ausgelesen
	$bindun = $_SESSION['uname'];
	
	$bindmarker = $op_marker;

	$query = "SELECT Name, Beschreibung, Finderlohn FROM Gegenstand WHERE idMarker ='".$bindmarker."'";
	$result = mysqli_query($db, $query);

	// While Schleife zur verarbeitung der ausgelesenen Daten
	while($row = mysqli_fetch_array($result))
	{
		if($parm == "Name")
		{
			echo $row["Name"];

		}
		else if($parm == "Beschreibung")
		{
			echo $row["Beschreibung"];

		}
		else if($parm == "Finderlohn")
		{
			echo $row["Finderlohn"];

		}
	}
}


function get_marker_permission($db, $op_marker){
///id auslesen
$bind_obj_id = mysqli_real_escape_string($db, $op_marker);

//authorisierung ob befugt änderungen an marker zu machen
$query = "SELECT Name FROM Gegenstand WHERE idMarker = '".$bind_obj_id."' and Person_idPerson = (SELECT idPerson FROM Person WHERE Email ='".$_SESSION['uname']."') LIMIT 1";

if ($result = $db->query($query)) {
		//überprüfung querry erfolgreich
		if (mysqli_num_rows($result) == 0)
		{
			//wenn keine Rückgabe ist user nicht befugt da nicht sein Gegenstand
			return "denied";
		}
		else
		{
			return "success";
		}

	}
}


?>
