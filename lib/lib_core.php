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
$show_objects = function($username) use ($db)
{
	// Datenbankabfrage zur genauen Identifizierung des Benutzers
	$query = "SELECT idPerson FROM person WHERE Email = '".$username."' LIMIT 1";
	$result = mysqli_query($db, $query);
	
	// While Schleife zur verarbeitung der ausgelesenen Daten
	while($row = mysqli_fetch_array($result))
	{
		// ID des momentan eingeloggten Benutzers
		$p_id = $row[0];

			// Datenbankabfrage zur Ausgabe der richtigen Objekten
			$query_so = "SELECT Name, Beschreibung, FotoPfad FROM gegenstand WHERE Person_idPerson = '".$p_id."' ORDER BY Name ASC";
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
};








?>