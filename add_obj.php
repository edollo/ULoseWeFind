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
							<form enctype="multipart/form-data" method="POST" action="lib_core.php">
								<div class="container">
									<input type="text" placeholder="Object title" name="obj_name" id="obj_name" required> <br />
									<input type="text" placeholder="Object description" name="obj_desc" id="obj_desc" required> <br />
									<input type="text" placeholder="Reward for the finder" name="obj_flohn" id="obj_flohn" required> <br />
									<div class="upload-btn-wrapper">
										<button>Choose img</button>
										<input type="file" accept="image/*" name="obj_img" id="obj_img">
									</div>
									<br /> <br /> <br />
									<input type="submit" value="Objekt erstellen" name="conf_add_button" id="conf_add_button">
								</div>
						    </form>
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
