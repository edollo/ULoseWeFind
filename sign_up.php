<?php
//###################################################
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//|Project:       ULWF                             |#
//|Filename:      sign_up.php                      |#
//|Licence:       © Open Licence			       |#
//|Created by:    Anto Ivankovic / Samuel Maissen  |#
//++++++++++++++++++++++++++++++++++++++++++++++++++#
//###################################################

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
	function PwValidator(su_psw_1_f, su_psw_2_f) {

			if (document.getElementById("su_psw_1").value == "" && document.getElementById("su_psw_2").value == "") {

				document.getElementById("su_validpw").innerHTML = "";
				document.getElementById("su_psw_1").style.borderBottom = "solid 1px #c9c9c9";
				document.getElementById("su_psw_2").style.borderBottom = "solid 1px #c9c9c9";
				return;

			}

			else if (document.getElementById("su_psw_2").value == "") {

				document.getElementById("su_validpw").innerHTML = "";
				document.getElementById("su_psw_2").style.borderBottom = "solid 1px #c9c9c9";
				return;

			}
			else if (document.getElementById("su_psw_1").value == "" && document.getElementById("su_psw_2").value !== "")
			{
				document.getElementById("su_psw_1").style.borderBottom = "solid 1px red";
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
							document.getElementById("su_psw_1").style.borderBottom = "solid 1px #c9c9c9";
							document.getElementById("su_psw_2").style.borderBottom = "solid 1px red";
							document.getElementById("su_validpw").innerHTML = "Passwort nicht identisch";
						}
						else
						{
							document.getElementById("su_validpw").innerHTML = "";
							document.getElementById("su_psw_1").style.borderBottom = "solid 1px #c9c9c9";
							document.getElementById("su_psw_2").style.borderBottom = "solid 1px #c9c9c9";
						}
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("su_psw_1=" + su_psw_1_f + "&su_psw_2=" + su_psw_2_f);
			}
		}

		function EmailValidator(su_email_f) {

			if (document.getElementById("su_email").value == "") {

				document.getElementById("su_validemail").innerHTML = "";
				document.getElementById("su_email").style.borderBottom = "solid 1px #c9c9c9";
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
							document.getElementById("su_email").style.borderBottom = "solid 1px red";
							document.getElementById("su_validemail").innerHTML = "Account unter Email-Aresse schon vorhanden";
						}
						else if(this.responseText == "emailincorrect")
						{
							document.getElementById("su_email").style.borderBottom = "solid 1px red";
							document.getElementById("su_validemail").innerHTML = "Email-Aresse ungültig";
						}

						else
						{
							document.getElementById("su_validemail").innerHTML = "";
							document.getElementById("su_email").style.borderBottom = "solid 1px #c9c9c9";
						}

					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("ValidateUname=" + true + "&su_email=" + su_email_f);
			}
		}


		function EmailValidatorOpt(su_emailopt_f) {

		if (document.getElementById("su_emailopt").value == "") {

			document.getElementById("su_validemailopt").innerHTML = "";
			document.getElementById("su_emailopt").style.borderBottom = "solid 1px #c9c9c9";
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

					if(this.responseText == "emailincorrect")
					{
						document.getElementById("su_emailopt").style.borderBottom = "solid 1px red";
						document.getElementById("su_validemailopt").innerHTML = "Email-Aresse ungültig";
					}

					else
					{
						document.getElementById("su_validemailopt").innerHTML = "";
						document.getElementById("su_emailopt").style.borderBottom = "solid 1px #c9c9c9";
					}

				}
			};

			xmlhttp.open("POST","db_query.php",true);
			xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xmlhttp.send("ValidateUname=" + true + "&su_email=" + su_emailopt_f);
		}
	}



		function SignUp(su_signup_btn_f, su_vorname_f, su_name_f, su_email_f, su_emailopt_f, su_psw_1_f, su_psw_2_f) {

			if (su_signup_btn_f == "" ||  su_vorname_f == "" || su_name_f == "" || su_psw_1_f == "" || su_psw_2_f == "" || su_email_f == "") {

				if(su_vorname_f == "")
				{
					document.getElementById("su_vorname").style.borderBottom = "solid 1px red";
				}

				if(su_name_f == "")
				{
					document.getElementById("su_name").style.borderBottom = "solid 1px red";
				}

				if(su_psw_1_f == "" && su_psw_2_f == "")
				{
					document.getElementById("su_psw_1").style.borderBottom = "solid 1px red";
					document.getElementById("su_psw_2").style.borderBottom = "solid 1px red";
				}

				if(su_email_f == "")
				{
					document.getElementById("su_email").style.borderBottom = "solid 1px red";
				}

				return;

			} else {

				//rot unterstrichende felder für name und vorname entfernen
				document.getElementById("su_vorname").style.borderBottom = "solid 1px #c9c9c9";
				document.getElementById("su_name").style.borderBottom = "solid 1px #c9c9c9";
				document.getElementById("su_psw_1").style.borderBottom = "solid 1px #c9c9c9";
				document.getElementById("su_psw_2").style.borderBottom = "solid 1px #c9c9c9";

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
						var fail = /fail/;

						if(this.responseText == "existsnotmatchingsuccess")
						{
							document.getElementById("su_form").style.display = 'none';
							document.getElementById("su_success").style.display = 'block';
						}
						else if (fail.test(this.responseText))
						{

							document.getElementById("su_form").style.display = 'none';
							document.getElementById("su_error").style.display = 'block';

						}
					}
				};

				xmlhttp.open("POST","db_query.php",true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("su_signup_btn=" + su_signup_btn_f + "&ValidateUname=" + true + "&su_vorname=" + su_vorname_f + "&su_name=" + su_name_f + "&su_email=" + su_email_f + "&su_emailopt=" + su_emailopt_f +"&su_psw_1=" + su_psw_1_f + "&su_psw_2=" + su_psw_2_f );
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

                <div class="container" id="su_form">
					<input type="text" placeholder="Name" name="su_vorname" id="su_vorname" > <br />
					<input type="text" placeholder="Surname" name="su_name" id="su_name" > <br />
				    <input type="text" placeholder="E-Mail Adress" name="su_email" id="su_email" onchange="EmailValidator(this.value)" > <br />
					<p id="su_validemail"></p>
					<input type="text" placeholder="Optional E-Mail Adress" name="su_emailopt" id="su_emailopt" onchange="EmailValidatorOpt(this.value)" > <br />
					<p id="su_validemailopt"></p>
                    <input type="password" placeholder="Password" name="su_psw_1" id="su_psw_1"  onchange="PwValidator(this.value, su_psw_2.value)" > <br />
                    <input type="password" placeholder="Confirm Password" name="su_psw_2" id="su_psw_2" onchange="PwValidator(su_psw_1.value, this.value)" > <br />
					<p id="su_validpw"></p>
                    <input type="submit" name="su_signup_btn" value="Sign up!" onclick="SignUp(this.value, su_vorname.value, su_name.value, su_email.value, su_emailopt.value, su_psw_1.value, su_psw_2.value)" >
                </div>
				<div class="container" id="su_success" style="display: none;">
					<h3>successfully registered<a href="login.php">Login</a> </h3>
                </div>
				<div class="container" id="su_error" style="display: none;">
					<h3 style="color: red; font-weight: bold;">Fehler bei der Registrierung. Bitte versuchen sie es erneuert. <a href="sign_up.php">SignUp</a> </h3>
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
