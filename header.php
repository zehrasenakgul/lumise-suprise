<?php 
global $lumise;
include(theme('head.php'));

if(isset($_GET['set_language'])){
  $lumise->connector->set_session('lumise-active-lang',$_GET['set_language']);
}

$activeLang = 'en';
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
    $per_page = 0;
    $start = ( $current_page - 1 ) * $per_page;
    $menuItems = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id'=>"0","language_code"=>$activeLang), '');

    $langs = $lumise->get_langs();
    $lang_map = $lumise->langs();
    
    $active_langs = array();
    $use_langs = array('en' => 'English');
    
    foreach($langs as $code) {
      if (!empty($code)) {
        $active_langs[$code] = '<img src="'.$lumise->cfg->assets_url.'assets/flags/'.$code.'.png" height="20" /> '.$lang_map[$code];
        if (is_array($lumise->cfg->settings['activate_langs']) && in_array($code, $lumise->cfg->settings['activate_langs']))
          $use_langs[$code] = $lang_map[$code];
      }
    }

?>


<div class="page-wrapper">
    <header class="header header-2 header-intro-clearance">
      <div class="header-top " style="background-color: #de896e">
        <div class="container-fluid">
          <div class="header-center ">
            <p>
              Delivered to your address of choice - Free Message card with every gift - All gifts personalised with
              photo/text

            </p>
          </div>
          <!-- End .header-left -->
        </div>
        <!-- End .container -->
      </div>
      <!-- End .header-top -->
      <div class="header-middle-center" id="navbar">

        <div class="header-middle">
          <div class="container-fluid">
            <div class="header-left">
              <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
              </button>

              <a href="<?php echo $lumise->cfg->url; ?>" class="logo">
                <img src="<?=$lumise->cfg->url.'/data/'.$lumise->get_option('logo')?>" alt="Molla Logo" width="105" height="25" />
              </a>
            </div>
            <!-- End .header-left -->



            <div class="header-center">
              <div
                class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="#" method="get">
                  <div class="header-search-wrapper search-wrapper-wide">
                    <label for="q" class="sr-only"><?php echo $lumise->lang('Search'); ?></label>
                    <input type="search" class="form-control" name="q" id="q" placeholder="<?php echo $lumise->lang('Search Product'); ?>" required
                      style="border-radius: 20px;" />
                    <button class="btn btn-primary" type="submit">
                      <i class="icon-search"></i>
                    </button>
                  </div>
                  <!-- End .header-search-wrapper -->
                </form>
              </div>
              <!-- End .header-search -->
            </div>

            <div class="header-right">
              <div class="account">
                <a href="login.html" title="My account">
                  <div class="icon">
                    <i class="icon-user"></i>
                  </div>
                </a>
              </div>

              <div class="account">
                <a href="<?php echo $lumise->cfg->url.'cart.php'; ?>" title="My account">
                  <div class="icon">
                    <i class="icon-shopping-cart"></i>
                  </div>
                </a>
              </div>
              <!-- End .compare-dropdown -->




              <!-- End .cart-dropdown -->
            </div>
            <!-- End .header-right -->
          </div>
          <!-- End .container -->
        </div>
        <!-- End .header-middle -->


        <div class="header-center ">
          <div class="row">
            <div class="container-fluid" style="position:inherit">


                <nav class="main-nav d-flex justify-content-center w-100">
                  <div class="row">


                    <ul class="menu sf-arrows" style="text-align: center;">
                      <?php foreach($menuItems['rows'] as $menuItem):?>
                        
                        <li>
                          <?php 
                            $menuItemChildren = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id'=>"".$menuItem['id'].""), '');
                            
                          ?>
                          <a href="<?=$menuItem['href']?>" class=""><?=$menuItem['text']?> <?php if(count($menuItemChildren['rows']) > 0): ?> <i class="fa fa-chevron-down"></i> <?php endif;?></a>
                          
                          <?php if(count($menuItemChildren['rows']) > 0):?>
                          
                            <div class="sub-menu">
                              <div class="container">
                                <div class="sub-item w-100">
                                  <div class="row">
                                    <div class="sub-item-left col-md-3">
                                      <?php foreach($menuItemChildren['rows'] as $children):?>
                                        <a href="<?php echo $children['href']; ?>"><?php echo $children['text']; ?>  <i class="fas fa-chevron-right"></i></a>
                                      <?php endforeach;?>
                                    </div>
                                    <div class="col-md-9">
                                      <?php foreach($menuItemChildren['rows'] as $children):
                                        $menuItemChildrenTwo = $lumise->lib->get_rows_without_author('menus', $search_filter, $orderby, $ordering, $per_page, $start, array('parent_id'=>"".$children['id'].""), '');
                                        if(count($menuItemChildrenTwo['rows']) > 0):
                                        ?>
                                        <div class="sub-two-items">
                                            <div class="sub-two-item">
                                              
                                              <?php foreach($menuItemChildrenTwo['rows'] as $children2):?>
                                                <a href="<?php echo $children2['href']; ?>"><?php echo $children2['text']; ?></a>
                                              <?php endforeach;?>
                                            </div>
                                        </div>
                                        <?php endif; endforeach;?> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          <?php endif;?>
                        </li>
                        <li></li>
                      <?php endforeach;?>
                      
                    </ul>

                  </div>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>
  <!-- End .header-middle-center -->

  <div class="header-top " style="background-color: rgba(245, 216, 180, 0.973);">
    <div class="container-fluid">
      <div class="header-center ">
        <p>Special collection already available. <a href="">Check it out!</a></p>
        <br>
      </div>
      <!-- End .header-left -->
    </div>
    <!-- End .container -->
  </div>
  <!-- End .header-top -->

  </div>
  <!-- End .container -->
  </div>
  <!-- End .header-bottom -->
  </header>