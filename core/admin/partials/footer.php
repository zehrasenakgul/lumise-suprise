<?php
global $lumise;
?><script>
	var LumiseDesign = {
		url: "<?php echo htmlspecialchars_decode($lumise->cfg->url); ?>",
		admin_url: "<?php echo htmlspecialchars_decode($lumise->cfg->admin_url); ?>",
		ajax: "<?php echo htmlspecialchars_decode($lumise->cfg->admin_ajax_url); ?>",
		assets: "<?php echo $lumise->cfg->assets_url; ?>",
		jquery: "<?php echo $lumise->cfg->load_jquery; ?>",
		nonce: "<?php echo lumise_secure::create_nonce('LUMISE_ADMIN') ?>",
		filter_ajax: function(ops) {
			return ops;
		},
		js_lang: <?php echo json_encode($lumise->cfg->js_lang); ?>,
	};
</script>
<script src="<?php echo $lumise->cfg->admin_assets_url; ?>js/vendors.js?version=<?php echo LUMISE; ?>"></script>
<script src="<?php echo $lumise->cfg->admin_assets_url; ?>js/tag-it.min.js?version=<?php echo LUMISE; ?>"></script>
<script src="<?php echo $lumise->cfg->admin_assets_url; ?>js/main.js?version=<?php echo LUMISE; ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo $lumise->cfg->admin_assets_url; ?>js/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
<script type="text/javascript" src="<?php echo $lumise->cfg->admin_assets_url; ?>js/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
<script type="text/javascript" src="<?php echo $lumise->cfg->admin_assets_url; ?>js/jquery-menu-editor.min.js"></script>
<script>
	var iconPickerOptions = {
		searchText: "Buscar...",
		labelHeader: "{0}/{1}"
	};
	// sortable list options
	var sortableListOptions = {
		placeholderCss: {
			'background-color': "#cccccc"
		}
	};
	var editor = new MenuEditor('myEditor', {
		listOptions: sortableListOptions,
		iconPicker: iconPickerOptions,
		maxLevel: 2 // (Optional) Default is -1 (no level limit)
		// Valid levels are from [0, 1, 2, 3,...N]
	});

	var page = new MenuEditor('myPagesEditor', {
		listOptions: sortableListOptions,
		iconPicker: iconPickerOptions,
		maxLevel: 2 // (Optional) Default is -1 (no level limit)
		// Valid levels are from [0, 1, 2, 3,...N]
	});


	var pageLinks = new MenuEditor('myPageLinksEditor', {
		listOptions: sortableListOptions,
		iconPicker: iconPickerOptions,
		maxLevel: 2 // (Optional) Default is -1 (no level limit)
		// Valid levels are from [0, 1, 2, 3,...N]
	});

	$('.item-name').keyup(function(e) {
		$.ajax({
			url: "test.html",
			context: document.body
		}).done(function() {
			$(this).addClass("done");
		});
	})

	editor.setForm($('#frmEdit'));
	editor.setUpdateButton($('#btnUpdate'));

	page.setForm($('#editPage'));
	page.setUpdateButton($('#btnUpdatePage'));

	pageLinks.setForm($('#pageLinksForm'));
	pageLinks.setUpdateButton($('#btnUpdatePage'));

	//Calling the update method
	$("#btnUpdate").click(function() {
		editor.update();
	});
	// Calling the add method
	$('#btnAdd').click(function() {
		editor.add();
	});

	$('#btnAddPage').click(function() {
		page.add();
	});

	$("#btnUpdatePage").click(function() {
		page.update();
	});


	$('#btnAddPageLinks').click(function() {
		pageLinks.add();
	});

	$("#btnUpdatePagelİnks").click(function() {
		pageLinks.update();
	});

	$.get("http://localhost/lumise/page.php", function(data) {
		data = JSON.parse(data);
		page.setData(data.rows);
	});

	$.get("http://localhost/lumise/menu.php", function(data) {
		data = JSON.parse(data);
		editor.setData(data.rows);
	});

	$('.save-menu span').click(function() {
		var str = editor.getString();
		str = JSON.parse(str);
		$.post("http://localhost/lumise/menu.php", {
			'set_menu': 1,
			data: str
		}, function(data) {
			console.log(data);
		});
	})


	$('.save-page span').click(function() {
		var str = page.getString();
		str = JSON.parse(str);
		console.log(str);
		$.post("http://localhost/lumise/page.php", {
			'set_page': 1,
			data: str
		}, function(data) {
			alert("Added Pages");
			$("#myPagesEditor").html("");
		});
	})

	$('.save-page-links span').click(function() {
		var str = pageLinks.getString();
		str = JSON.parse(str);
		$.post("http://localhost/lumise/footer_menu.php", {
			'set_page_id': 1,
			data: str
		}, function(data) {
			console.log(data);
			alert("Added Page Links");
			$("#myPageLinksEditor").html("");
		});
	})


	$('.page_search_button').click(function() {
		$.ajax({
			url: "http://localhost/lumise/footer_menu.php?get_pages=1&page_name=" + $('#page_name').val(),
			context: document.body
		}).done(function(res) {
			res = JSON.parse(res);
			var html = '';
			console.log(res);
			for (var i = 0; i < res.length; i++) {
				html += '<div class="page-item col-md-3" data-order="' + i + '">' +
					'<div>' +
					'<span>Page Name: ' + res[i].text + '</span>' +
					'</div>' +
					'<div>' +
					'<span>Page URL : http://localhost/lumise_php/' + res[i].href + '</span>' +
					'</div>' +
					'<div>' +
					'<button class="add-item-to-page btn btn-primary mt-2">Fill the Fields</button>' +
					'</div>' +
					'</div>';
			}

			$('.page-items .row').html(html);

			$('.add-item-to-page').click(function() {
				var order = parseInt($(this).parent('div').parent('div').attr('data-order'));
				$('.menu_text').val(res[order].text)
				$('.menu_tooltip').val(res[order].text)
				$('.menu_slug').val(res[order].href)
				$('.menu_url').val('http://localhost/lumise/' + res[order].href)
			})
		});
	})

	$('.category_search_button').click(function() {
		$.ajax({
			url: "http://localhost/lumise/menu.php?get_categories=1&category_name=" + $('#category_name').val(),
			context: document.body
		}).done(function(res) {
			res = JSON.parse(res);
			var html = '';
			for (var i = 0; i < res.length; i++) {
				html += '<div class="category-item col-md-3" data-order="' + i + '">' +
					'<div>' +
					'<span>Kategori Adı : ' + res[i].name + '</span>' +
					'</div>' +
					'<div>' +
					'<span>Kategori URL : http://localhost/lumise_php/products.php?category_id=' + res[i].id + '</span>' +
					'</div>' +
					'<div>' +
					'<button class="add-item-to-menu btn btn-primary mt-2">Alanları Doldur</button>' +
					'</div>' +
					'</div>';
			}

			$('.category-items .row').html(html);

			$('.add-item-to-menu').click(function() {
				var order = parseInt($(this).parent('div').parent('div').attr('data-order'));
				$('.menu_text').val(res[order].name)
				$('.menu_tooltip').val(res[order].name)
				$('.menu_url').val('http://localhost/lumise/products.php?category_id=' + res[order].id)
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