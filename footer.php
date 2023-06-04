<?php global $lumise;
?>
<footer class="footer">
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-about">
            <img src="assets/images/logo.png" class="footer-logo" alt="Footer Logo" width="105" height="25">
            <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat.
              dd </p>

            <div class="social-icons">
              <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
              <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
              <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
              <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
              <a href="#" class="social-icon" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a>
            </div><!-- End .soial-icons -->
          </div><!-- End .widget about-widget -->
        </div><!-- End .col-sm-6 col-lg-3 -->

        <?php
        $db = $lumise->get_db();

        $query = "SELECT * FROM lumise_footer_menus ORDER BY section";
        $data = $db->rawQuery($query);

        $groupedData = array();

        // Verileri gruplara ayırma
        foreach ($data as $row) {
          $section = $row['section'];

          if (!isset($groupedData[$section])) {
            $groupedData[$section] = array();
          }

          $groupedData[$section][] = $row;
        }

        // Gruplanmış verileri HTML olarak çıktıya yazdırma
        foreach ($groupedData as $section => $rows) {
          echo '<div class="col-sm-6 col-lg-3">';
          echo '<div class="widget">';
          echo '<h4 class="widget-title">' . $section . '</h4>';
          echo '<ul class="widget-list">';

          foreach ($rows as $row) {
            echo '<li><a href="http://localhost/lumise/page.php?slug=' . $row['href'] . '">' . $row['title'] . '</a></li>';
          }

          echo '</ul>';
          echo '</div>';
          echo '</div>';
        }

        ?>
      </div><!-- End .row -->
    </div><!-- End .container -->
  </div><!-- End .footer-middle -->

  <div class="footer-bottom">
    <div class="container">
      <p class="footer-copyright">Copyright © 2019 Molla Store. All Rights Reserved.</p><!-- End .footer-copyright -->
      <figure class="footer-payments">
        <img src="assets/images/payments.png" alt="Payment methods" width="272" height="20">
      </figure><!-- End .footer-payments -->
    </div><!-- End .container -->
  </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div>
<!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container mobile-menu-light">
  <div class="mobile-menu-wrapper">
    <span class="mobile-menu-close"><i class="icon-close"></i></span>

    <form action="#" method="get" class="mobile-search">
      <label for="mobile-search" class="sr-only">Search</label>
      <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search product ..." required />
      <button class="btn btn-primary" type="submit">
        <i class="icon-search"></i>
      </button>
    </form>

    <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
      </li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
        <nav class="mobile-nav">
          <ul class="mobile-menu">
            <li class="active">
              <a href="blog-mask-grid.html">Categories</a>
            </li>
            <li>
              <a href="blog-mask-grid.html">Recipients</a>
            </li>
            <li>
              <a href="blog-mask-grid.html" class="sf-with-ul">Occasions</a>
            </li>
            <li>
              <a href="blog-mask-grid.html">
                Personalisation Methods
              </a>
            </li>
            <li>
              <a href="blog-mask-grid.html">
                Brands
              </a>
            </li>
            <li>
              <a href="category-boxed.html">
                Sale
              </a>
            </li>
            <li>
              <a href="blog-mask-grid.html">
                Birthday Gifts
              </a>
            </li>
            <li>
              <a href="blog-mask-grid.html">B2B</a>
            </li>
            <li><a href="faq.html">Customer Service</a></li>

            <li><a href="cart.html">Shopping Basket</a></li>

            <li><a href="#"></a>Language</li>
          </ul>
          <li><a href="login.html">Log In</a></li>

        </nav>
        <!-- End .mobile-nav -->
      </div>
      <!-- .End .tab-pane -->
      <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
        <nav class="mobile-cats-nav">
          <ul class="mobile-cats-menu">
            <li><a class="mobile-cats-lead" href="#">Daily offers</a></li>
            <li><a class="mobile-cats-lead" href="#">Gift Ideas</a></li>
            <li><a href="#">Beds</a></li>
            <li><a href="#">Lighting</a></li>
            <li><a href="#">Sofas & Sleeper sofas</a></li>
            <li><a href="#">Storage</a></li>
            <li><a href="#">Armchairs & Chaises</a></li>
            <li><a href="#">Decoration </a></li>
            <li><a href="#">Kitchen Cabinets</a></li>
            <li><a href="#">Coffee & Tables</a></li>
            <li><a href="#">Outdoor Furniture </a></li>
          </ul>
          <!-- End .mobile-cats-menu -->
        </nav>
        <!-- End .mobile-cats-nav -->
      </div>
      <!-- .End .tab-pane -->
    </div>
    <!-- End .tab-content -->

    <div class="social-icons">
      <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
      <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
      <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
      <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
    </div>
    <!-- End .social-icons -->
  </div>
  <!-- End .mobile-menu-wrapper -->
</div>
<!-- End .mobile-menu-container -->

<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="icon-close"></i></span>
        </button>

        <div class="form-box">
          <div class="form-tab">
            <ul class="nav nav-pills nav-fill" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
              </li>
            </ul>
            <div class="tab-content" id="tab-content-5">
              <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                <form action="#">
                  <div class="form-group">
                    <label for="singin-email">Username or email address *</label>
                    <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                  </div><!-- End .form-group -->

                  <div class="form-group">
                    <label for="singin-password">Password *</label>
                    <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                  </div><!-- End .form-group -->

                  <div class="form-footer">
                    <button type="submit" class="btn btn-outline-primary-2">
                      <span>LOG IN</span>
                      <i class="icon-long-arrow-right"></i>
                    </button>

                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="signin-remember">
                      <label class="custom-control-label" for="signin-remember">Remember Me</label>
                    </div><!-- End .custom-checkbox -->

                    <a href="#" class="forgot-link">Forgot Your Password?</a>
                  </div><!-- End .form-footer -->
                </form>
                <div class="form-choice">
                  <p class="text-center">or sign in with</p>
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="#" class="btn btn-login btn-g">
                        <i class="icon-google"></i>
                        Login With Google
                      </a>
                    </div><!-- End .col-6 -->
                    <div class="col-sm-6">
                      <a href="#" class="btn btn-login btn-f">
                        <i class="icon-facebook-f"></i>
                        Login With Facebook
                      </a>
                    </div><!-- End .col-6 -->
                  </div><!-- End .row -->
                </div><!-- End .form-choice -->
              </div><!-- .End .tab-pane -->
              <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                <form action="#">
                  <div class="form-group">
                    <label for="register-email">Your email address *</label>
                    <input type="email" class="form-control" id="register-email" name="register-email" required>
                  </div><!-- End .form-group -->

                  <div class="form-group">
                    <label for="register-password">Password *</label>
                    <input type="password" class="form-control" id="register-password" name="register-password" required>
                  </div><!-- End .form-group -->

                  <div class="form-footer">
                    <button type="submit" class="btn btn-outline-primary-2">
                      <span>SIGN UP</span>
                      <i class="icon-long-arrow-right"></i>
                    </button>

                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="register-policy" required>
                      <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy
                          policy</a> *</label>
                    </div><!-- End .custom-checkbox -->
                  </div><!-- End .form-footer -->
                </form>
                <div class="form-choice">
                  <p class="text-center">or sign in with</p>
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="#" class="btn btn-login btn-g">
                        <i class="icon-google"></i>
                        Login With Google
                      </a>
                    </div><!-- End .col-6 -->
                    <div class="col-sm-6">
                      <a href="#" class="btn btn-login  btn-f">
                        <i class="icon-facebook-f"></i>
                        Login With Facebook
                      </a>
                    </div><!-- End .col-6 -->
                  </div><!-- End .row -->
                </div><!-- End .form-choice -->
              </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
          </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
      </div><!-- End .modal-body -->
    </div><!-- End .modal-content -->
  </div><!-- End .modal-dialog -->
</div><!-- End .modal -->

<?php $lumise->do_action('footer_lumise_php'); ?>
<!-- Plugins JS File -->
<script src="<?php echo theme('assets/surprisecss/js/jquery.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/bootstrap.bundle.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/jquery.hoverIntent.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/jquery.waypoints.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/superfish.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/owl.carousel.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/jquery.plugin.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/jquery.magnific-popup.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/jquery.countdown.min.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/main.js', true); ?>"></script>
<script src="<?php echo theme('assets/surprisecss/js/demo-2.js', true); ?>"></script>
<script>
  (function() {
    var js =
      "window['__CF$cv$params']={r:'7c28bcd049fa92d8',m:'hxwOUEdyUbH9X2EwBYWWf9dcM9yunWKlaQ9vG35.J80-1683287130-0-AXUA+6I2Xk/qTj3fG5NUPv7GGCQpU1pPSTkJ9W7V1UbE',u:'/cdn-cgi/challenge-platform/h/g'};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../cdn-cgi/challenge-platform/h/g/scripts/jsd/b5e45436/invisible.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";
    var _0xh = document.createElement("iframe");
    _0xh.height = 1;
    _0xh.width = 1;
    _0xh.style.position = "absolute";
    _0xh.style.top = 0;
    _0xh.style.left = 0;
    _0xh.style.border = "none";
    _0xh.style.visibility = "hidden";
    document.body.appendChild(_0xh);

    function handler() {
      var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;
      if (_0xi) {
        var _0xj = _0xi.createElement("script");
        _0xj.nonce = "";
        _0xj.innerHTML = js;
        _0xi.getElementsByTagName("head")[0].appendChild(_0xj);
      }
    }
    if (document.readyState !== "loading") {
      handler();
    } else if (window.addEventListener) {
      document.addEventListener("DOMContentLoaded", handler);
    } else {
      var prev = document.onreadystatechange || function() {};
      document.onreadystatechange = function(e) {
        prev(e);
        if (document.readyState !== "loading") {
          document.onreadystatechange = prev;
          handler();
        }
      };
    }
  })();
</script>
<script src="<?php echo theme('assets/surprisecss/js/navbar.js', true); ?>"></script>s

</body>

</html>
<script>
  $('.sub-item-left a').mouseover(function(e) {
    e.preventDefault();
    var index = $(this).index();
    $('.sub-two-items').removeClass('active-sub-two-menu')
    $(this).parent('div').parent('div').children('.col-md-9').children('.sub-two-items').eq(index).addClass('active-sub-two-menu')
    $('.active-sub-two-menu').eq(index).mouseover(function(e) {
      e.stopPropagation()
    })
  })
</script>
</body>

</html>