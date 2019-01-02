<?php 
####################################################
#+------------------------------------------------+#
#|Project:       ULWF                             |#
#|Filename:      user_page.html                   |#
#|Licence:       © Open Licence			          |#
#|Created by:    Anto Ivankovic / Samuel Maissen  |#
#+------------------------------------------------+#
####################################################
session_start();

if(!isset($_SESSION['uname'])) {
	header('Location:login.php');
    die; 
}

$uname = $_SESSION['uname'];
include("db_con.php");
include("lib_core.php");


?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Phantom by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<script>
	function PwValidator(up_psw_1_f, up_psw_2_f) {

			if (document.getElementById("up_psw_1").value == "" && document.getElementById("up_psw_2").value == "") {
			
				document.getElementById("up_validpw").innerHTML = "";
				document.getElementById("up_psw_1").style.borderBottom = "solid 1px #c9c9c9";
				document.getElementById("up_psw_2").style.borderBottom = "solid 1px #c9c9c9";
				return;
				
			} 
		
			else if (document.getElementById("up_psw_2").value == "") {
			
				document.getElementById("up_validpw").innerHTML = "";
				document.getElementById("up_psw_2").style.borderBottom = "solid 1px #c9c9c9";
				return;
				
			} 
			else if (document.getElementById("up_psw_1").value == "" && document.getElementById("up_psw_2").value !== "")
			{
				document.getElementById("up_psw_1").style.borderBottom = "solid 1px red";
				return;
			}
			
			else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					
						if(this.responseText == "doesnotmatch")
						{
							document.getElementById("up_psw_1").style.borderBottom = "solid 1px #c9c9c9";
							document.getElementById("up_psw_2").style.borderBottom = "solid 1px red";
							document.getElementById("up_validpw").innerHTML = "Passwort nicht identisch";
						}
						else
						{
							document.getElementById("up_validpw").innerHTML = "";
							document.getElementById("up_psw_1").style.borderBottom = "solid 1px #c9c9c9";
							document.getElementById("up_psw_2").style.borderBottom = "solid 1px #c9c9c9";
						}
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("su_psw_1=" + up_psw_1_f + "&su_psw_2=" + up_psw_2_f);
			}
		}
		
		
		function OldPwValidator(up_psw_old_f) {

			if (document.getElementById("up_psw_old").value == "") {
			
				document.getElementById("up_oldvalidpw").innerHTML = "";
				document.getElementById("up_psw_old").style.borderBottom = "solid 1px red";
				return;
				
			} 
	
			
			else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					
						if(this.responseText == "valid")
						{
							document.getElementById("up_oldvalidpw").innerHTML = "";
							document.getElementById("up_psw_old").style.borderBottom = "solid 1px #c9c9c9";
						
						}
						else
						{
							document.getElementById("up_psw_old").style.borderBottom = "solid 1px red";
							document.getElementById("up_oldvalidpw").innerHTML = "Passwort falsch";
						}
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("up_psw_old=" + up_psw_old_f);
			}
		}
		
		
		
		function EmailValidator(up_email_f) {
		
			if (document.getElementById("up_email").value == "") {
			
				document.getElementById("up_validemail").innerHTML = "";
				document.getElementById("up_email").style.borderBottom = "solid 1px #c9c9c9";
				return;
				
			} else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					
						if(this.responseText == "exists")
						{
							document.getElementById("up_email").style.borderBottom = "solid 1px red";
							document.getElementById("up_validemail").innerHTML = "Account unter Email-Aresse schon vorhanden";
						}
						else if(this.responseText == "emailincorrect")
						{
							document.getElementById("up_email").style.borderBottom = "solid 1px red";
							document.getElementById("up_validemail").innerHTML = "Email-Aresse ungültig";
						
						}
						else
						{
							document.getElementById("up_validemail").innerHTML = "";
							document.getElementById("up_email").style.borderBottom = "solid 1px #c9c9c9";
						}
						
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("ValidateUname=" + true + "&su_email=" + up_email_f);
			}
		}
		
		
		function SaveSettings(up_vorname_f, up_name_f, up_email_f, up_psw_old_f, up_psw_1_f, up_psw_2_f, up_change_pw_btn_f) {
			//überprüfen ob Namens felder oder email Leer sind
			if (document.getElementById("up_vorname").value == "" || document.getElementById("up_name").value == "" || document.getElementById("up_email").value == ""){
				 
				if (document.getElementById("up_vorname").value == "")
				{
					document.getElementById("up_vorname").style.borderBottom = "solid 1px red";
				}
				else
				{
					document.getElementById("up_vorname").style.borderBottom = "solid 1px #c9c9c9";
				}
				
				if (document.getElementById("up_name").value == "")
				{
					document.getElementById("up_name").style.borderBottom = "solid 1px red";
				}
				else
				{
				
					document.getElementById("up_name").style.borderBottom = "solid 1px #c9c9c9";
				}
				
				if (document.getElementById("up_email").value == "")
				{
					document.getElementById("up_validemail").innerHTML = "";
					document.getElementById("up_email").style.borderBottom = "solid 1px red";
				}
				else
				{
					document.getElementById("up_email").style.borderBottom = "solid 1px #c9c9c9";		
				}
				
				return;
				
			} else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						
						//regex für überprüfung
						var dnm = /doesnotmatch/;
						var ivp = /invalidpw/;
						var s = /success/;
						var f = /fail/;
						

						
						//felder auf grau setzten, falls vorher fehlerhaft war
						document.getElementById("up_vorname").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("up_name").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("up_email").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("up_psw_old").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("up_oldvalidpw").innerHTML = "";						
					
						if(this.responseText == "exists")
						{
							document.getElementById("up_email").style.borderBottom = "solid 1px red";
							document.getElementById("up_validemail").innerHTML = "Account unter Email-Aresse schon vorhanden";
						}
						else if(this.responseText == "emailincorrect")
						{
							document.getElementById("up_email").style.borderBottom = "solid 1px red";
							document.getElementById("up_validemail").innerHTML = "Email-Aresse ungültig";
						
						}
						
						if(dnm.test(this.responseText))
						{
							document.getElementById("up_psw_1").style.borderBottom = "solid 1px #c9c9c9";
							document.getElementById("up_psw_2").style.borderBottom = "solid 1px red";
							document.getElementById("up_validpw").innerHTML = "Passwort nicht identisch";
						
						}
						if(ivp.test(this.responseText))
						{
							document.getElementById("up_psw_old").style.borderBottom = "solid 1px red";
							document.getElementById("up_oldvalidpw").innerHTML = "Passwort falsch";
						}
						
						if(s.test(this.responseText))
						{
							document.getElementById("up_form").style.display = 'none';
							document.getElementById("up_success").style.display = 'block';
						}
						else if (f.test(this.responseText))
						{
							document.getElementById("up_form").style.display = 'none';
							document.getElementById("up_error").style.display = 'block';
						}	
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("up_save_settings_btn=" + true + "&ValidateUname=" + true + "&up_change_pw_btn=" + up_change_pw_btn_f + "&up_vorname=" + up_vorname_f + "&up_name=" + up_name_f + "&su_email=" + up_email_f + "&up_psw_old=" + up_psw_old_f + "&su_psw_1=" + up_psw_1_f + "&su_psw_2=" + up_psw_2_f);
			}
		}
		
		
		
		function ShowPassForm() {
		
			var pwform = document.getElementById("up_pw_form");
			var pwbutton = document.getElementById("up_change_pw_btn");
						 
			  if (pwform.style.display === "none") 
			  {
				pwform.style.display = "block";
				pwbutton.value  = "Passwort nicht Ändern"
				
			  } 
			  else 
			  {
				pwform.style.display = "none";
				pwbutton.value = "Passwort Ändern"
			  }
		}
		
		
		
	
	</script>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="home.php" class="logo">
									<span class="symbol"><img src="images/logo/logo_cut_icon.jpg" alt="" /></span><span class="title">U Lose - We Find</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="home.php">Home</a></li>
							<li><a href="loser_page.php">My Objects</a></li>
							<li><a href="user_page.php">User Page</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>U Lose We Find</h1>
								<p>A Webservice to help finding your lost valuables.</p>
							</header>
							<p>Welcome <?php echo $uname ?> <br />
							You can modify your userdata using the Form down below. </p>
							<section>
								<div class="container" id="up_form">
									<input type="text" placeholder="Vorname" value="<?php get_user_information($db, "Name"); ?>"  name="up_vorname" id="up_vorname" required> <br />
									<input type="text" placeholder="Name" value="<?php get_user_information($db, "Nachname"); ?>" name="up_name" id="up_name" required> <br />
									<input type="text" placeholder="E-Mail Adresse" value="<?php get_user_information($db, "Email"); ?>" name="up_email" id="up_email" onchange="EmailValidator(this.value)" required> <br />
									<p id="up_validemail" name="up_validemail"></p>
									<input type="submit" name="up_change_pw_btn" id="up_change_pw_btn" value="Passwort Ändern" onclick="ShowPassForm()" ><br><br>
									<div id="up_pw_form" style="display: none;">
										<input type="password" placeholder="Altes Passwort" name="up_psw_old" id="up_psw_old" onchange="OldPwValidator(up_psw_old.value)" required> <br />
										<p id="up_oldvalidpw" name="up_oldvalidpw"></p>
										<input type="password" placeholder="Neues Passwort" name="up_psw_1" id="up_psw_1" onchange="PwValidator(this.value, up_psw_2.value)" required> <br />
										<input type="password" placeholder="Neues Passwort bestätigen" name="up_psw_2" id="up_psw_2" onchange="PwValidator(up_psw_1.value, this.value)" required> <br />
										<p id="up_validpw" name="up_validpw"></p>
									</div>
									<input type="submit" name="up_save_settings_btn" value="Speichern" onclick="SaveSettings(up_vorname.value, up_name.value, up_email.value, up_psw_old.value,up_psw_1.value, up_psw_2.value, up_change_pw_btn.value)" >
								</div>
								<div class="container" id="up_success" style="display: none;">
									<h3>Änderung erfolgreich. <a href="home.php">Home</a> </h3>
								</div>
								<div class="container" id="up_error" style="display: none;">
									<h3 style="color: red; font-weight: bold;">Fehler bei der Änderung. Bitte versuchen sie es erneuert. <a href="user_page.php">User Page</a> </h3>
								</div>
							</section>	
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>Get in Touch</h2>
								<ul class="icons">
									<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon style2 fa-github"><span class="label">GitHub</span></a></li>
									<li><a href="#" class="icon style2 fa-envelope-o"><span class="label">Email</span></a></li>
								</ul>
							</section>
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved</li><li>Design: ULoseWeFind</a></li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>