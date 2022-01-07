<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i" rel="stylesheet">
  <link rel="shortcut icon" href="/src/images/favicon.ico" />
  <link rel="icon" type="image/vnd.microsoft.icon" href="/src/images/favicon.ico">
  <link rel="icon" type="image/x-icon" href="/src/images/favicon.ico">
  <link rel="icon" href="/src/images/favicon.ico" /> 
  <link href="/src/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/src/assets/bootstrap-icons.css" rel="stylesheet">
  <link href="/src/assets/css/main.css" rel="stylesheet">
  <title>Homework #16: JavaScript. API</title>
</head>
<body>
  <div class="body-wrapper">
    <header>
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
            <a href="/orders" class="text-light ms-2 px-1" title="List orders">List orders</a>
            <a href="/login" class="text-light ms-2 px-1" title="Login"><i class="bi bi-person-circle" style="font-size: 1.6rem;" role="img"></i></a>
            <div class="cart-icon-wrapper"><a href="#" class="text-light ms-2 px-1 cart-icon" title="Your shopping cart: 2 items worth $&nbsp;200"><i class="bi bi-bag" style="font-size: 1.6rem;" role="img"></i><span class="cart-items">2</span></a></div>
          </div>
        </div>
      </nav>
    </header>
    <main>
    <div class="container my-5">
      <div id="products_collection" class="row">

      </div>
    </div>
    </main>
    <footer class="bg-dark py-5 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-2 align-self-center text-center">
            <a href="/">
              <img src="/src/images/logo.png" alt="Shop logo" height="90">
            </a>
          </div>
          <div class="col-12 col-lg-8">
            <ul class="nav justify-content-center text-light pb-3 mb-3">
              <li class="nav-item"><a href="/" class="nav-link px-2">Home</a></li>
              <li class="nav-item"><a href="/category" class="nav-link px-2">Shop</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2">Demo product</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2">Cart</a></li>
              <li class="nav-item"><a href="/login" class="nav-link px-2">Login</a></li>
            </ul>
            <p class="text-center text-muted">&copy; 2021 The Shop Inc. All rights reserved.</p>
            <p class="text-center text-muted">Developed by <a href="https://buinoff.tk" target="_blank" rel="noopener noreferrer">Vladimir Buinoff</a> on the <a href="https://getbootstrap.com" target="_blank" rel="noopener noreferrer">Bootstrap Framework</a> in 2021.</p>
            <p class="text-center">
              <a href="https://jigsaw.w3.org/css-validator/check/referer" target="_blank" rel="noopener noreferrer">
                <img style="border:0;width:88px;height:31px"
                  src="https://jigsaw.w3.org/css-validator/images/vcss"
                  alt="Правильный CSS!" />
              </a>
            </p>
          </div>
          <div class="col-12 col-lg-2 align-self-center text-center">
            <p class="text-muted">Gratitude to:</p>
            <a href="https://www.nixsolutions.com" target="_blank">
              <img src="/src/images/nix-logo-new.svg" alt="NIX logo" height="80">
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="/src/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/src/assets/js/homework16.js"></script>

</body>
</html>
