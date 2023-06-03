<?php 

require('autoload.php');

global $lumise_admin,$lumise,$wpdb;


if(isset($_POST['set_menu'])){
    delete_all_rows('menus');
    $activeLang = $lumise->connector->get_session('lumise-active-lang');
    foreach($_POST['data'] as $menu){
        $newData = [
            "title" => $menu['title'],
            "text" => $menu['text'],
            "href" => $menu['href'],
            "icon" => $menu['icon'],
            "target" => $menu['target'],
            "language_code" => $activeLang,
        ];

        $id =add_row( $newData, 'menus' );

        if(isset($menu['children'])){
            foreach($menu['children'] as $children1){
                $newData1 = [
                    "title" => $children1['title'],
                    "text" => $children1['text'],
                    "href" => $children1['href'],
                    "icon" => $children1['icon'],
                    "target" => $children1['target'],
                    "parent_id" => $id
                ];
                
                $id2 =add_row( $newData1, 'menus' );
                if(isset($children1['children'])){
                    foreach($children1['children'] as $children2){
                        $newData2 = [
                            "title" => $children2['title'],
                            "text" => $children2['text'],
                            "href" => $children2['href'],
                            "icon" => $children2['icon'],
                            "target" => $children2['target'],
                            "parent_id" => $id2
                        ];
                        add_row( $newData2, 'menus' );
                    }
                }
            }
        }
    }
}else{
    if(isset($_GET['get_categories'])){
        $activeLang = $lumise->connector->get_session('lumise-active-lang');
        $orderby  = '';
        $ordering = 'asc';
        $dt_order = 'name_asc';
        $current_page = isset($_GET['tpage']) ? $_GET['tpage'] : 1;
    
        $search_filter = array(
            'keyword' => '',
            'fields' => 'name'
        );
    
        $default_filter = array(
            'type' => '',
        );
        $per_page = 8;
        $start = ( $current_page - 1 ) * $per_page;
        $data = $lumise->lib->get_rows_without_author('categories', $search_filter, $orderby, $ordering, $per_page, $start, array(), '');
        
    	$db = $lumise->get_db();
        $query = "SELECT * FROM " . "lumise_categories  WHERE name LIKE '%".$_GET['category_name']."%'";
		$data =  $db->rawQuery($query);
       
        echo json_encode($data);
    }else{
        $activeLang = $lumise->connector->get_session('lumise-active-lang');
        $orderby  = '';
        $ordering = 'asc';
        $dt_order = 'name_asc';
        $current_page = isset($_GET['tpage']) ? $_GET['tpage'] : 1;
    
        $search_filter = array(
            'keyword' => '',
            'fields' => 'name'
        );
    
        $default_filter = array(
            'type' => '',
        );
        $per_page = 8;
        $start = ( $current_page - 1 ) * $per_page;
        $data = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id'=>"0","language_code"=>$activeLang), '');
        foreach( $data['rows'] as $key=> $item){
            
            $data2 = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id'=>"".$item['id'].""), '');
    
            if($data2['rows']){
                $data['rows'][$key]['children'] = $data2['rows'];
            }
    
            foreach($data2['rows'] as $key2 => $item2){
                $data3 = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id'=>"".$item2['id'].""), '');
    
                if($data3['rows']){
                    $data['rows'][$key]['children'][$key2]['children'] = $data3['rows'];
                }
            }
        }
        echo json_encode($data);
    }
}


function add_row( $data, $tb_name ) {

    global $lumise;
    
    $db = $lumise->get_db();
    
    $id = $db->insert($tb_name, $data);
    
    $lumise->do_action ('add_row', $id, $data, $tb_name);
    
    return $id;

}

function delete_all_rows( $tb_name) {

    global $lumise;
    
    $lumise->do_action ('delete_row', $tb_name);
    
    $db = $lumise->get_db();
    
	$db->where('language_code', $lumise->connector->get_session('lumise-active-lang'));
    $id = $db->delete($tb_name);
    
    return $id;

}
