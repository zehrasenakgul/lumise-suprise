<?php

require('autoload.php');

global $lumise_admin, $lumise, $wpdb;

if (isset($_POST['set_page_id'])) {
    $activeLang = "en";
    foreach ($_POST['data'] as $page) {
        $db = $lumise->get_db();
        $pageSlug = $page['slug'];

        $query = "SELECT * FROM lumise_pages WHERE href = ?";
        $data = $db->rawQuery($query, array($pageSlug));

        if (!empty($data)) {
            $newData = [
                "target" => $page['target'],
                "href" => $page['slug'],
                "title" => $page['text'],
                "section" => $page['section'],
                "page_id" => $data[0]['id']
            ];
            $id = add_row($newData, 'footer_menus');
        }
    }
} else {
    if (isset($_GET['get_pages'])) {
        $orderby  = '';
        $ordering = 'asc';
        $dt_order = 'text_asc';
        $current_page = isset($_GET['tpage']) ? $_GET['tpage'] : 1;

        $search_filter = array(
            'keyword' => '',
            'fields' => 'text'
        );

        $default_filter = array(
            'type' => '',
        );
        $per_page = 8;
        $start = ($current_page - 1) * $per_page;
        $data = $lumise->lib->get_rows_without_author('pages', $search_filter, $orderby, $ordering, $per_page, $start, array(), '');

        $db = $lumise->get_db();
        $query = "SELECT * FROM " . "lumise_pages WHERE text LIKE '%" . $_GET['page_name'] . "%'";

        $data =  $db->rawQuery($query);

        echo json_encode($data);
    } else {
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
        $start = ($current_page - 1) * $per_page;
        $data = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id' => "0", "language_code" => $activeLang), '');
        foreach ($data['rows'] as $key => $item) {

            $data2 = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id' => "" . $item['id'] . ""), '');

            if ($data2['rows']) {
                $data['rows'][$key]['children'] = $data2['rows'];
            }

            foreach ($data2['rows'] as $key2 => $item2) {
                $data3 = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id' => "" . $item2['id'] . ""), '');

                if ($data3['rows']) {
                    $data['rows'][$key]['children'][$key2]['children'] = $data3['rows'];
                }
            }
        }
        echo json_encode($data);
    }
}



function add_row($data, $tb_name)
{

    global $lumise;

    $db = $lumise->get_db();

    $id = $db->insert($tb_name, $data);

    $lumise->do_action('add_row', $id, $data, $tb_name);

    return $id;
}

function delete_all_rows($tb_name)
{

    global $lumise;

    $lumise->do_action('delete_row', $tb_name);

    $db = $lumise->get_db();

    $db->where('language_code', $lumise->connector->get_session('lumise-active-lang'));
    $id = $db->delete($tb_name);

    return $id;
}
