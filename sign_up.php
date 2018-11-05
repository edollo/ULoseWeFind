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
            <li><a href="loser_page.html">My Objects</a></li>
            <li><a href="declare_new_object.html">New Object</a></li>
            <li><a href="login.html">Sign in / Sign up</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <div class="inner">
            <header>
                <h1>U Lose We Find</h1>
                <p>A Webservice to help finding your lost valuables.</p>
            </header>
            <form method="POST" action="db_query.php">
                <div class="container">
                    <input type="text" placeholder="Enter Username" maxlength="15" name="su_uname" required> <br />
                    <input type="password" placeholder="Enter Password" name="su_psw_1" required> <br />
                    <input type="password" placeholder="Confirm Password" name="su_psw_2" required> <br />
                    <input type="text" placeholder="E-Mail Adresse" name="su_email" required> <br />
                    <input type="text" placeholder="Adresse" name="su_adresse" required> <br />
                    <input type="tel" placeholder="Tel. Nummer" name="su_tel" maxlength="10" required> <br /><br />
                    <input type="submit" name="sign_up_btn" value="Sign up!">
                </div>
            </form>
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
                    <li><a href="#" class="icon style2 fa-phone"><span class="label">Phone</span></a></li>
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
