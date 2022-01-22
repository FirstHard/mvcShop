        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="">
              <img src="/src/images/logo.png" alt="Shop logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Shop
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                      <a class="dropdown-item" href="/shop/category/1">Notebooks</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/shop/category/2">Monoblocks</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/shop/category/3">Nettops</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/shop/category/4">Matrices</a>
                    </li>
                  </ul>
                </li>
              </ul>
              <span class="text-light">
              <?php
                if ($user = $this->auth->logged_user) {
              ?>
                Hello, <?= $user->getFirstName(); ?>!
              <?php
                } else {
              ?>
                Hello, Guest!
              <?php
                }
              ?>
              </span>
              <a href="/user" class="text-light ms-2 px-1" title="My Profile"><i class="bi bi-person-circle" style="font-size: 1.6rem;" role="img"></i></a>
              <?php
              if ($cart = $this->cart) {
                $count_items = 0;
                $count_icon = '';
                $mini_cart_title = 'Your shopping cart is empty';
                if ($cart_products = $cart->cart_products) {
                  $count_items = count($cart_products);
                  $mini_cart_title = 'Your shopping cart: ' . $count_items . ' items worth $&nbsp;' . $cart->total;
                  $count_icon = '
                  <span class="cart-items">' . $count_items . '</span>
                  ';
                }
              ?>
              <div class="cart-icon-wrapper">
                <a href="/cart" class="text-light ms-2 px-1 cart-icon" title="<?= $mini_cart_title; ?>">
                  <i class="bi bi-bag" style="font-size: 1.6rem;" role="img"></i>
                  <?= $count_icon; ?>
                </a>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
        </nav>