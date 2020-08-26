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

	    	//一但帳號輸入後即開始進行動態搜尋
	    	$("#search_username").keyup(function(){
	    		if ($("#search_username").val() != "") {
	    			if ($("#search_email").val() != "") {
	    				//兩個欄位都不是空值
		    			$.ajax({
		    				type:'POST',
		    				url: '<?= base_url() ?>index.php/admin/setting/search_username_email',
		    				data: 
		    				{	
		    					'n': $("#search_username").val(),
		    					'm': $("#search_email").val()

		    				},
		    				dataType:"html",
							success: function(data)
								{
							    	$('#tablee').html(data);
							    }

	    					});	    				
	    			}else{
	    				//email欄位是空值，帳號欄位不是空值
		    			$.ajax({
		    				type:'POST',
		    				url: '<?= base_url() ?>index.php/admin/setting/search_username',
		    				data: {'n': $("#search_username").val()},
		    				dataType:"html",
							success: function(data)
								{
							    	$('#tablee').html(data);
							    }

	    					});
	    			}
	    		}
	    	});

	    	//一但email輸入後即開始進行動態搜尋
	    	$("#search_email").keyup(function(){
	    		if ($("#search_email").val() != "") {
	    			if ($("#search_username").val() != "") {
	    				//兩個欄位都不是空值
		    			$.ajax({
		    				type:'POST',
		    				url: '<?= base_url() ?>index.php/admin/setting/search_username_email',
		    				data: 
		    				{	
		    					'n': $("#search_username").val(),
		    					'm': $("#search_email").val()

		    				},
		    				dataType:"html",
							success: function(data)
								{
							    	$('#tablee').html(data);
							    }

	    					});	
	    			}else{
	    				//帳號欄位是空值，email欄位不是空值
		    			$.ajax({
		    				type:'POST',
		    				url: '<?= base_url() ?>index.php/admin/setting/search_email',
		    				data: {'n': $("#search_email").val()},
		    				dataType:"html",
							success: function(data)
								{
							    	$('#tablee').html(data);
							    }

	    					});
	    			}
	    		}
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