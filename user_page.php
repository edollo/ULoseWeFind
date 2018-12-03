<?php 
####################################################
#+------------------------------------------------+#
#|Project:       ULWF                             |#
#|Filename:      index.html                       |#
#|Licence:       © Open Licence			          |#
#|Created by:    Anto Ivankovic / Samuel Maissen  |#
#+------------------------------------------------+#
####################################################
session_start();

if(!isset($_SESSION['uname'])) {
	header('Location:login.html');
    die; 
}

$uname = $_SESSION['uname'];
include("db_con.php");
include("db_query.php");

#Auslesen der Benutzerdaten
get_user_information($db);
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
								<div class="container">
									<input type="text" value="<?php echo $bindfirstname; ?>"  name="up_vorname" id="up_vorname" required> <br />
									<input type="text" value="<?php echo $bindlastname; ?>" name="up_name" id="up_name" required> <br />
									<input type="text" value="<?php echo $bindun; ?>" name="up_email" id="up_email" onchange="EmailValidator(this.value)" required> <br />
									<p id="up_validemail" name="up_validemail"></p>
									<input type="password" placeholder="Altes Passwort" name="up_psw_old" id="su_psw_old"  onchange="" required> <br />
									<input type="password" placeholder="Neues Passwort" name="up_psw_1" id="up_psw_1" onchange="PwValidator(this.value, up_psw_2.value)" required> <br />
									<input type="password" placeholder="Neues Passwort bestätigen" name="up_psw_2" id="up_psw_2" onchange="PwValidator(up_psw_1.value, this.value)" required> <br />
									<p id="su_validpw" name="su_validpw"></p>
									<input type="submit" name="up_save_settings_btn" value="Speichern" onclick="" >
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