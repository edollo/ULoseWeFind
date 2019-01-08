<?php
//###################################################
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//|Project:       ULWF                             |#
//|Filename:      object_page.php                  |#
//|Licence:       © Open Licence			       |#
//|Created by:    Anto Ivankovic / Samuel Maissen  |#
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//###################################################
session_start();

if(!isset($_SESSION['uname'])) {
	header('Location:login.php');
    die;
}

$uname = $_SESSION['uname'];

//Übergebene Markerid wird übergeben
$op_marker = $_GET['lp_marker'];


include("db_con.php");
include("lib_core.php");


if(get_marker_permission($db, $op_marker) == "denied") {
	header('Location:home.php');
    die; 
}



?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>ULoseWeFind</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script>
		function SaveMarkerSettings(op_name_f, op_description_f, op_reward_f, op_id_f) {
			if (document.getElementById("op_name").value == "" || document.getElementById("op_description").value == "" || document.getElementById("op_reward").value == "" || op_id_f == "") {
				
				if (document.getElementById("op_name").value == "")
				{
					document.getElementById("op_name").style.borderBottom = "solid 1px red";
				}
				else
				{
					document.getElementById("op_name").style.borderBottom = "solid 1px #c9c9c9";
				}

				
				if (document.getElementById("op_description").value == "")
				{
					document.getElementById("op_description").style.borderBottom = "solid 1px red";
				}
				else
				{

					document.getElementById("op_description").style.borderBottom = "solid 1px #c9c9c9";
				}

				if (document.getElementById("op_reward").value == "")
				{
					document.getElementById("op_reward").style.borderBottom = "solid 1px red";
				}
				else
				{
					document.getElementById("op_reward").style.borderBottom = "solid 1px #c9c9c9";
				}
				
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
						
						//felder auf grau setzten, falls vorher fehlerhaft war
						document.getElementById("op_name").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("op_description").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("op_reward").style.borderBottom = "solid 1px #c9c9c9";
						
						
						//regex für überprüfung
						var s = /success/;
						var f = /fail/;
						var d = /denied/;
						
						
						if(s.test(this.responseText))
						{
							document.getElementById("op_form").style.display = 'none';
							document.getElementById("op_success").style.display = 'block';
						}
						else if (f.test(this.responseText))
						{
							document.getElementById("op_form").style.display = 'none';
							document.getElementById("op_error").style.display = 'block';
						}
						else if (d.test(this.responseText))
						{
							document.getElementById("op_form").style.display = 'none';
							document.getElementById("op_denied").style.display = 'block';
						}
		
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("op_save_obj_settings_btn=" + true + "&op_name=" + op_name_f + "&op_description=" + op_description_f + "&op_reward=" + op_reward_f + "&op_id=" + op_id_f);
			}
		}
		
		function DeleteMarker(op_id_f) {
			if (op_id_f == "") {
				
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
						
						//regex für überprüfung
						var s = /success/;
						var f = /fail/;
						var d = /denied/;
						
						
						if(s.test(this.responseText))
						{
							document.getElementById("op_form").style.display = 'none';
							document.getElementById("op_success").style.display = 'block';
						}
						else if (f.test(this.responseText))
						{
							document.getElementById("op_form").style.display = 'none';
							document.getElementById("op_error").style.display = 'block';
						}
						else if (d.test(this.responseText))
						{
							document.getElementById("op_form").style.display = 'none';
							document.getElementById("op_denied").style.display = 'block';
						}
		
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("op_del_obj_btn=" + true + "&op_id=" + op_id_f);
			}
		}


		</script>
	</head>
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
							You can modify the objectdata using the Form down below. </p>
							<section>
								<div class="container" id="op_form">
									<p><b>Marker ID</b></p><input type="text" name="op_id" id="op_id" value="<?php echo $op_marker; ?>" disabled> <br />
									<p><b>Object title</b></p><input type="text" placeholder="Object title" name="op_name" id="op_name" value="<?php get_object_information($db, "Name", $op_marker); ?>" required> <br />
									<p><b>Object description</b></p><input type="text" placeholder="Object description"  name="op_description" id="op_description" value="<?php get_object_information($db, "Beschreibung", $op_marker); ?>" required> <br />
									<p><b>Reward for the finder</b></p><input type="text" placeholder="Reward for the finder"  name="op_reward" id="op_reward" value="<?php get_object_information($db, "Finderlohn", $op_marker); ?>" required> <br />
									<input type="submit" name="op_save_obj_settings_btn" value="Save" onclick="SaveMarkerSettings(op_name.value, op_description.value, op_reward.value, op_id.value)" >
									<input type="submit" name="op_del_obj_btn" value="Delete" onclick="DeleteMarker(op_id.value)">
									<input type="submit" name="op_del_return_btn" value="Return" onclick="location.href='loser_page.php';")">
								</div>
								<div class="container" id="op_success" style="display: none;">
									<h3>Change successful. <a href="loser_page.php">My Objects</a> </h3>
								</div>
								<div class="container" id="op_error" style="display: none;">
									<h3 style="color: red; font-weight: bold;">Error during Change. Please try again. <a href="loser_page.php">My Objects</a> </h3>
								</div>
								<div class="container" id="op_denied" style="display: none;">
									<h3 style="color: red; font-weight: bold;">Access Denied. <a href="loser_page.php">My Objects</a> </h3>
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
								<li>&copy; Untitled. All rights reserved</li><li>Design: ULoseWeFind</li>
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
