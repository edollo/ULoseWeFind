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
								<div class="container" id="up_form">
									<input type="text" placeholder="Object title" name="op_name" id="op_name" value="<?php get_object_information($db, "Name", $ob_marker); ?>" required> <br />
									<input type="text" placeholder="Object description"  name="op_description" id="op_description" value="<?php get_object_information($db, "Beschreibung", $ob_marker); ?>" required> <br />
									<input type="text" placeholder="Reward for the finder"  name="op_reward" id="op_reward" value="<?php get_object_information($db, "Finderlohn", $ob_marker); ?>" required> <br />
									<input type="submit" name="op_save_obj_settings_btn" value="Speichern" onclick="SaveSettings(op_name.value, op_description.value)" >
									<input type="submit" name="op_del_obj_btn" value="Löschen">
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
