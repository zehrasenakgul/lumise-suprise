<?php
require('autoload.php');
global $lumise, $lumise_helper;

$data = $lumise->connector->get_session('lumise_cart');
$items = isset($data['items']) ? $data['items'] : array();
$fields = array(
    array('email', 'Billing E-Mail'),
    array('address', 'Street Address'),
    array('zip', 'Zip Code'),
    array('city', 'City'),
    array('country', 'Country')
);

$lumise_helper->process_cart();
$page_title = 'Shopping Cart';


include(theme('header.php'));
?>
        <main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
                <h1><?php echo $lumise->lang('Shopping Cart'); ?></h1>
      </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Shop</a></li>
          <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
      </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
      <div class="cart">
        <div class="container">
          <div class="row">
            <div class="col-lg-9">
              <table class="table table-cart table-mobile">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                <?php
                    $total = 0;
                    $index = 0;
                    foreach($items as $item):
                    
                        $cart_data = $lumise->lib->get_cart_item_file($item['file']);
                        $meta = $lumise->lib->cart_meta($cart_data);
                        $item = array_merge($item, $cart_data);
                        
                    ?>
                    <tr>
                        <td class="product-col">
                            <div class="product">
                                <figure class="product-media">
                                <a href="#">
                                    <?php
                                    if(count($item['screenshots'])> 0):
                                        foreach($item['screenshots'] as $image):?>
                                            <img width="150" src="<?php echo $lumise->cfg->upload_url.$image; ?>" />
                                        <?php endforeach;
                                    endif;
                                    ?>
                                </a>
                                </figure>

                                <h3 class="product-title">
                                <a href="#"><?php echo $item['product_name'];?></a>
                                </h3><!-- End .product-title -->
                            </div><!-- End .product -->
                        </td>
                        <td><?php echo $item['qty'];?></td>
                        <td class="price-col"><?php echo $lumise->lib->price($item['price']['total']);?> <?php $total += $item['price']['total'];?></td>
                        <td class="action">
                            <?php if(false === $item['template']):?>
                                <a href="<?php echo $lumise->cfg->tool_url;?>?product_base=<?php echo $item['product_id'];?>&cart=<?php echo $item['cart_id'];?>" class="edit"><?php echo $lumise->lang('Edit'); ?></a>
                            <?php endif;?>
                                <a data-cartid="<?php echo $item['cart_id'];?>" data-action="remove" href="<?php echo $lumise->cfg->url;?>cart.php?action=remove&item=<?php echo $item['cart_id'];?>" class="remove"><?php echo $lumise->lang('Remove'); ?></a>
                        </td>
                    </tr>
                    <?php 
                    $index++;
                    endforeach;
                    ?>
                    
                </tbody>
              </table><!-- End .table table-wishlist -->

              
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3">
              <div class="summary summary-cart">
                <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                <table class="table table-summary">
                  <tbody>
                    
                    <tr class="summary-subtotal">
                      <td>Subtotal:</td>
                      <td><?php echo $lumise->lib->price($total);?></td>


                    <tr class="summary-total">
                      <td><strong><?php echo $lumise->lang('Total'); ?></strong></td>
                      <td><?php echo $lumise->lib->price($total);?></td>
                    </tr><!-- End .summary-total -->
                  </tbody>
                </table><!-- End .table table-summary -->
                <a href="<?php echo $lumise->cfg->url;?>checkout.php" class="btn btn-outline-primary-2 btn-order btn-block"> <?php echo $lumise->lang('Proceed To Checkout'); ?></a>
              </div><!-- End .summary -->

              <a href="<?php echo $lumise->cfg->url;?>" class="btn btn-outline-dark-2 btn-block mb-3"><span><?php echo $lumise->lang('Continue Shopping'); ?></span><i
                  class="icon-refresh"></i></a>

            </aside><!-- End .col-lg-3 -->
          </div><!-- End .row -->
        </div><!-- End .container -->
      </div><!-- End .cart -->
    </div><!-- End .page-content -->
  </main><!-- End .main -->
        
        
<script type="text/javascript">
(function($) {
    $('[data-action="remove"]').click(function(){
        var data = $(this).attr('data-cartid');

        var items = JSON.parse(localStorage.getItem('LUMISE-CART-DATA'));
        delete items[data];
        localStorage.setItem('LUMISE-CART-DATA', JSON.stringify(items));

    });
})(jQuery);
</script>
<?php
include(theme('footer.php'));
$lumise->connector->set_session('lumise_cart', $data);
