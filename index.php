<!DOCTYPE html>
<html>
<head>
    <title>Assignment</title> 
    <link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/bootstrap.css">
     <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
</head>
<boby>
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
<?php require_once( 'build/templates.php' ); ?>
<script src="http://localhost/eWallet/static/jquery.min.js"></script>
<script src="http://localhost/eWallet/static/finch.min.js"></script>
<script src="http://localhost/eWallet/static/handlebars.js"></script>
<script src="http://localhost/eWallet/build/app.js"></script>
</body>
</html>