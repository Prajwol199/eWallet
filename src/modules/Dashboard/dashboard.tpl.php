<script type="text/template" id="dashboardView">
	<div class="dashboard col-md-8 col-md-offset-2">
		<div align="center" style="margin-bottom:10px;">
			<button id="dashboard" class="btn btn-primary">Dashboard</button>
			<button id="logout" class="btn btn-success">Logout</button>
		</div>
	   <button class="btn btn-danger btn-lg center-block navigator" data-route="addCategory" id="addCategory" style="margin-bottom:10px;"><i class="glyphicon glyphicon-plus"></i> Add New Category</button>
		<table class="table allTable">
			<tr>
				<!-- <th>S.N</th> -->
				<th>Categories</th>
				<th>Data</th>
				<th>Action</th>
			</tr>
			{{#each item.data}}
			<tr>
				<!-- <td>{{@key}}</td> -->
				<td>
					<p class="title-{{this.id}}">{{this.title}}</p>
					<div id="editCategoryField-{{this.id}}" hidden>
					<input type="text" value="{{this.title}}" id="editTitle-{{this.id}}" class="form-control" name="titleName-{{this.id}}">
					<button type="submit" id="btnSave" class="btn btn-warning" data-id="{{this.id}}">Save</button></div>
				</td>
				<td>
					<a href=""><button class="btn btn-primary btn-md categoryData" data-route="categoryData" data-id="{{this.id}}"><i class="glyphicon glyphicon-eye-open"></i>
		               View Data
		            </button></a>
	        	</td>
				<td>
		            <button type="submit" data-route="{{this.id}}" class="btn btn-danger delete" id="deleteCategory-{{this.id}}" onclick="return confirm('Are you sure Delete?')"><i class="glyphicon glyphicon-trash"></i> Delete</button>

		            <button class="btn btn-success btn-md edit" id="btnEdit" data-route="edit" data-id="{{this.id}}"><i class="glyphicon glyphicon-edit"></i> Edit
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
		        <div class="loginPage col-md-6 col-md-offset-3">
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
<script type="text/template" id="categoryView">
	<div class="categoryView col-md-8 col-md-offset-2">
		<div align="center" style="margin-bottom:10px;">
			<button id="dashboard" class="btn btn-primary" >Dashboard</button>
			<button id="logout" class="btn btn-success" >Logout</button>

		   <button class="btn btn-danger btn-lg center-block navigator" data-route="addCategoryData" style="margin-top:10px;" id="addCategoryData" style="margin-bottom:10px;"><i class="glyphicon glyphicon-plus"></i> Add New Category Data</button>
		</div>
		<h1 align="center">Data in current Category</h1>
		<div class="container">
		    <div class="row">
		    	<div class="col-md-8"> 
		    		<table class="table allTable">
		    			<tr>
		    				<th>Field Name</th>
		    				<th>Description</th>
		    				<th>Action</th>
		    			</tr>
		    			{{#each item.data}}
		    			<tr>
		    				<td>
		    					<p class="fieldName-{{this.id}}">{{this.field_name}}</p>
								<div id="editTitleField-{{this.id}}" hidden>
								<input type="text" value="{{this.field_name}}" id="editFieldName-{{this.id}}" class="form-control" name="fieldName-{{this.id}}">
		    				</td>
		    				<td>
		    					<p class="description-{{this.id}}">{{this.description}}</p>
								<div id="editDataField-{{this.id}}" hidden>
								<textarea id="editDescription-{{this.id}}" class="form-control" name="description-{{this.id}}" cols="50" rows="2">{{this.description}}</textarea>

								<button type="submit" id="btnSaveData" class="btn btn-warning" data-id="{{this.id}}">Save</button></div>
		    				</td>
		    				<td>
		    					<button type="submit" data-route="{{this.id}}" id="deleteCategory-{{this.id}}" class="btn btn-danger deleteData" onclick="return confirm('Are you sure Delete?')"><i class="glyphicon glyphicon-trash"></i> Delete</button>

					             <button class="btn btn-success btn-md editData" id="btnEditData" data-id="{{this.id}}"><i class="glyphicon glyphicon-edit"></i> Edit
		            			</button></a>
		    				</td>
		    			</tr>
		    			{{/each}}
		    		</table>
		    	</div>
		    </div>
		</div>
	</div>
</script>
<script type="text/template" id="addDataView">
<div class="addDataView col-md-5 col-md-offset-3">
	<div align="center" style="margin-bottom:10px;">
		<button id="dashboard" class="btn btn-primary" >Dashboard</button>
		<button id="logout" class="btn btn-success" >Logout</button>
	</div>	
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
</script>