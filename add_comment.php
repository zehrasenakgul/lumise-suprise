<?php

require('autoload.php');

global $lumise_admin, $lumise, $wpdb;

$productID = $_POST['product_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];

$data = [
    'product_id' => $productID,
    'name' => $name,
    'email' => $email,
    'comment' => $comment
];

$db = $lumise->get_db();
$db->insert('comments', $data);

header("Location: https://zadevelopment.com.tr/product.php?product_id=" . $productID);
exit();
