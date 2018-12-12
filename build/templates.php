<script type="text/template" id="dashboardView">
	<div class="dashboard col-md-8 col-md-offset-2">
		<div align="center" style="margin-bottom:10px;">
			<button id="dashboard" class="btn btn-primary" >Dashboard</button>
			<button id="logout" class="btn btn-success" >Logout</button>
		</div>
		<!-- <h1 align="center">Categories added by user</h1> -->
	    <a href="" class="navigator" data-route="addCategory" id="addCategory"><button class="btn btn-danger btn-lg center-block" style="margin-bottom:10px;"><i class="glyphicon glyphicon-plus"></i> Add New Category</button></a>
		<table class="table">
			<tr>
				<th>S.N</th>
				<th>Categories</th>
				<th>Data</th>
				<th>Action</th>
			</tr>
			{{#each item.data}}
			<tr>
				<td>{{@key}}</td>
				<td>{{this.title}}</td>
				<td>
					<a href=""><button class="btn btn-primary btn-md categoryData" data-route="categoryData" data-id="{{this.id}}"><i class="glyphicon glyphicon-eye-open"></i>
		               View Data
		            </button></a>
	        	</td>
				<td>
		            <button type="submit" data-route="{{this.id}}" class="btn btn-danger delete" onclick="return confirm('Are you sure Delete?')"><i class="glyphicon glyphicon-trash"></i> Delete</button>
		            <button class="btn btn-success btn-md edit" data-route="edit" data-id="{{this.id}}"><i class="glyphicon glyphicon-edit"></i> Edit
		            </button></a>
				</td>
			</tr>
			{{/each}}
		</table>
	</div>
	
</script>

<script type="text/template" id="addCategoryView">
	<div class="addCategoryView">
		<div align="center" style="margin-bottom:10px;">
			<button id="dashboard" class="btn btn-primary" >Dashboard</button>
			<button id="logout" class="btn btn-success" >Logout</button>
		</div>
			<div class="container">
		    <div class="row">
		        <div class="loginPage col-md-5 col-md-offset-3">
		            <div class="panel panel-primary" >
		                <div class="panel-heading" align="center">Add Category</div>
		                <div class="panel-body">
		                    <form  method="post" name="addform" id="addCategory-form">
		                        <div class="form-group input-group">
		                            <span class="input-group-addon" id="sizing-addon2">Title</span>
		                            <input type="text" name="title" class="form-control" placeholder="Enter Title">
		                        </div>
		                        <div class="form-group">
		                            <button class="btn btn-success btn pull-right" name="login">Add</button>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</script>

<script type="text/template" id="editView">
	<div class="editView">
		<div align="center" style="margin-bottom:10px;">
			<button id="dashboard" class="btn btn-primary" >Dashboard</button>
			<button id="logout" class="btn btn-success" >Logout</button>
		</div>
		<div class="container">
		    <div class="row">
		        <div class="loginPage col-md-5 col-md-offset-3">
		            <div class="panel panel-primary" >
		                <div class="panel-heading" align="center">Edit Category</div>
		                <div class="panel-body">

		                    <form  method="post" name="addform" id="editCategory-form">
		                        <div class="form-group input-group">
		                            <span class="input-group-addon" id="sizing-addon2">Title</span>
		                            {{#each item.data}}
		                            <input type="text" id="title" class="form-control" value="{{this.title}}">
		                            {{/each}}
		                        </div>
		                        <div class="form-group">
		                            <button class="btn btn-success btn pull-right" name="login">Edit</button>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</script>
<script type="text/template" id="categoryView">
	<div class="categoryView">
		<div align="center" style="margin-bottom:10px;">
			<button id="dashboard" class="btn btn-primary" >Dashboard</button>
			<button id="logout" class="btn btn-success" >Logout</button>
		</div>
		<div class="container">
		    <div class="row">
		    	<h1>Data in current Category</h1>
		    	<div class="col-md-8"> 
		    		<table class="table">
		    			<tr>
		    				<th>Field Name</th>
		    				<th>Description</th>
		    				<th>Action</th>
		    			</tr>
		    			{{#each item.data}}
		    			<tr>
		    				<td>{{this.field_name}}</td>
		    				<td>{{this.description}}</td>
		    				<td>
		    					<button type="submit" data-route="{{this.id}}" class="btn btn-danger deleteData" onclick="return confirm('Are you sure Delete?')"><i class="glyphicon glyphicon-trash"></i> Delete</button>
					             <button class="btn btn-success btn-md editData" data-route="editData" data-id="{{this.id}}"><i class="glyphicon glyphicon-edit"></i> Edit
		            			</button></a>
		    				</td>
		    			</tr>
		    			{{/each}}
		    		</table>
		    	</div>
		    	<div class="col-md-4">
		    		<div class="panel panel-primary" >
		                <div class="panel-heading" align="center">Add Data</div>
		                <div class="panel-body">
		                    <form  method="post" name="addform" id="addData">
		                        <div class="form-group input-group">
		                            <span class="input-group-addon" id="sizing-addon2">Field Name</span>
		                            <input type="text" id="fieldName" class="form-control">
		                        </div>
		                        <div class="form-group input-group">
		                            <span class="input-group-addon" id="sizing-addon2">Description</span>
		                            <input type="text" id="description" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <button class="btn btn-success btn pull-right" name="login">Add Data</button>
		                        </div>
		                    </form>
		                </div>
		            </div>
		    	</div>
		    </div>
		</div>
	</div>
</script>
<script type="text/template" id="editDataView">
	<div class="editDataView"> 
		<div align="center" style="margin-bottom:10px;">
			<button id="dashboard" class="btn btn-primary" >Dashboard</button>
			<button id="logout" class="btn btn-success" >Logout</button>
		</div>
	    <div class="loginPage col-md-5 col-md-offset-3">
			<div class="panel panel-primary" >
	            <div class="panel-heading" align="center">Add Data</div>
	            <div class="panel-body">
	                <form  method="post" name="addform" id="editData">
	         			{{#each item.data}}
	                    <div class="form-group input-group">
	                        <span class="input-group-addon" id="sizing-addon2">Field Name</span>
	                        <input type="text" id="fieldName" name="fieldName" class="form-control" value="{{this.field_name}}">
	                    </div>
	                    <div class="form-group input-group">
	                        <span class="input-group-addon" id="sizing-addon2">Description</span>
	                        <textarea id="description" name="description"  class="form-control">{{this.description}}</textarea>
	                    </div>
	                    {{/each}}
	                    <div class="form-group">
	                        <button class="btn btn-success btn pull-right" name="login">Update</button>
	                    </div>
	                </form>
	            </div>
	        </div>
		</div>
	</div>
</script>
<script type="text/template" id="loginView">
	<div class="login">
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

	                        <a class="navigator" data-route="forgot" href="" id="forgot">Forgot password?</a>

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

<script type="text/template" id="registerView">
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
<script type="text/x-handlebars-template" id="token-verify">
<div class="loginPage col-md-5 col-md-offset-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Recover password</div>
        	<div class="panel-body">
        		<form id="recover-form"" name="recover-form">
       				<div class="form-group">
          				<label for="uname"> Enter Token </label>
          				<input type="text" name="token" id="token" class="form-control">
       				</div>
              <div class="form-group">
                  <label for="uname"> New Password </label>
                  <input type="password" name="password" id="npass" class="form-control">
              </div>
              <div class="form-group">
                  <button class="btn btn-success btn-md" id="resend-token" >Resend Token</button>
              </div>
       				<div class="form-group">
          				<button class="btn btn-primary btn pull-right btn-md">Recover</button>
        			</div>
        		</form>
        	</div>
    </div>
</div>
</script>