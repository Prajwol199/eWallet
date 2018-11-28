<script type="text/template" id="loginView">
	<div class="container">
	    <div class="row">
	        <div class="loginPage col-md-5 col-md-offset-4">
	            <div class="panel panel-primary" >
	                <div class="panel-heading" align="center">Login to dashboard</div>
	                <div class="panel-body">
	                    <form  method="post" name="form" id="login-form">
	                        <div class="form-group input-group">
	                            <span class="input-group-addon" id="sizing-addon2">Email</span>
	                            <input type="text" name="email" class="form-control" placeholder="Username">
	                        </div>
	                        <div class="form-group input-group">
	                            <span class="input-group-addon" id="sizing-addon2">Password</span>
	                            <input type="password" name="password" class="form-control" placeholder="Password">
	                        </div>

	                        <a href="" id="forgot">Forgot password?</a>

	                        <div class="form-group">
	                            <button class="btn btn-success btn pull-right" name="login">LogIn</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</script>

<script type="text/template" id="registerVIew">
<div class="small_content col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
    	<div class="panel-heading" align="center">Register</div>
		<form name="register-form" id="register-form">
			<div class="form-group">
				<label>UserName :</label>
				<input type="text" name="name" id="name" class="form-control">
			</div>

			<div class="form-group">
				<label>E-mail :</label>
				<input type="email" name="email" id="email" class="form-control">
			</div>

			<div class="form-group">
				<label>password :</label>
				<input type="password" name="password" id="pwd" class="form-control">
			</div>

			<button type="submit" id="submit" class="btn btn-primary">Register</button>
		</form>
	</div>
</div>
</script>

<script type="text/template" id="forgotView">
<div class="loginPage col-md-5 col-md-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Recover password</div>
        	<div class="panel-body">
        		<form name="forgot-form" id="forgot-form">
       				<div class="form-group">
          				<label for="uname"> Enter your email </label>
          				<input type="text" name="email" id="name" class="form-control">
       				</div>
       				<div class="form-group">
          				<button class="btn btn-primary btn pull-right btn-md">Recover</button>
        			</div>
        		</form>
        	</div>
    </div>
</div>
</script>
<script type="text/template" id="token-verify">
<div class="loginPage col-md-5 col-md-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Recover password</div>
        	<div class="panel-body">
        		<form id="forgotform" name="forgotform">
       				<div class="form-group">
          				<label for="uname"> Enter Token </label>
          				<input type="text" name="token" id="token" class="form-control">
       				</div>
              <div class="form-group">
                  <label for="uname"> New Password </label>
                  <input type="text" name="npass" id="npass" class="form-control">
              </div>
              <div class="form-group">
                  <button class="btn btn-success btn-md" id="resend">Resend Token</button>
              </div>
       				<div class="form-group">
          				<button class="btn btn-primary btn pull-right btn-md">Recover</button>
        			</div>
        		</form>
        	</div>
    </div>
</div>
</script>