<?php
####################################################
#+------------------------------------------------+#
#|Project:       ULWF                             |#
#|Filename:      lib.core.php                     |#
#|Licence:       © Open Licence			          |#
#|Created by:    Anto Ivankovic / Samuel Maissen  |#
#+------------------------------------------------+#
####################################################
session_start();

$uname = $_SESSION['uname'];

include("db_con.php");

$mark_uinp = mysqli_real_escape_string($db, $_POST['mark_inp']);


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
			$query_so = "SELECT Name, Beschreibung, FotoPfad FROM Gegenstand WHERE Person_idPerson = '".$p_id."' ORDER BY Name ASC";
			$result_so = mysqli_query($db, $query_so);
			
				// While Schleife zur Verarbeitung der ausgelesenen Dateien
				while($row = mysqli_fetch_array($result_so))
				{
					
					// Speicherung der Werte in Variablen
					$obj_name = $row[0];
					$obj_descript = $row[1];
					$obj_img_path = $row[2];
					
					echo "
						<section class=\"tiles\">
							<article class=\"style1\">
								<span class=\"image\">
									<img src=\"$obj_img_path\" alt=\"\" />
								</span>
								<a href=\"#\">
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


// Erstellen der Funktion Add Objects zum Hinzufügen von Objekten
function add_objects($username, $db) {
    $currentDir = getcwd();
    $uploadDirectory = "/img/";
	
	//security
	$username = mysqli_real_escape_string($db, $username);
	

	// Erstellen von Array zur Speicherung von Fehlermeldung
    $errors = []; 

	// Alle zugelassenen File Extensions in Array hinterlegen
    $fileExtensions = ['jpeg','jpg','png']; 

	// Variablen werden deklariert
    $fileName = $_FILES['obj_img']['name'];
    $fileSize = $_FILES['obj_img']['size'];
    $fileTmpName  = $_FILES['obj_img']['tmp_name'];
    $fileType = $_FILES['obj_img']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

	// Der Absolute Pfad wird in die Variable uploadPath geschrieben
    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
	// Der verkürzte Pfad, bestehend aus Bildname und dem Ordner /img wird in die uploadImg Variable geschrieben
	$uploadImg = "img/". basename($fileName);
	
		// Überprüfung ob Dateiendung zugelassen ist
        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "Diese Datei ist nicht erlaubt. Bitte wählen sie eine .JPG oder eine .PNG Datei";
        }

		// Überprüfung ob Dateigrösse zugelassen ist
        if ($fileSize > 2000000) {
            $errors[] = "Die Datei ist zu gross.";
        }
	
		// Falls sich nichts im Array Erros befindet, wird das Bild hochgeladen. Ansonsten wird der genaue Fehler ausgegeben
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                
					$obj_name = htmlentities($_POST['obj_name']);
					$obj_descript = htmlentities($_POST['obj_desc']);
					$obj_img_path = htmlentities ($uploadImg);
					
						// Datenbankabfrage zur genauen Identifizierung des Benutzers
						$query = "SELECT idPerson FROM Person WHERE Email = '".$username."' LIMIT 1";
						$result = mysqli_query($db, $query);
						
						// While Schleife zur verarbeitung der ausgelesenen Daten
						while($row = mysqli_fetch_array($result))
						{
							// ID des momentan eingeloggten Benutzers
							$p_id = $row[0];
						
							// Upload Query
							$query = "INSERT INTO Gegenstand (Name, Beschreibung, Person_idPerson, FotoPfad) VALUES ('$obj_name','$obj_descript','$p_id','$obj_img_path')";

							  if ( !(mysqli_query($db, $query)) ) {
								  die('<p>Fehler bei der Datenübergabe in die Datenbank</p></body></html>');
							   } 
							   else {
								   // Weiterleitung auf die Seite "loser_page.php", falls Upload erfolgreich
								  header('Refresh: 0 ; url=loser_page.php');
							   }
						}	   
							   
				} else {
					echo "Ein Fehler liegt vor, bitte kontaktieren Sie den Systemadministrator";
				}
			} else {
				foreach ($errors as $error) {
					echo $error . "vorherstehende Fehler sind aufgetretten" . "\n";
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


if(isset($_POST['mark_btn'])) {
	
	function compare_marker ($db, $mark_uinp)
	{

		$query = "SELECT idMarker FROM Gegenstand WHERE idMarker ='".$mark_uinp."'";
		$result = mysqli_query($db, $query);
		
			if ((mysqli_num_rows($result) !== 0)){

				$query_p = "SELECT Person_idPerson FROM Gegenstand WHERE idMarker = '".$mark_uinp."' LIMIT 1";
				$result_p = mysqli_query($db, $query_p);


					while($row = mysqli_fetch_array($result_p)){
						
						$person_id = $row[0];

						$query_pers = "SELECT Name, Nachname, Email FROM Person WHERE idPerson = '".$person_id."' LIMIT 1";
						$result_pers = mysqli_query($db, $query_pers);

							while($row = mysqli_fetch_array($result_pers)){

								$lo_name = $row[0];
								$lo_nname = $row[1];
								$lo_email = $row[2];
								
								$check = 1;
								return $check;
							}
					}
			}
			else {
				$check = 2;
				return $check;
			}

	header('Refresh: 0 ; url=finder_page.php');		
		
	}
	
	add_objects($mark_uinp, $db);
}



// Abfragen zur Sicherstellung das die richtige Funktion ausgeführt wird
if(isset($_POST['conf_add_button'])) {
	 add_objects($uname, $db);
}










?>