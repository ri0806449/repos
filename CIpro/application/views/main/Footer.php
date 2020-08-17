  	 <footer class = "page-footer">
		 <div class="footer-copyright">
            <div class="container">
			<em>
				<?= "&copy" . date("Y")  .  "Copyright 王志凌";?>	
			</em>
            </div>
         </div>
	 </footer>
	 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

	<script type="text/javascript">
	    $(document).ready(function(){
	        show_product(); //call function show all product
	         
	        $('#mydata').dataTable();
	          
	        //function show all product
	        function show_product(){
	            $.ajax({
	                type  : 'ajax',
	                url   : '<?php echo site_url('product/product_data')?>',
	                async : true,
	                dataType : 'json',
	                success : function(data){
	                    var html = '';
	                    var i;
	                    for(i=0; i<data.length; i++){
	                        html += '<tr>'+
	                                '<td>'+data[i].product_code+'</td>'+
	                                '<td>'+data[i].product_name+'</td>'+
	                                '<td>'+data[i].product_price+'</td>'+
	                                '<td style="text-align:right;">'+
	                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-product_code="'+data[i].product_code+'" data-product_name="'+data[i].product_name+'" data-price="'+data[i].product_price+'">Edit</a>'+' '+
	                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-product_code="'+data[i].product_code+'">Delete</a>'+
	                                '</td>'+
	                                '</tr>';
	                    }
	                    $('#show_data').html(html);
	                }
	 
	            });
	        }
	 
	        //Save product
	        $('#btn_save').on('click',function(){
	            var product_code = $('#product_code').val();
	            var product_name = $('#product_name').val();
	            var price        = $('#price').val();
	            $.ajax({
	                type : "POST",
	                url  : "<?php echo site_url('product/save')?>",
	                dataType : "JSON",
	                data : {product_code:product_code , product_name:product_name, price:price},
	                success: function(data){
	                    $('[name="product_code"]').val("");
	                    $('[name="product_name"]').val("");
	                    $('[name="price"]').val("");
	                    $('#Modal_Add').modal('hide');
	                    show_product();
	                }
	            });
	            return false;
	        });
	 
	        //get data for update record
	        $('#show_data').on('click','.item_edit',function(){
	            var product_code = $(this).data('product_code');
	            var product_name = $(this).data('product_name');
	            var price        = $(this).data('price');
	             
	            $('#Modal_Edit').modal('show');
	            $('[name="product_code_edit"]').val(product_code);
	            $('[name="product_name_edit"]').val(product_name);
	            $('[name="price_edit"]').val(price);
	        });
	 
	        //update record to database
	         $('#btn_update').on('click',function(){
	            var product_code = $('#product_code_edit').val();
	            var product_name = $('#product_name_edit').val();
	            var price        = $('#price_edit').val();
	            $.ajax({
	                type : "POST",
	                url  : "<?php echo site_url('product/update')?>",
	                dataType : "JSON",
	                data : {product_code:product_code , product_name:product_name, price:price},
	                success: function(data){
	                    $('[name="product_code_edit"]').val("");
	                    $('[name="product_name_edit"]').val("");
	                    $('[name="price_edit"]').val("");
	                    $('#Modal_Edit').modal('hide');
	                    show_product();
	                }
	            });
	            return false;
	        });
	 
	        //get data for delete record
	        $('#show_data').on('click','.item_delete',function(){
	            var product_code = $(this).data('product_code');
	             
	            $('#Modal_Delete').modal('show');
	            $('[name="product_code_delete"]').val(product_code);
	        });
	 
	        //delete record to database
	         $('#btn_delete').on('click',function(){
	            var product_code = $('#product_code_delete').val();
	            $.ajax({
	                type : "POST",
	                url  : "<?php echo site_url('product/delete')?>",
	                dataType : "JSON",
	                data : {product_code:product_code},
	                success: function(data){
	                    $('[name="product_code_delete"]').val("");
	                    $('#Modal_Delete').modal('hide');
	                    show_product();
	                }
	            });
	            return false;
	        });
	 
	    });
	 
	</script>
 </body>
</html>