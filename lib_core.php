<?php
####################################################
#+------------------------------------------------+#
#|Project:       ULWF                             |#
#|Filename:      lib.core.php                     |#
#|Licence:       © Open Licence			          |#
#|Created by:    Anto Ivankovic / Samuel Maissen  |#
#+------------------------------------------------+#
####################################################

include("db_con.php");


//Erstellen der Funktion Show Objects zum auslesen und anzeigen von Objekten
function show_objects($username, $db) {
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

	// Speichern von Fehlern in diesem Array
    $errors = []; 

	// Alle zugelassenen File Extensions in Array hinterlegen
    $fileExtensions = ['jpeg','jpg','png']; 

    $fileName = $_FILES['obj_img']['name'];
    $fileSize = $_FILES['obj_img']['size'];
    $fileTmpName  = $_FILES['obj_img']['tmp_name'];
    $fileType = $_FILES['obj_img']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "Diese Datei ist nicht erlaubt. Bitte wählen sie eine .JPG oder eine .PNG Datei";
        }

        if ($fileSize > 2000000) {
            $errors[] = "Die Datei ist zu gross.";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                
					$obj_name = htmlentities($_POST['obj_name']);
					$obj_descript = htmlentities($_POST['obj_desc']);
					$obj_img_path = htmlentities ($uploadPath);
					
					$query = "INSERT INTO Gegenstand (Name, Beschreibung, FotoPfad) VALUES ('$obj_name','$obj_descript','$obj_img_path')";

					  if ( !(mysqli_query($db, $query)) ) {
						  die('<p>Fehler bei der Datenübergabe in die Datenbank</p></body></html>');
					   } 
					   else {
						  header('Refresh: 2 ; url=add_obj.php');
						  echo "The file " . basename($fileName) . " wurde erfolgreich hochgeladen";
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
	
// Abfrage zur Sicherstellung das die richtige Funktion ausgeführt wird
if(isset($_POST['conf_add_button'])) {
	 $add_objects($uname);
}



	







?>