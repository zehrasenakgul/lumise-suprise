<?php
require('autoload.php');
global $lumise;

$data = $lumise->connector->get_session('lumise_cart');
$items = isset($data['items']) ? $data['items'] : array();
$fields = array(
    array('email', 'Billing E-Mail'),
    array('address', 'Street Address'),
    array('zip', 'Zip Code'),
    array('city', 'City'),
    array('country', 'Country')
);

$page_title = $lumise->lang('Checkout');
include(theme('header.php'));
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
        <h1 class="page-title">Checkout<span>Shop</span></h1>
      </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Shop</a></li>
          <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
      </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
      <div class="checkout">
        <div class="container">
        <?php if(count($items) > 0):?>
          <form action="<?php echo $lumise->cfg->url;?>process_checkout.php" method="post" class="form-horizontal" id="checkoutform" accept-charset="utf-8">
            <div class="row">
              <div class="col-lg-9">
                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                <div class="row">
                  <div class="col-sm-6">
                    <label>First Name *</label>
                    
                    <input name="first_name" type="text" class="form-control" value="" placeholder="Katie" id="first_name" required>
                  </div><!-- End .col-sm-6 -->

                  <div class="col-sm-6">
                    <label>Last Name *</label>
                    <input name="last_name" class="form-control" type="text" value="" placeholder="King" id="last_name" required>
                  </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->

                
                <div class="control-group span6">
                    <label for="country" class="control-label"><?php echo $lumise->lang('Country'); ?><em>*</em></label>
                    <div class="controls">
                        <select class="form-control" name="country" id="country" required>
                            <option value=""><?php echo $lumise->lang('Country'); ?></option>
                            <option value="AR">Argentina</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BR">Brazil</option>
                            <option value="BG">Bulgaria</option>
                            <option value="CA">Canada</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CO">Colombia</option>
                            <option value="CR">Costa Rica</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EG">Egypt</option>
                            <option value="EE">Estonia</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="HK">Hong Kong S.A.R., China</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Laos</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MK">Macedonia</option>
                            <option value="MY">Malaysia</option>
                            <option value="MT">Malta</option>
                            <option value="MX">Mexico</option>
                            <option value="MD">Moldova</option>
                            <option value="MC">Monaco</option>
                            <option value="ME">Montenegro</option>
                            <option value="MA">Morocco</option>
                            <option value="NL">Netherlands</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="KP">North Korea</option>
                            <option value="NO">Norway</option>
                            <option value="PK">Pakistan</option>
                            <option value="PS">Palestinian Territory</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russia</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="RS">Serbia</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="ZA">South Africa</option>
                            <option value="KR">South Korea</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="TW">Taiwan</option>
                            <option value="TH">Thailand</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">USA</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VN">Vietnam</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                                <label for="email" class="control-label"><?php echo $lumise->lang('Billing E-Mail'); ?><em>*</em></label>
                                <div class="controls">
                                    <input name="email" class="form-control" type="email" value="" id="email" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="address" class="control-label"><?php echo $lumise->lang('Street Address'); ?><em>*</em></label>
                                <div class="controls">
                                    <input name="address" class="form-control" placeholder="229 Broadway" type="text" value="" id="address" required>
                                </div>
                            </div>
                            <div class="control-group span6">
                                <label for="zip" class="control-label"><?php echo $lumise->lang('Zip Code'); ?><em>*</em></label>
                                <div class="controls">
                                    <input name="zip" class="form-control" type="text" value="" id="zip" required>
                                </div>
                            </div>
                            <div class="control-group span6 last">
                                <label for="city" class="control-label"><?php echo $lumise->lang('City'); ?><em>*</em></label>
                                <div class="controls">
                                    <input name="city" class="form-control" type="text" placeholder="New York" value="" id="city" required>
                                </div>
                            </div>
                            <div class="control-group span6 last">
                                <label for="phone" class="control-label"><?php echo $lumise->lang('Phone'); ?><em>*</em></label>
                                <div class="controls">
                                    <input class="form-control" name="phone" type="text" value="" id="phone" required>
                                </div>
                            </div>
              </div><!-- End .col-lg-9 -->
              <aside class="col-lg-3">
                <div class="summary">
                  <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                  <table class="table table-summary">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Total</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                        $total = 0;
                        foreach($items as $item):
                        
                            $cart_data = $lumise->lib->get_cart_item_file($item['file']);
                            $meta = $lumise->lib->cart_meta($cart_data);
                            $item = array_merge($item, $cart_data);
                        
                            ?>
                        <tr>
                            <td><?php echo $item['product_name'];?></td>
                            <td>
                                <?php

                                if(count($item['screenshots'])> 0):
                                    foreach($item['screenshots'] as $image):?>
                                        <img width="150" src="<?php echo $lumise->cfg->upload_url.$image; ?>" />
                                    <?php endforeach;
                                endif;
                                ?>
                            </td>
                            <td class="text-right"><?php echo $lumise->lib->price($item['price']['total']);?><?php $total += $item['price']['total'];?></td>
                        </tr>
                        <?php endforeach;?>
                      
                    </tbody>
                  </table><!-- End .table table-summary -->

                  <div class="accordion-summary" id="accordion-payment">
                    <div class="card">
                    <div class="controls">
                            <div class="lumise-payment-item">
                                <input name="payment" type="radio" value="cod" id="payment-cod" required>
                                <label for="payment-cod"><?php echo $lumise->lang('Cash on delivery'); ?></label>
                            </div>
                            <div class="lumise-payment-item">
                                <input name="payment" type="radio" value="paypal" id="payment-paypal" required>
                                <label for="payment-paypal"><?php echo $lumise->lang('Paypal'); ?></label>
                            </div>
                            <label for="payment" class="error"></label>
                        </div>
                

                    <div class="">
                            <label for="comment" class="control-label"><?php echo $lumise->lang('Comments'); ?></label>
                            <div class="controls">
                                <textarea class="form-control d-block" name="comment" type="text" value="" id="comment"></textarea>
                            </div>
                        </div>
                    
                  </div><!-- End .accordion -->

                  <input type="hidden" name="action" value="placeorder">
                  <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                    <span class="btn-text">Place Order</span>
                    <span class="btn-hover-text">Proceed to Checkout</span>
                  </button>
                </div><!-- End .summary -->
              </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
          </form>
          <?php else:?>
            <div class="span12">
                <p><?php echo $lumise->lang('Your cart is currently empty.'); ?></p>
            </div>
            <div class="form-actions">
                <a href="<?php echo $lumise->cfg->url;?>" class="btn btn-large btn-primary"><?php echo $lumise->lang('Continue Shopping'); ?></a>
            </div>
        <?php endif;?>
        </div><!-- End .container -->
      </div><!-- End .checkout -->
    </div><!-- End .page-content -->
  </main><!-- End .main -->
        
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#checkoutform").validate();
        });
        </script>
<?php
include(theme('footer.php'));
//update cart info
if(!isset($grand_total)){
    $grand_total = 0;
}
$data['total'] = $grand_total;
$lumise->connector->set_session('lumise_cart', $data);
