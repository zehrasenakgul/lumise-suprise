<?php

require('autoload.php');
global $lumise;

$id = isset($_GET['product_id']) ? $_GET['product_id'] : '1';
$value = $lumise->lib->get_row_id($id, 'products');
$orderby  = 'name';
$ordering = 'desc';
$dt_order = 'name_asc';
$current_page = isset($_GET['tpage']) ? $_GET['tpage'] : 1;

$search_filter = array(
    'keyword' => '',
    'fields' => 'name'
);

$default_filter = array(
    'type' => '',
);
$per_page = 4;
$start = ($current_page - 1) * $per_page;
$data = $lumise->lib->get_rows('products', $search_filter, $orderby, $ordering, $per_page, $start, array('active' => 1), '');
$thumbnail_url = 'https://demo.lumise.com/assets/images/not-found.jpg';
if (!empty($value['thumbnail_url']))
    $thumbnail_url = $value['thumbnail_url'];

$page_title = isset($value['name']) ? $value['name'] : 'Product Details';

$has_template = $lumise_helper->has_template($value);

$db = $lumise->get_db();
$product_id = $_GET['product_id'];

$query = "SELECT * FROM lumise_comments WHERE product_id = ?";
$comments = $db->rawQuery($query, array($product_id));

include(theme('header.php'));
?>

<style>
    .rating {
        display: inline-block;
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
    }

    .star {
        display: none;
    }

    .star+label {
        font-size: 30px;
        color: #ccc;
        transition: color 0.3s ease-in-out;
        cursor: pointer;
    }

    .star:checked+label:before {
        content: '\2605';
        color: #deac6e;
    }

    .star+label:before {
        content: '\2606';
    }
</style>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container-fluid d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $value['name'] ?></li>
            </ol>


        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-8">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="<?php echo $thumbnail_url; ?>" data-zoom-image="<?php echo $thumbnail_url; ?>" alt="product image">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery ">
                                    <a class="product-gallery-item active" href="#" data-image="assets/images/products/single/1.jpg" data-zoom-image="assets/images/products/single/1-big.jpg">
                                        <img src="assets/images/products/single/1-small.jpg" alt="product side">
                                    </a>

                                    <a class="product-gallery-item" href="#" data-image="assets/images/products/single/2.jpg" data-zoom-image="assets/images/products/single/2-big.jpg">
                                        <img src="assets/images/products/single/2-small.jpg" alt="product cross">
                                    </a>

                                    <a class="product-gallery-item" href="#" data-image="assets/images/products/single/3.jpg" data-zoom-image="assets/images/products/single/3-big.jpg">
                                        <img src="assets/images/products/single/3-small.jpg" alt="product with model">
                                    </a>

                                    <a class="product-gallery-item" href="#" data-image="assets/images/products/single/4.jpg" data-zoom-image="assets/images/products/single/4-big.jpg">
                                        <img src="assets/images/products/single/4-small.jpg" alt="product back">
                                    </a>
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-8 -->

                    <div class="col-md-4">
                        <div class="row">
                            <div class="product-details" style="border: 1px solid #21201f1a; padding: 32px; border-radius: 18px;width: 100%;">
                                <?php if (isset($value['name'])) echo '<h1 class="product-title">' . $value['name'] . '</h1>'; ?>
                                <!-- End .product-title -->

                                <div class="ratingsx-container">
                                    <div class="ratingsx">
                                        <div class="ratingsx-val" style="width: 80%;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                            </svg>

                                        </div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <a class="ratings-text" href="#product-review-link" id="review-link">406 Beurteilungen</a>
                                </div><!-- End .rating-container -->
                                <div class="deliveryStatus">
                                    <div class="deliveryStatus__info">
                                        <div class="deliveryStatus__icon">
                                            <span class="uspIcons" style="display: flex;">
                                                <svg style="fill: #5c815e;padding-top: 10px;width: 24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                                                </svg>

                                                <p>Vor 16:00 bestellt, Lieferung am Montag!</p>
                                            </span>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-auto detail-button-title">
                                    <p class="fw-bold">Sorte:</p>
                                </div>
                                <div class="product-choise col-auto">
                                    <div class="btn-group detail-buttons" role="group">
                                        <button type="button" class="btn active" data-value="100" style="align-items: center;
                                                    border: 1px solid #21201f1a;
                                                    border-left-color: #0000;
                                                    border-radius: initial;
                                                    cursor: pointer;
                                                    display: flex;
                                                    flex: 1;
                                                    flex-direction: column;
                                                    flex-wrap: wrap;
                                                    justify-content: center;
                                                    line-height: 1.2;
                                                    padding: 16px;
                                                    text-align: center;
                                                    transition: background .3s,color .3s;
                                                    padding: 24px 16px;
                                                    border: 1px solid #2b2118;
                                                    color: #554c44;
                                                    cursor: default;
                                                    border-radius: 8px 0 0 8px;
                                                    font-weight: bold;
                                                    font-size: 20px;">
                                            Postkarte
                                            <span style="color: #554c44;font-size: 11px;margin-left: 0;margin-top: 4px;font-weight: normal;margin-top:8px">(16,11 €)</span>
                                        </button>
                                        <button type="button" class="btn active" data-value="100" style="align-items: center;
                                                border: 1px solid #21201f1a;
                                                border-left-color: #0000;
                                                border-radius: initial;
                                                cursor: pointer;
                                                display: flex;
                                                flex: 1;
                                                flex-direction: column;
                                                flex-wrap: wrap;
                                                justify-content: center;
                                                line-height: 1.2;
                                                padding: 16px;
                                                text-align: center;
                                                transition: background .3s,color .3s;
                                                padding: 24px 16px;
                                                color: #554c44;
                                                cursor: default;
                                                border-radius: 0 8px 8px 0;
                                                font-weight: bold;
                                                font-size: 20px;">
                                            Personalisierte Banderole
                                            <span style="color: #554c44;font-size: 13px;margin-left: 0;margin-top: 4px;font-weight: normal;margin-top:8px">(16,11 €)</span>
                                        </button>

                                    </div>

                                </div>
                                <br>
                                <div class="col-lg-6">
                                    <div class="article-price"><span class="article-price__total">
                                            <?php if (isset($value['price'])) echo $lumise->lib->price($value['price']); ?>
                                        </span>
                                        <div><a rel="nofollow" class="fancybox-iframe" href="#">
                                                <div class="article-price__shipping js-shippingCosts">inkl. MwSt., zzgl. 4,95 € Versandkosten (mit Sendungsverfolgung)</div>
                                            </a></div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-12" style="text-align: center; max-width: 100%; display: flex; justify-content: center;">
                                    <a href="<?php echo $lumise->cfg->tool_url . '?product_base=' . $value['id']; ?>" class="newsletter-button button button--primary button--fluid js-newsletter-submit" type="submit" style="width: 100%; height: 100%;text-align: center; display: flex; justify-content: center; ">
                                        <span>Start Personalising</span>
                                    </a>
                                </div>

                                <div class="product-details-footer">


                                </div><!-- End .product-details-footer -->

                            </div><!-- End .product-details -->
                            <div class="" style="border: 1px solid #21201f1a;width: 100%; padding: 32px; border-radius: 18px;">
                                <div class="product-detail-bottom-text-title">
                                    <p>WÃ¤hle im Warenkorb die gewÃ¼nschte Lieferung</p>
                                    <div class="first-open-area">
                                        <div class="row">
                                            <div class="col-md-6 price-text-bottom-field">
                                                <p>Standard delivery</p>
                                                <span>4,95 â‚¬</span>
                                            </div>
                                            <div class="col-md-6 price-text-bottom-field">
                                                <p>Pick-up point</p>
                                                <span>4,95 â‚¬</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="second-open-area d-none">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="image col-md-3">
                                                        <img src="assets/images/delivery.svg" alt="">
                                                        <span>Standard</span>
                                                    </div>
                                                    <div class="text col-md-6">
                                                        Vor 16:00 bestellt, Lieferung am Montag!
                                                        Mit Sendungsverfolgung geliefert durch DHL Parcel connect
                                                    </div>
                                                    <div class="image col-md-3">
                                                        <span>4,95 â‚¬</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="image col-md-3">
                                                        <img src="assets/images/pick-up.svg" alt="">
                                                        <span>Standard</span>
                                                    </div>
                                                    <div class="text col-md-6">
                                                        Vor 13:00 bestellt, Abholen zwischen Dienstag und Mittwoch!
                                                        Mit Sendungsverfolgung geliefert durch UPS - Standard pickup service
                                                    </div>
                                                    <div class="image col-md-3">
                                                        <span>4,95 â‚¬</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="open-bottom-detail-area-text" style="padding-top: 24px;">
                                        <span>Mehr lesen</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .col-md-4 -->

                </div><!-- End .row -->

            </div><!-- End .product-details-top -->


            <div class="similar-products-detail">
                <h2>Das könnte dir auch gefallen</h2>
                <div class="items">
                    <div class="row">
                        <?php LumiseView::products($data['rows']); ?>
                    </div>
                </div>
            </div>
            <div class="product-detail-properties">
                <div class="deliveryStatus">
                    <div class="row">
                        <div class="deliveryStatus__info col-md-4">
                            <div class="deliveryStatus__icon">
                                <span class="uspIcons" style="display: flex;">
                                    <svg style="fill: #5c815e;padding-top: 10px;width: 24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                                    </svg>

                                    <p>Lieferung an Wunschadresse</p>
                                </span>
                            </div>

                        </div>
                        <div class="deliveryStatus__info col-md-4">
                            <div class="deliveryStatus__icon">
                                <span class="uspIcons" style="display: flex;">
                                    <svg style="fill: #5c815e;padding-top: 10px;width: 24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                                    </svg>

                                    <p>Gratis Geschenkkarte & ansprechende Verpackung</p>
                                </span>
                            </div>

                        </div>
                        <div class="deliveryStatus__info col-md-4">
                            <div class="deliveryStatus__icon">
                                <span class="uspIcons" style="display: flex;">
                                    <svg style="fill: #5c815e;padding-top: 10px;width: 24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                                    </svg>

                                    <p>100%-ige Zufriedenheitsgarantie</p>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="comments">
                <div class="comments-title">
                    <h4>Bewertungen</h4>
                    <div class="comments-area">
                        <?php
                        // Yorumları listeleme döngüsü
                        foreach ($comments as $comment) {
                            $author = $comment['name']; // Yorum yazarı
                            $datetime = $comment['created_at']; // Yorum tarihi
                            $content = $comment['comment']; // Yorum içeriği
                            $date = date('d-m-Y', strtotime($datetime)); // Tarihi almak için formatı d-m-Y olarak ayarla

                        ?>

                            <div class="commentx">
                                <div class="comment-author">
                                    <span><?php echo $author ?></span>
                                    <span>•</span>
                                    <span><?php echo $date ?></span>
                                </div>
                                <div class="comment-content">
                                    <?php echo $content ?>
                                </div>
                            </div>

                        <?php
                        } ?>
                    </div>
                    <form action="add_comment.php" method="POST" class="mt-5">
                        <input type="hidden" name="product_id" value="<?= $value['id'] ?>">
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                        <input type="email" class="form-control" name="email" placeholder="E-Mail" required>
                        <textarea name="comment" class="form-control" placeholder="Your Comment" required></textarea>
                        <button type="submit" class="newsletter-button button button--primary button--fluid js-newsletter-submit">Send</button>
                    </form>



                </div>
            </div>
            <!-- End .tab-content -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->



<?php include(theme('footer.php')); ?>