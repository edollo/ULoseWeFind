<?php
//###################################################
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//|Project:       ULWF                             |#
//|Filename:      add_obj.php                      |#
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

include("db_con.php");
include("lib_core.php");


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
			function AddObject(obj_name_f, obj_desc_f, obj_flohn_f, obj_img_f) {
			if (document.getElementById("obj_name").value == "" || document.getElementById("obj_desc").value == "" || document.getElementById("obj_flohn").value == "" || document.getElementById("obj_img").value == "") {
				
				if (document.getElementById("obj_name").value == "")
				{
					document.getElementById("obj_name").style.borderBottom = "solid 1px red";
				}
				else
				{
					document.getElementById("obj_name").style.borderBottom = "solid 1px #c9c9c9";
				}

				
				if (document.getElementById("obj_desc").value == "")
				{
					document.getElementById("obj_desc").style.borderBottom = "solid 1px red";
				}
				else
				{

					document.getElementById("obj_desc").style.borderBottom = "solid 1px #c9c9c9";
				}

				if (document.getElementById("obj_flohn").value == "")
				{
					document.getElementById("obj_flohn").style.borderBottom = "solid 1px red";
				}
				else
				{
					document.getElementById("obj_flohn").style.borderBottom = "solid 1px #c9c9c9";
				}
				

				if (document.getElementById("obj_img").value == "")
				{
					document.getElementById("btn_obj_img").style.border= "solid 1px red";
				}
				else
				{
					document.getElementById("btn_obj_img").style.border= "solid 1px #c9c9c9";
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
						document.getElementById("btn_obj_img").style.border = "solid 1px #c9c9c9";
						document.getElementById("obj_flohn").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("obj_desc").style.borderBottom = "solid 1px #c9c9c9";
						document.getElementById("obj_name").style.borderBottom = "solid 1px #c9c9c9";


						
						
						//regex für überprüfung
						var s = /success/;
						var f = /Failed/;
						
						
						
						if(s.test(this.responseText))
						{
							document.getElementById("obj_form").style.display = 'none';
							document.getElementById("obj_success").style.display = 'block';
						}
						else if (f.test(this.responseText))
						{
							document.getElementById("obj_form").style.display = 'none';
							document.getElementById("obj_error").style.display = 'block';
							document.getElementById("obj_p_error").innerHTML = this.responseText;
							
						}

					}
				};
				
				//form generieren, da sonst nicht geht zusammen mit File
				var fdata = new FormData();
				fdata.append("conf_add_button", true);
				fdata.append("obj_name", obj_name_f);
				fdata.append("obj_desc", obj_desc_f);
				fdata.append("obj_flohn", obj_flohn_f);

				//bildauslesen
				var file = obj_img_f.files[0];
                fdata.append('obj_img',file);

				//abschicken
				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.send(fdata);
				
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
							<div class="container" id="obj_form">
								<div class="container">
									<input type="text" placeholder="Object title" name="obj_name" id="obj_name" required> <br />
									<input type="text" placeholder="Object description" name="obj_desc" id="obj_desc" required> <br />
									<input type="text" placeholder="Reward for the finder" name="obj_flohn" id="obj_flohn" required> <br />
									<div class="upload-btn-wrapper">
										<button id="btn_obj_img">Choose img</button>
										<input type="file" accept="image/*" name="obj_img" id="obj_img">
									</div>
									<br /> <br /> <br />
									<input type="submit" value="Create Object" name="conf_add_button" id="conf_add_button" onclick="AddObject(obj_name.value, obj_desc.value, obj_flohn.value, obj_img)">
								</div>
							</div>
							<div class="container" id="obj_success" style="display: none;">
									<h3>New Object Created successful. <a href="loser_page.php">My Objects</a> </h3>
								</div>
								<div class="container" id="obj_error" style="display: none;">
									<p style="color: red;" id="obj_p_error"></p>
									<h3 style="color: red; font-weight: bold;">Error during creating. Please try again. <a href="object_page.php">Create Object</a> </h3>
								</div>
						</div>
					</div>

				<!-- Footer-->
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
