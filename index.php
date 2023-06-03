<?php
	
require('autoload.php');

global $lumise;

$orderby  = '`order`';
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
$data = $lumise->lib->get_rows('products', $search_filter, $orderby, $ordering, $per_page, $start, array('active'=> 1), '');

include(theme('header.php'));

?>
        <div style="background-color:#fcf8f4">
    <br>
  </div>
  <main class="main">
    <div class="banner-group">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 banner-left col-lg-6" style="background-color:#f5f2ee; border-radius: 5%;">

            <div class="p-5 banner-left-inner banner-content-top">

              <h3 class="banner-title"><?=$lumise->get_option('banner_1_left_title')?></h3>
              <!-- End .banner-title -->
              <div class="banner-text"><?=$lumise->get_option('banner_1_left_subtitle')?></div>
              <!-- End .banner-text -->
              <a href="product.html" class="btn  banner-link"
                style="    background-color: rgba(245, 216, 180, 0.973); border-radius: 10px;"><?=$lumise->get_option('banner_1_left_button_title')?><i
                  class="icon-long-arrow-right"></i></a>
            </div>
          </div>
          <!-- End .banner-content -->
          <div class="col-md-12 banner-right col-lg-6">
            <div class="h-100 banner banner-large banner-overlay banner-overlay-light" style="border-radius: 10px;">
              <a href="#" class="h-100">
                <img class="banner-right-img" style="border-radius: 10px;" src="<?=$lumise->cfg->upload_url.$lumise->get_option('banner_1_right_button_image')?>" alt="Banner" />
              </a>

            </div>
            <!-- End .banner -->
          </div>
          <!-- End .col-lg-5 -->

        </div>
        <!-- End .row -->
      </div>
      <!-- End .container -->
    </div>
    <div class="mb-3"></div>
    <!-- End .mb-6 -->

    <br>
    <!-- End .banner-group -->
        <!-- <?php // LumiseView::categories(); ?>  -->
        <div class="container-fluid">
            <div class="heading heading-center mb-3">
                <h1 class="title"><?=$lumise->get_option('dashboard_2_title')?></h1>
                <!-- End .title -->
            </div>
            <!-- End .heading -->
            <br>
            <div class="tab-content">
                <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    <div class="row justify-content-center">
                        <?php LumiseView::products($data['rows']); ?>
                    </div>
            <!-- End .row -->
          </div>
          <!-- End .products -->
        </div>
        <!-- .End .tab-pane -->
        <!-- <div class="tab-pane p-0 fade" id="top-fur-tab" role="tabpanel" aria-labelledby="top-fur-link">
          <div class="products">
            <div class="row justify-content-center">
              <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                <div class="product product-11 text-center" style="border-radius: 10px;">
                  <figure class="product-media">
                    <span class="product-label label-circle label-sale">Sale</span>
                    <a href="product.html">
                      <img src="assets/images/demos/demo-2/products/product-9-1.jpg" alt="Product image"
                        class="product-image" />
                      <img src="assets/images/demos/demo-2/products/product-9-2.jpg" alt="Product image"
                        class="product-image-hover" />
                    </a>

                    <div class="product-action-vertical">
                      <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                    </div>
                  </figure>

                  <div class="product-body">
                    <div class="product-cat">
                      <a href="#">Furniture</a>
                    </div>
                    <h3 class="product-title">
                      <a href="product.html">Garden Armchair</a>
                    </h3>
                    <div class="product-price">
                      <span class="new-price">$94,00</span>
                      <span class="old-price">Was $94,00</span>
                    </div>
                  </div>

                </div>
              </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
      <!-- End .container -->

      <div class="container-fluid">
        <hr class="mt-1 mb-6" />
      </div>
      <!-- End .container -->
      <br>
      <div class="banner-group">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 banner-left col-lg-6" style="background-color:#f5f2ee; border-radius: 5%;">

              <div class="p-5 banner-left-inner banner-content-top">
                <div class="heading text-center as-card-left-title">
                  <h3 class="title"><?=$lumise->get_option('banner_3_left_title')?></h3>
                  <!-- End .title -->
                  <p class="title-desc">
                    <?=$lumise->get_option('banner_3_left_subtitle')?>
                  </p>
                  <div class="newsletter-form-row">
                    <div class="col-md-9">

                      <input type="email" required="" placeholder="<?=$lumise->get_option('banner_3_left_input_text')?>" name="email"
                        class="newsletter-input js-email-address">
                    </div>
                    <div class="col-md-3" style="max-width: 100%; max-height: 100%;">

                      <button class="newsletter-button button button--primary button--fluid js-newsletter-submit"
                        type="submit" style="width: 100%; height: 100%;">
                        <span><?=$lumise->get_option('banner_3_left_button_title')?></span>
                      </button>
                    </div>
                  </div>
                  <!-- End .title-desc -->
                </div>
                <!-- End .heading -->
              </div>
            </div>
            <!-- End .banner-content -->
            <div class="col-md-12 banner-right col-lg-6">
              <div class="banner banner-large banner-overlay banner-overlay-light" style="border-radius: 10px;">
                <a href="#">
                  <img style="border-radius: 10px;" src="<?=$lumise->cfg->upload_url.$lumise->get_option('banner_3_right_button_image')?>"
                    alt="Banner" />
                </a>

              </div>
              <!-- End .banner -->
            </div>
            <!-- End .col-lg-5 -->

          </div>
          <!-- End .row -->
        </div>
        <!-- End .container -->
      </div>
      <!-- End .banner-group -->

      <br>
      <div class="blog-posts">
        <div class="container-fluid">
          <h2 class="title text-center"><?=$lumise->get_option('banner_4_title')?></h2>
          <p class="text-center" style="padding-bottom: 10px;"><?=$lumise->get_option('banner_4_subtitle')?></p>
          <!-- End .title-lg text-center -->

          <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
            <article class="entry entry-display">
              <figure class="entry-media border-radius-onbes">
                <a href="">
                  <img class="border-radius-onbes" src="assets/images/demos/demo-2/blog/post-1.jpg" alt="image desc" />
                </a>
              </figure>
              <!-- End .entry-media -->

              <div class="entry-body text-center">
                <div class="entry-meta">
                  <a href="#">Nov 22, 2018</a>, 0 Comments
                </div>
                <!-- End .entry-meta -->


                <div class="entry-content">
                  <a href="" class="read-more">Continue Reading</a>
                </div>
                <!-- End .entry-content -->
              </div>
              <!-- End .entry-body -->
            </article>
            <!-- End .entry -->

            <article class="entry entry-display">
              <figure class="entry-media border-radius-onbes">
                <a href="">
                  <img class="border-radius-onbes" src="assets/images/demos/demo-2/blog/post-2.jpg" alt="image desc" />
                </a>
              </figure>
              <!-- End .entry-media -->

              <div class="entry-body text-center">
                <div class="entry-meta">
                  <a href="#">Dec 12, 2018</a>, 0 Comments
                </div>
                <!-- End .entry-meta -->


                <div class="entry-content">
                  <a href="" class="read-more">Continue Reading</a>
                </div>
                <!-- End .entry-content -->
              </div>
              <!-- End .entry-body -->
            </article>
            <!-- End .entry -->

            <article class="entry entry-display">
              <figure class="entry-media border-radius-onbes">
                <a href="">
                  <img class="border-radius-onbes" src="assets/images/demos/demo-2/blog/post-3.jpg" alt="image desc" />
                </a>
              </figure>
              <!-- End .entry-media -->

              <div class="entry-body text-center">
                <div class="entry-meta">
                  <a href="#">Dec 19, 2018</a>, 2 Comments
                </div>
                <!-- End .entry-meta -->


                <div class="entry-content">
                  <a href="" class="read-more">Continue Reading</a>
                </div>
                <!-- End .entry-content -->

              </div>
              <!-- End .entry-body -->

            </article>
            <!-- End .entry -->
          </div>
          <!-- End .owl-carousel -->


          <!-- End .more-container -->
        </div>
        <!-- End .container -->
      </div>
      <!-- End .blog-posts -->
      <br>
      <div class="banner-group">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-4">

              <div class="banner-content banner-content-top">
                <h4 class="banner-subtitle" style="color:#de896e"><?=$lumise->get_option('banner_4_left_subtitle')?></h4>
                <!-- End .banner-subtitle -->
                <h3 class="banner-title" style="font-size: 40px;"><?=$lumise->get_option('banner_4_left_title')?></h3>
                <br>
                <!-- End .banner-title -->
                <div class="banner-text">
                  <p> Stell dir den unbeschreiblichen GlÃ¼cksmoment vor, den jemand empfindet, nachdem er ein wirklich
                    persÃ¶nliches Geschenk geÃ¶ffnet hat.</p>
                  <br>
                  <p>Dieses GlÃ¼ck zu verbreiten ist unsere Leidenschaft und deshalb tun wir alles, um dir dabei zu
                    helfen,
                    jemand anderen glÃ¼cklich zu machen.</p>

                  <br>
                  <p>Ãœberrasche deine Liebsten dieses Jahr mit einem persÃ¶nlichen.</p>
                  <br>
                </div>
                <!-- End .banner-text -->

              </div>
            </div>
            <!-- End .banner-content -->
            <div class="col-md-12 col-lg-8">
              <div class="banner banner-large banner-overlay banner-overlay-light"
                style="border-radius: 15px; width: 100%; height: 100%;">

                <a href="#">
                  <img src="<?=$lumise->cfg->upload_url.$lumise->get_option('banner_4_right_image')?>" alt="Banner" style="border-radius: 15px;" />
                </a>

              </div>
              <!-- End .banner -->
            </div>
            <!-- End .col-lg-5 -->

          </div>
          <!-- End .row -->
        </div>
        <!-- End .container -->
      </div>
      <!-- End .banner-group -->
      <br>
      <hr>

      <div class="seo__text lh-lg" id="js-seoText">
        <h3>Personalized Gifts</h3>

        <p> For us, here at YourSurprise, itâ€™s important to make people happy. A gift is a sign of gratitude, a special
          moment between the recipient and the gift giver. Giving a gift is a perfect way to celebrate a moment in life
          and can be designed and created specifically for the person that is going to unwrap it. Personalising gifts is
          our mission, the thing we specialize in. If you're wondering <b> why you should give a personalised gift </b>,
          the answer is simple!
          A personalised gift is never the same as any other gift, as you create the gift yourself using your photos and
          your text. Holiday memories, photos of your family or a special message to remember forever.

          <b> How to personalise your gift? </b>
          Bringing your design idea to life easy! Different kinds of gifts have different personalisation methods, from
          engraved gifts to gifts with a photo print and embroidered gifts; we use the methods that best suit each gift
          for a high-quality result.
          You can choose from:

          If you're looking for a personalised gift, YourSurprise offers a gift for every recipient and occasion. Our
          wide
          assortment of gifts is designed to suit everyone!<p></p>



          <h3> The most original gift for any occasion </h3>
          <p> Choosing a gift for your partner, friends or family isn't always easy. Each person is unique and we know
            that you are looking to add a unique touch to their gift. Here at YourSurprise, we want to help you find the
            perfect gift for any special occasion, as well as allow you to celebrate those little moments life gives
            you.
            For example, when your best friend helped you through a tough time or when your dad picked you up at the
            airport after your summer vacation.. It's never too late to say thank you to someone just for being present
            in
            your life.
            With unique designs and gifts created specifically for each special moment, you can find an extensive range
            of
            gifts for all occasions, such aswhen you can surprise your loved ones with original personalised
            YourSurprise
            gifts. </p>

          <h3> Have your gift delivered straight to their address</h3>

          <p> There are times when, due to life circumstances, we sadly can't hug or congratulate someone who is
            celebrating a special moment in their life. On these occasions, we want to help you to be present and
            surprise
            your loved ones with
            A personalised gift, designed and created by you is appreciated all the more when it arrives at the
            recipient's home as a surprise. All you need to do is design it and we will deliver your personalised gift
            to
            the address of your choice. If you're looking for some small gifts to surprise your best friend, partner,
            mother or co-worker, check out our suggestions for small gifts that can fit in your mailbox. </p>

          <p> What started with personalised songs in an attic room has grown into the largest online gift shop for
            personalised gifts. With an assortment of over 2500 gifts, customers can always find a great surprise for
            any
            occasion.
            YourSurprise is well on its way to conquering the world! YourSurprise personal gifts are now sold in a large
            part of Europe. From personalised sweaters and engraved glasses to cookbooks and baby and children's gifts.
            Whoever you want to surprise, YourSurprise has a gift that suits the person or the unique moment. Our gifts
            are very easy to personalise with a photo and personal text. In just a few clicks, the customer can design a
            unique gift for a birthday, anniversary, special holiday such as Valentineâ€™s Day, Motherâ€™s Day, Fatherâ€™s Day
            or Christmas, or as a thank you. Made with love, always!</p>




      </div>
  </main>
<?php include(theme('footer.php')); ?>
