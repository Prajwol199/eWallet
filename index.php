<!DOCTYPE html>
<html>
    <head>
        <title>Assignment</title> 
        <link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/style.css">
        <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body style="background-color:#bbc0c4;">
        <div class="content">
            <div class="col-md-12">
                <h1 align="center" >Single page Application</h1>           
                <div id="hide" align="center" style="margin-bottom: 20px;">
        	        <button class="btn btn-primary navigator" id="register" data-route="register">Register</button>
        	        <button class="btn btn-success navigator" data-route="login" id="login">Login</button>
                </div>
            </div>
            <div id="render"></div>
        </div>
        <footer>
            <p align="center"><a href=""><i class="fa fa-facebook-square" style="font-size:36px;"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-youtube-play"></i></a>
                <a href=""><i class="fa fa-linkedin-square"></i></a>
            </p>
            <p align="center"><b>Copyright © 2018 All Rights Reserved By Sitecore</b></p>
        </footer>
        <?php require_once( 'build/templates.php' ); ?>
        <script src="http://localhost/eWallet/static/jquery.min.js"></script>
        <script src="http://localhost/eWallet/static/finch.min.js"></script>
        <script src="http://localhost/eWallet/static/handlebars.js"></script>
        <script src="http://localhost/eWallet/build/app.js"></script>
    </body>
</html>