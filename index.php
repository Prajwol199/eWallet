<!DOCTYPE html>
<html>
<head>
    <title>Assignment</title> 
    <link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/bootstrap.css">
</head>
<boby >
<div class="content">
    <div class="col-md-12">
        <h1 align="center" >Single page Application</h1>
        <button class="btn btn-primary" id="register">Register</button>
        <button class="btn btn-success" id="login">Login</button>
        <div id="render"></div>
    </div>
</div>
<?php require_once( 'build/templates.php' ); ?>
<script src="http://localhost/eWallet/static/jquery.min.js"></script>
<script src="http://localhost/eWallet/static/finch.min.js"></script>
<script src="http://localhost/eWallet/static/handlebars.js"></script>
<script src="http://localhost/eWallet/build/app.js"></script>
</body>
</html>