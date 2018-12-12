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