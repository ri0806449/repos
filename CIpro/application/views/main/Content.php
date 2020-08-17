<body>
	<header>
		<h1>
			會員資料總覽
		</h1>
	</header>

	<div class="row">
		<div class="col-sm-9 offset-sm-1">
			<table class="centered">
				<thead>
				<tr>
					<th>帳號</th>
					<th>email</th>
					<th>性別</th>
					<th>興趣</th>
					<th>編輯</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td id="user_username"><?= $username;  ?></td>
						<td id="user_email"><?= $email;  ?></td>
						<td id="user_gender">
							<?php 
							if ($gender == 0){
								echo "女孩";
								}
							elseif($gender == 1){
								echo "男孩";
								}	
							?>
						</td>
						<td id="user_hobby"><?= $hobby;  ?></td>
						<td>
							<button class="" id="edit_user_profile">
								編輯
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<button class="" id="logout" href="logout">登出</button>
		</div>
	</div>
	<div class="container">
	    <!-- Page Heading -->
	    <div class="row">
	        <div class="col-12">
	            <div class="col-md-12">
	                <h1>Product
	                    <small>List</small>
	                    <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a></div>
	                </h1>
	            </div>
	             
	            <table class="table table-striped" id="mydata">
	                <thead>
	                    <tr>
	                        <th>Product Code</th>
	                        <th>Product Name</th>
	                        <th>Price</th>
	                        <th style="text-align: right;">Actions</th>
	                    </tr>
	                </thead>
	                <tbody id="show_data">
	                     
	                </tbody>
	            </table>
	        </div>
	    </div>
	         
	</div>
	 
	        <!-- MODAL ADD -->
	            <form>
	            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	              <div class="modal-dialog modal-lg" role="document">
	                <div class="modal-content">
	                  <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                      <span aria-hidden="true">&times;</span>
	                    </button>
	                  </div>
	                  <div class="modal-body">
	                        <div class="form-group row">
	                            <label class="col-md-2 col-form-label">Product Code</label>
	                            <div class="col-md-10">
	                              <input type="text" name="product_code" id="product_code" class="form-control" placeholder="Product Code">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-md-2 col-form-label">Product Name</label>
	                            <div class="col-md-10">
	                              <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-md-2 col-form-label">Price</label>
	                            <div class="col-md-10">
	                              <input type="text" name="price" id="price" class="form-control" placeholder="Price">
	                            </div>
	                        </div>
	                  </div>
	                  <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
	                  </div>
	                </div>
	              </div>
	            </div>
	            </form>
	        <!--END MODAL ADD-->
	 
	        <!-- MODAL EDIT -->
	        <form>
	            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	              <div class="modal-dialog modal-lg" role="document">
	                <div class="modal-content">
	                  <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                      <span aria-hidden="true">&times;</span>
	                    </button>
	                  </div>
	                  <div class="modal-body">
	                        <div class="form-group row">
	                            <label class="col-md-2 col-form-label">Product Code</label>
	                            <div class="col-md-10">
	                              <input type="text" name="product_code_edit" id="product_code_edit" class="form-control" placeholder="Product Code" readonly>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-md-2 col-form-label">Product Name</label>
	                            <div class="col-md-10">
	                              <input type="text" name="product_name_edit" id="product_name_edit" class="form-control" placeholder="Product Name">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-md-2 col-form-label">Price</label>
	                            <div class="col-md-10">
	                              <input type="text" name="price_edit" id="price_edit" class="form-control" placeholder="Price">
	                            </div>
	                        </div>
	                  </div>
	                  <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
	                  </div>
	                </div>
	              </div>
	            </div>
	            </form>
	        <!--END MODAL EDIT-->
	 
	        <!--MODAL DELETE-->
	         <form>
	            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	              <div class="modal-dialog" role="document">
	                <div class="modal-content">
	                  <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                      <span aria-hidden="true">&times;</span>
	                    </button>
	                  </div>
	                  <div class="modal-body">
	                       <strong>Are you sure to delete this record?</strong>
	                  </div>
	                  <div class="modal-footer">
	                    <input type="hidden" name="product_code_delete" id="product_code_delete" class="form-control">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
	                  </div>
	                </div>
	              </div>
	            </div>
	            </form>
	        <!--END MODAL DELETE-->

 

 
