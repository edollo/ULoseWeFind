<?php
//###################################################
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//|Project:       ULWF                             |#
//|Filename:      finder_page.php                  |#
//|Licence:       © Open Licence			       |#
//|Created by:    Anto Ivankovic / Samuel Maissen  |#
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//###################################################


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
		function MarkerValidator(fp_mark_f) {

				if (document.getElementById("fp_mark").value == "") {

					document.getElementById("fp_mark").style.borderBottom = "solid 1px red";
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

							var markerinfos = JSON.parse(this.responseText);

							if(markerinfos[0] == "success")
							{

								//marker form mit infos einblenden
								var markersuccess = document.getElementById("marker_success");
								markersuccess.style.display = "block";

								//form ausblenden
								var markerform = document.getElementById("marker_form");
								markerform.style.display = "none";


								//werte abfüllen
								var fp_mail = document.getElementById("fp_mail");
								var fp_mailopt = document.getElementById("fp_mailopt");
								var fp_flohn = document.getElementById("fp_flohn");

								fp_mail.value = markerinfos[1];
								fp_mailopt.value = markerinfos[2];
								fp_flohn.value = markerinfos[4];
							}
							else
							{
								//error form einblenden
								var markersuccess = document.getElementById("marker_error");
								markersuccess.style.display = "block";

								//form ausblenden
								var markerform = document.getElementById("marker_form");
								markerform.style.display = "none";

							}
						}
					};

					xmlhttp.open("POST","db_query.php",true);
					xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xmlhttp.send("fp_mark=" + fp_mark_f);
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
								<a href="index.html" class="logo">
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
							<li><a href="index.html">Home</a></li>
							<li><a href="finder_page.php">Found something?</a></li>
							<li><a href="login.php">Sign in / Sign up</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>U Lose We Find</h1>
								<p>A Webservice to help finding your lost valuables.</p>
							</header>
							<div id="marker_form">
								<p> Welcome Stranger :) <br />
									Found a goodie with a mark on? <br />
									Insert the value on the mark into the field below.</p>

								<section>
										<div class="container">
											<input type="text" placeholder="Mark's value" name="fp_mark" id="fp_mark" required > <br />
											<input type="submit" name="mark_btn" value="Next" onclick="MarkerValidator(fp_mark.value)">
										</div>
								</section>
							</div>

							<div id="marker_success" style="display: none;">
								<p> The marker you entered is active.<br />
									Take a Look at the owners Personal data and decide if you want to get in touch.</p>
									<p><b>E-Mail:</b></p><input type="text" id="fp_mail" disabled > <br />
									<p><b>Alt. E-Mail:</b></p><input type="text" id="fp_mailopt" disabled > <br />
									<p><b>Reward for the finder in $:</b></p><input type="text" id="fp_flohn" disabled > <br />
									<h3>Try other Marker?  <a href="finder_page.php">Finder Page</a> </h3>
							</div>

							<div id="marker_error" style="display: none;">
								<p> We are sorry.<br />
									The Marker you entered is not active.<br />
									Enter again carefully.</p>
								<h3>Try other Marker? <a href="finder_page.php">Finder Page</a> </h3>
							</div>

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
