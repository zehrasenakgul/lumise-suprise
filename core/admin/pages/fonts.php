<?php
	$title = "Fonts";
	$prefix = 'fonts_';

	// Action Form
	if (isset($_POST['action_submit']) && !empty($_POST['action_submit'])) {

		$data_action = isset($_POST['action']) ? $_POST['action'] : '';
		$val = isset($_POST['id_action']) ? $_POST['id_action'] : '';
		$val = explode(',', $val);
		
		$lumise_admin->check_caps('fonts');
		
		foreach ($val as $value) {

			$dt = $lumise_admin->get_row_id($value, 'fonts');
			switch ($data_action) {

				case 'active':
					$data = array(
						'active' => 1
					);
					$dt = $lumise_admin->edit_row( $value, $data, 'fonts' );
					break;
				case 'deactive':
					$data = array(
						'active' => 0
					);
					$dt = $lumise_admin->edit_row( $value, $data, 'fonts' );
					break;
				case 'delete':
					$tar_file = realpath($lumise->cfg->upload_path).DS;

					if (!empty($dt['upload'])) {
						if (file_exists($tar_file.$dt['upload'])) {
							unlink($tar_file.$dt['upload']);
						}
					}
					$lumise_admin->delete_row($value, 'fonts');
					break;
				default:
					break;

			}

		}

	}

	// Search Form
	$data_search = '';
	if (isset($_POST['search_font']) && !empty($_POST['search_font'])) {

		$data_search = isset($_POST['search']) ? trim($_POST['search']) : '';

		if (empty($data_search)) {
			$errors = 'Please Insert Key Word';
			$_SESSION[$prefix.'data_search'] = '';
		} else {
			$_SESSION[$prefix.'data_search'] = 	$data_search;
		}

	}

	if (!empty($_SESSION[$prefix.'data_search'])) {
		$data_search = '%'.$_SESSION[$prefix.'data_search'].'%';
	}

	// Pagination
	$per_page = 5;
	if(isset($_SESSION[$prefix.'per_page']))
		$per_page = $_SESSION[$prefix.'per_page'];

	if (isset($_POST['per_page'])) {

		$data = isset($_POST['per_page']) ? $_POST['per_page'] : '';

		if ($data != 'none') {
			$_SESSION[$prefix.'per_page'] = $data;
			$per_page = $_SESSION[$prefix.'per_page'];
		} else {
			$_SESSION[$prefix.'per_page'] = 20;
			$per_page = $_SESSION[$prefix.'per_page'];
		}

	}

    // Sort Form
	if (!empty($_POST['sort'])) {

		$dt_sort = isset($_POST['sort']) ? $_POST['sort'] : '';
		$_SESSION[$prefix.'dt_order'] = $dt_sort;

		switch ($dt_sort) {

			case 'name_asc':
				$_SESSION[$prefix.'orderby'] = 'name';
				$_SESSION[$prefix.'ordering'] = 'asc';
				break;
			case 'name_desc':
				$_SESSION[$prefix.'orderby'] = 'name';
				$_SESSION[$prefix.'ordering'] = 'desc';
				break;
			default:
				break;

		}

	}

	$orderby  = (isset($_SESSION[$prefix.'orderby']) && !empty($_SESSION[$prefix.'orderby'])) ? $_SESSION[$prefix.'orderby'] : 'name';
	$ordering = (isset($_SESSION[$prefix.'ordering']) && !empty($_SESSION[$prefix.'ordering'])) ? $_SESSION[$prefix.'ordering'] : 'asc';
	$dt_order = isset($_SESSION[$prefix.'dt_order']) ? $_SESSION[$prefix.'dt_order'] : 'name_asc';

	// Get row pagination
    $current_page = isset($_GET['tpage']) ? $_GET['tpage'] : 1;
    $search_filter = array(
        'keyword' => $data_search,
        'fields' => 'name,upload'
    );

    $start = ( $current_page - 1 ) *  $per_page;
	$fonts = $lumise_admin->get_rows('fonts', $search_filter, $orderby, $ordering, $per_page, $start);
	$total_record = $lumise_admin->get_rows_total('fonts');

    $config = array(
    	'current_page'  => $current_page,
		'total_record'  => $fonts['total_count'],
		'total_page'    => $fonts['total_page'],
 	    'limit'         => $per_page,
	    'link_full'     => $lumise->cfg->admin_url.'nevnes-page=fonts&tpage={page}',
	    'link_first'    => $lumise->cfg->admin_url.'nevnes-page=fonts',
	);

	$lumise_pagination->init($config);

?>

<div class="lumise_wrapper">

	<div class="lumise_content">

		<div class="lumise_header">
			<h2><?php echo $lumise->lang('Custom Fonts'); ?></h2>
			<a href="<?php echo $lumise->cfg->admin_url;?>nevnes-page=font" class="add-new lumise-button">
				<i class="fa fa-plus"></i> 
				<?php echo $lumise->lang('Add new font'); ?>
			</a>
			<?php
				$lumise_page = isset($_GET['nevnes-page']) ? $_GET['nevnes-page'] : '';
				echo $lumise_helper->breadcrumb($lumise_page);
			?>
		</div>
		<div class="lumise_message noti">
			<em class="lumise_suc">
				<i class="fa fa-info-circle"></i>
				<?php echo $lumise->lang('Users can also select from over 800+ Google fonts and you can set the list default Google fonts in'); ?>
				<a href="<?php echo $lumise->cfg->admin_url;?>nevnes-page=settings">
					<?php echo $lumise->lang('General Settings'); ?>
					<i class="fa fa-cog"></i>
				</a>
			</em>
		</div>
	

		<div class="lumise_option">
			<div class="left">
				<form action="<?php echo $lumise->cfg->admin_url;?>nevnes-page=fonts" method="post">
					<select name="action" class="art_per_page">
						<option value="none"><?php echo $lumise->lang('Bulk Actions'); ?></option>
						<option value="active"><?php echo $lumise->lang('Active'); ?></option>
						<option value="deactive"><?php echo $lumise->lang('Deactive'); ?></option>
						<option value="delete"><?php echo $lumise->lang('Delete'); ?></option>
					</select>
					<input type="hidden" name="id_action" class="id_action">
					<input  class="lumise_submit" type="submit" name="action_submit" value="<?php echo $lumise->lang('Apply'); ?>">
					<?php $lumise->securityFrom();?>
				</form>
				<form action="<?php echo $lumise->cfg->admin_url;?>nevnes-page=fonts" method="post">
					<select name="per_page" class="art_per_page" data-action="submit">
						<option value="none">-- <?php echo $lumise->lang('Per page'); ?> --</option>
						<?php
							$per_pages = array('5', '10', '15', '20', '100');

							foreach($per_pages as $val) {

							    if($val == $per_page) {
							        echo '<option selected="selected">'.$val.'</option>';
							    } else {
							        echo '<option>'.$val.'</option>';
							    }

							}
						?>
					</select>
					<?php $lumise->securityFrom();?>
				</form>
				<form action="<?php echo $lumise->cfg->admin_url;?>nevnes-page=fonts" method="post">
					<select name="sort" class="art_per_page" data-action="submit">
						<option value="">-- <?php echo $lumise->lang('Sort by'); ?> --</option>
						<option value="name_asc" <?php if ($dt_order == 'name_asc' ) echo 'selected' ; ?> ><?php echo $lumise->lang('Name'); ?> A-Z</option>
						<option value="name_desc" <?php if ($dt_order == 'name_desc' ) echo 'selected' ; ?> ><?php echo $lumise->lang('Name'); ?> Z-A</option>
					</select>
					<?php $lumise->securityFrom();?>
				</form>
			</div>
			<div class="right">
				<form action="<?php echo $lumise->cfg->admin_url;?>nevnes-page=fonts" method="post">
					<input type="search" name="search" class="search" placeholder="<?php echo $lumise->lang('Search ...'); ?>" value="<?php if(isset($_SESSION[$prefix.'data_search'])) echo $_SESSION[$prefix.'data_search']; ?>">
					<input  class="lumise_submit" type="submit" name="search_font" value="<?php echo $lumise->lang('Search'); ?>">
					<?php $lumise->securityFrom();?>

				</form>
			</div>
		</div>
		<?php if ( isset($fonts['total_count']) && $fonts['total_count'] > 0) { ?>
			<div class="lumise_wrap_table">
				<table class="lumise_table lumise_fonts">
					<thead>
						<tr>
							<th class="lumise_check">
								<div class="lumise_checkbox">
									<input type="checkbox" id="check_all">
									<label for="check_all"><em class="check"></em></label>
								</div>
							</th>
							<th><?php echo $lumise->lang('Name'); ?></th>
							<th><?php echo $lumise->lang('Preview'); ?></th>
							<th><?php echo $lumise->lang('Status'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php

							if ( is_array($fonts['rows']) && count($fonts['rows']) > 0 ) {

								foreach ($fonts['rows'] as $value) { ?>

									<tr>
										<td class="lumise_check">
											<div class="lumise_checkbox">
												<input type="checkbox" name="checked[]" class="action_check" value="<?php if(isset($value['id'])) echo $value['id']; ?>" class="action" id="<?php if(isset($value['id'])) echo $value['id']; ?>">
												<label for="<?php if(isset($value['id'])) echo $value['id']; ?>"><em class="check"></em></label>
											</div>
										</td>
										<td>
											<a href="<?php
												echo $lumise->cfg->admin_url;?>nevnes-page=font&id=<?php
													echo (isset($value['id']) ? $value['id'] : '');
												?>" class="name">
												<?php if(isset($value['name'])) echo $value['name']; ?>
											</a>
										</td>
										<td>
										<?php
											if(isset($value['upload'])) {
											$id = $lumise->generate_id();
										?>
											<h3 id="<?php echo $id; ?>"><?php
												echo (isset($value['name']) ? $value['name'] : 'Font Preview');
											?></h3>
											<script type="text/javascript">
												jQuery(document).ready(function() {
													lumise_font_preview(
														"<?php echo $id; ?>",
														"url(<?php echo $lumise->cfg->upload_url.str_replace(TS, '/', $value['upload']); ?>)",
														"#<?php echo $id; ?>");
												});
											</script>
										<?php } ?></td>
										<td>
											<a href="#" class="lumise_action" data-type="fonts" data-action="switch_active" data-status="<?php echo (isset($value['active']) ? $value['active'] : '0'); ?>" data-id="<?php if(isset($value['id'])) echo $value['id'] ?>">
												<?php
													if (isset($value['active'])) {
														if ($value['active'] == 1) {
															echo '<em class="pub">'.$lumise->lang('active').'</em>';
														} else {
															echo '<em class="un pub">'.$lumise->lang('deactive').'</em>';
														}
													}
												?>
											</a>
										</td>
									</tr>

								<?php }

							}

						?>
					</tbody>
				</table>
			</div>
			
			<div class="lumise_pagination"><?php echo $lumise_pagination->pagination_html(); ?></div>

		<?php } else {
					if (isset($total_record) && $total_record > 0) {
						echo '<p class="no-data">'.$lumise->lang('Apologies, but no results were found.').'</p>';
						$_SESSION[$prefix.'data_search'] = '';
						echo '<a href="'.$lumise->cfg->admin_url.'nevnes-page=fonts" class="btn-back"><i class="fa fa-reply" aria-hidden="true"></i>'.$lumise->lang('Back To Lists').'</a>';
					}
					else
						echo '<p class="no-data">'.$lumise->lang('No data. Please add font.').'</p>';
			}?>

	</div>

</div>
