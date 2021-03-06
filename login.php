<?php 
//###################################################
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//|Project:       ULWF                             |#
//|Filename:      login.php                        |#
//|Licence:       © Open Licence			       |#
//|Created by:    Anto Ivankovic / Samuel Maissen  |#
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//###################################################

session_start();

if(isset($_SESSION['uname'])) {
	header('Location:loser_page.php');
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
		function UserValidator(uname) {
			
			if (uname == "") {
				
				document.getElementById("Valid").innerHTML = "";
				document.getElementById("uname").style.borderBottom = "solid 1px #c9c9c9";
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
							document.getElementById("Valid").innerHTML = "";
							document.getElementById("uname").style.borderBottom = "solid 1px #c9c9c9";
						}
						else 
						{
							document.getElementById("Valid").innerHTML = "Benutzer nicht vorhanden";
							document.getElementById("uname").style.borderBottom = "solid 1px red";
							
						}
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("ValidateUname=" + true + "&su_email=" + uname);
			}
		}
		
		 
		
		function CheckCred(login_btn_f, uname_f, pw_f) {

			if (document.getElementById("psw").value == "" || document.getElementById("uname").value == "") {
			
				document.getElementById("uname").style.borderBottom = "solid 1px red";
				document.getElementById("psw").style.borderBottom = "solid 1px red";
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
					
						if(this.responseText == "invalidpw")
						{
							document.getElementById("psw").style.borderBottom = "solid 1px red";
							document.getElementById("validpw").innerHTML = "Passwort falsch";
						}
						else if (this.responseText == "valid")
						{
							window.location = 'loser_page.php';
						}
						else
						{
							document.write(this.responseText);
						}
					}
				};
				
				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("login_btn=" + login_btn_f + "&psw=" + pw_f + "&uname=" + uname_f);
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
							<section>
								<!--<form method="POST"> action="CheckCred(uname.value, psw.value)">-->
									<div class="container">
									<input type="text" placeholder="Enter Email" name="uname" id="uname" onchange="UserValidator(this.value)" required > <br />
									<p id="Valid" ></p>
									<input type="password" placeholder="Enter Password" name="psw" id="psw" required> <br /><br />
									<p id="validpw"></p>
									<input type="submit" name="login_btn" value="Login" onclick="CheckCred(this.value, uname.value, psw.value)" >
									</div>
								<!--</form>-->
								<form method="POST" action="db_query.php">
									<div class="container">
										<br />
										<p>Don't have an Account Yet? Sign up for Free</p>
										<input type="submit" name="signup_btn" value="Sign up">
									</div>
								</form>
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