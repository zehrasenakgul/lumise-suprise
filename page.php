<?php

require('autoload.php');

global $lumise_admin, $lumise, $wpdb;

if (isset($_POST['set_page'])) {
    delete_all_rows('pages');
    $activeLang = "en";
    foreach ($_POST['data'] as $page) {
        $newData = [
            "text" => $page['text'],
            "href" => $page['href'],
            "content" => $page['content'],
            "language_code" => $activeLang,
        ];
        $id = add_row($newData, 'pages');
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

$db = $lumise->get_db();
$slug = $_GET['slug'];

$query = "SELECT * FROM lumise_pages WHERE href = ?";
$data = $db->rawQuery($query, array($slug));

include(theme('header.php'));
?>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container-fluid d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#"><?= $data[0]['text'] ?></a></li>
            </ol>


        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            if (!empty($data)) { ?>
                                <p><?php echo $data[0]['content'] ?></p>
                            <?php
                            } else {
                                echo "Sayfa bulunamadı.";
                            }

                            ?>
                        </div><!-- End .row -->
                    </div><!-- End .col-md-8 -->

                </div><!-- End .row -->

            </div><!-- End .product-details-top -->


        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php include(theme('footer.php')); ?>