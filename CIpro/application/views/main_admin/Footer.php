 	<script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

	 <script type="text/javascript">
	 	  $(document).ready(function(){
	 	  	//搜尋結果先隱藏起來
	 	  	$('.search_table').hide();
	 	  	//更新欄位必須先藏起來
	 	  	$('.txtedit').hide();
		    //使用者在更改資料所需要的js
	    	//當點擊欲修改的欄位時
	    	$('.edit').click(function()
	    	{
	    		//收起input元素
	    		$('.txtedit').hide();
	    		//呈現另一個input元素
	    		$(this).next('.txtedit').show().focus();
	    		//收起被點擊的元素
	    		$(this).hide();
	    	});

	    	//當focusout該輸入框時
	    	$('.txtedit').focusout(function()
	    	{
	    		//取得所編輯的id、field name與value
	    		var edit_id = $(this).data('id');
	    		var fieldname = $(this).data('field');
	    		var value = $(this).val();
	    		//指派至元素變數
	    		var element = this;
	    		//傳送AJAX請求
	    		$.ajax(
	    		{
	    			url: '<?= base_url() ?>index.php/admin/setting/update_user_admin',
	    			type: 'post',
	    			data:
	    			{
	    				field: fieldname,
	    				value: value,
	    				id: edit_id
	    			},
	    			success: function(response)
	    			{
	    				//隱藏input元素
	    				$(element).hide();

	    				//更新所呈現的值
	    				$(element).prev('.edit').show();
	    				$(element).prev('.edit').text(value);
	    			}
	    		});
	    	});


	    	//點擊刪除鍵時進行刪除動作
	    	$('.delete_user').click(function(){
	    		var id = $(this).data('id');
	    		this_tr = $(this).parent().parent().parent().parent();
	    		var c = confirm("是否確定要刪除？");
	    		if (c) {
					$.ajax({
						type: "POST",
						url: '<?= base_url() ?>index.php/admin/setting/delete_user',
						data: {
							id: id
						},
		    			success: function(response)
		    			{
		    				alert("刪除成功，請按確認！");
		    				this_tr.fadeOut();
		    			}					
					})
	    		}
	    	});

	    	//點擊搜尋欄位時隱藏整個table
	    	$('.search_stuff').click(function(){
	    		$('.all_table').fadeOut();
	    		$('.search_table').fadeIn();
	    	});

	    	//離開搜尋欄位時再次顯示整個table
	    	$('.search_stuff').focusout(function(){
	    		//當兩者都是空值時才回復所有表格
	    		if ($('#search_username').val() == "" && $('#search_email').val() == "") {
					$('.search_table').fadeOut();
		    		$('.all_table').fadeIn();
	    		}
	    	});

	    	

	    	//不管兩個欄位都不是空值，都傳送值的函式
	    	function get_info()
	    	{

    			$.ajax({
    				type:'POST',
    				url: '<?= base_url() ?>index.php/admin/setting/search_username_email',
    				data: 
    				{	
    					'n': $("#search_username").val(),
    					'm': $("#search_email").val()

    				},
    				//dataType:'json',
					}).done(function(data){
	                   //var result = JSON.parse(data);
	                   /*for (var i = 0; i < 5; i++) {
	                   	$('#tablee').append('<tr>');
	                   	$('#tablee').append('<td>' + "1" + '</td>');
	                   	$('#tablee').append('<td>' + "2" + '</td>');
	                   	$('#tablee').append('<td>' + data['search'][0]['username'] + '</td>');
	                   	$('#tablee').append('<td>' + "3" + '</td>');
	                   	$('#tablee').append('<td>' + "4" + '</td>');
	                   	$('#tablee').append('</tr>');
	                   }*/
	                   
	                   console.log(data['search']);
	                   //console.log(result);
	                   for (var i = 0; i < data['search'].length; i++) {
	                   		/*html.push('<td>' + data['search'][i]['username'] + '</td>');
	                   		$('#tablee').append(html.join());
*/							$('#tablee').append('<tr>');
		                   	$('#tablee').append('<td>' + data['search'][i]['username'] + '</td>');
		                   	$('#tablee').append('<td>' + data['search'][i]['email'] + '</td>');
		                   	$('#tablee').append('<td>' + data['search'][i]['gender'] + '</td>');
		                   	$('#tablee').append('<td>' + data['search'][i]['hobby'] + '</td>');
		                   	$('#tablee').append('</tr>');
	                   }
	                   /*$.each(data,function(index, object)
	                   {
	                   	$('#tablee').append('<td>' + object + '</td>');
	                   })
*/	                   
						
                }).fail(function(jqXHR, exception){
                  	//alert("有錯誤產生，請看 console.log");
					var msg = '';
					        if (jqXHR.status === 0) {
					            msg = 'Not connect.\n Verify Network.';
					        } else if (jqXHR.status == 404) {
					            msg = 'Requested page not found. [404]';
					        } else if (jqXHR.status == 500) {
					            msg = 'Internal Server Error [500].';
					        } else if (exception === 'parsererror') {
					            msg = 'Requested JSON parse failed.';
					        } else if (exception === 'timeout') {
					            msg = 'Time out error.';
					        } else if (exception === 'abort') {
					            msg = 'Ajax request aborted.';
					        } else {
					            msg = 'Uncaught Error.\n' + jqXHR.responseText;
					        }		
					        alert(msg);	        
                });	 
	    	};

	    	//一但帳號輸入後即開始進行動態搜尋
	    	$("#search_username").keyup(function(){
				//不管兩個欄位都不是空值，都傳送值
				get_info(); 				
	    	});

	    	//一但email輸入後即開始進行動態搜尋
	    	$("#search_email").keyup(function(){
				//不管兩個欄位都不是空值，都傳送值
				get_info();   					
	    	});


		  });
	 </script>
  	 <footer class = "page-footer">
		 <div class="footer-copyright">
            <div class="container">
			<em>
				<?= "&copy" . date("Y")  .  "Copyright 王志凌";?>	
			</em>
            </div>
          </div>
	 </footer>
 </body>
</html>