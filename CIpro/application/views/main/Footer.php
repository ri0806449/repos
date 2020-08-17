 	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

	 <script type="text/javascript">
	 	  $(document).ready(function(){
		    //materialize的js
		    $('.tap-target').tapTarget();
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
		    			url: '<?= base_url() ?>user_authentication/update_user',
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
		    				$(elemant).hide();

		    				//更新所呈現的值
		    				$(element).prev('.edit').show();
		    				$(element).prev('.edit').text(value);
		    			}
		    		});
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