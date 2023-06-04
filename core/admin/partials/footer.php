<?php
	global $lumise;
?><script>
	var LumiseDesign = {
		url : "<?php echo htmlspecialchars_decode($lumise->cfg->url); ?>",
		admin_url : "<?php echo htmlspecialchars_decode($lumise->cfg->admin_url); ?>",
		ajax : "<?php echo htmlspecialchars_decode($lumise->cfg->admin_ajax_url); ?>",
		assets : "<?php echo $lumise->cfg->assets_url; ?>",
		jquery : "<?php echo $lumise->cfg->load_jquery; ?>",
		nonce : "<?php echo lumise_secure::create_nonce('LUMISE_ADMIN') ?>",
		filter_ajax: function(ops) {
			return ops;
		},
		js_lang : <?php echo json_encode($lumise->cfg->js_lang); ?>,
	};
</script>
<script src="<?php echo $lumise->cfg->admin_assets_url;?>js/vendors.js?version=<?php echo LUMISE; ?>"></script>
<script src="<?php echo $lumise->cfg->admin_assets_url;?>js/tag-it.min.js?version=<?php echo LUMISE; ?>"></script>
<script src="<?php echo $lumise->cfg->admin_assets_url;?>js/main.js?version=<?php echo LUMISE; ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo $lumise->cfg->admin_assets_url;?>js/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
<script type="text/javascript" src="<?php echo $lumise->cfg->admin_assets_url;?>js/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
<script type="text/javascript" src="<?php echo $lumise->cfg->admin_assets_url;?>js/jquery-menu-editor.min.js"></script>
<script>
	var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
	// sortable list options
	var sortableListOptions = {
		placeholderCss: {'background-color': "#cccccc"}
	};
	var editor = new MenuEditor('myEditor', 
		{ 
			listOptions: sortableListOptions, 
			iconPicker: iconPickerOptions,
			maxLevel: 2 // (Optional) Default is -1 (no level limit)
			// Valid levels are from [0, 1, 2, 3,...N]
		}
	);

	$('.item-name').keyup(function(e){
		$.ajax({
			url: "test.html",
			context: document.body
		}).done(function() {
		$( this ).addClass( "done" );
		});
	})

	editor.setForm($('#frmEdit'));
	editor.setUpdateButton($('#btnUpdate'));
	//Calling the update method
	$("#btnUpdate").click(function(){
		editor.update();
	});
	// Calling the add method
	$('#btnAdd').click(function(){
		editor.add();
	});

	$.get( "http://zadevelopment.com.tr/menu.php", function( data ) {
		data = JSON.parse(data);
		editor.setData(data.rows);
	});

	$('.save-menu span').click(function(){
		var str = editor.getString();
		str = JSON.parse(str);
		$.post( "http://zadevelopment.com.tr/menu.php",{'set_menu' : 1 , data : str}, function( data ) {
			console.log(data);
		});
	})

	$('.category_search_button').click(function(){
		$.ajax({
			url: "http://zadevelopment.com.tr/menu.php?get_categories=1&category_name="+$('#category_name').val(),
			context: document.body
		}).done(function(res) {
			res = JSON.parse(res);
			var html = '';
			for(var i = 0 ; i < res.length ; i++){
				html += '<div class="category-item col-md-3" data-order="'+i+'">'+
					'<div>'+
						'<span>Kategori Adı : '+res[i].name+'</span>'+
					'</div>'+
					'<div>'+
						'<span>Kategori URL : http://localhost/lumise_php/products.php?category_id='+res[i].id+'</span>'+
					'</div>'+
					'<div>'+
						'<button class="add-item-to-menu btn btn-primary mt-2">Alanları Doldur</button>'+
					'</div>'+
				'</div>';
			}

			$('.category-items .row').html(html);

			$('.add-item-to-menu').click(function(){
				var order = parseInt($(this).parent('div').parent('div').attr('data-order'));
				$('.menu_text').val(res[order].name)
				$('.menu_tooltip').val(res[order].name)
				$('.menu_url').val('http://zadevelopment.com.tr/products.php?category_id='+res[order].id)
			})
		});
	})
	
</script>
<?php
	
	$lumise->do_action('editor-footer');
	
	if ($lumise->connector->platform == 'php') {
		echo '</body></html>';
	}
?>
