<h1 class="text-center py-1 mt-5"><?= $data->page->title; ?></h1>
<div class="container">
  <?php
  if (!empty($data->page->message)) {
  ?>
  <div class="row">
    <div class="col-12">
    <?= $data->page->message; ?>
    </div>
  </div>
  <?php
  }
  ?>
  <?php
  if (!empty($data->cart_products)) {
  ?>
  <div class="row border bg-dark text-light mt-5">
    <div class="border col-2 p-2 text-center">
      Image:
    </div>
    <div class="border col-4 col-lg-7 p-2 text-center">
      Product:
    </div>
    <div class="border col-2 col-lg-1 p-2 d-flex justify-content-center align-items-center text-center">
      Price:
    </div>
    <div class="border col-2 col-lg-1 p-2 d-flex justify-content-center align-items-center text-center">
      Amount:
    </div>
    <div class="border col-2 col-lg-1 p-2 d-flex justify-content-center align-items-center text-center">
      Summ:
    </div>
  </div>
  <?php
    /* echo '<pre>';
    print_r($data);
    echo '</pre>'; */
    foreach ($data->cart_products as $row) {
      $data->total += $row['product_summ'];
  ?>
  <form action="" id="<?= $row['product']->getId(); ?>" method="post">
    <input type="hidden" name="id" value="<?= $row['product']->getId(); ?>">
    <input type="hidden" name="cart_token" value="<?= $data->cart_token; ?>">
    <div class="row border">
      <div class="border col-2 p-0">
        <a href="/product/view/<?= $row['product']->getId(); ?>">
          <img src="/src/images/products/<?= $row['product']->getImageName(); ?>" alt="<?= $row['product']->getName(); ?>" class="img-fluid">
        </a>
      </div>
      <div class="border col-3 col-lg-6 cart-product-info">
        <input type="hidden" name="product_id" value="<?= $row['product']->getId(); ?>">
        <a href="/product/view/<?= $row['product']->getId(); ?>">
          <?= $row['product']->getName(); ?>
        </a>
        <?= $row['product']->getShortDescription(); ?>
      </div>
      <div class="border col-2 col-lg-1 d-flex flex-column justify-content-center align-items-center text-center quantity-goods me-0">
        <input type="submit" name="increase" value="+" onclick="this.submit" title="Increase the quantity">
        <input type="text" id="num_count" name="amount" min="1" value="<?= $row['amount']; ?>" onchange="this.submit" title="Input quantity then press Enter for renew amount">
        <input type="submit" name="decrease" value="-" onclick="this.submit" title="Reduce the quantity">
      </div>
      <div class="border col-2 col-lg-1 d-flex justify-content-center align-items-center text-center">
        <input type="hidden" name="product_price" value="<?= $row['product_price']; ?>">
        &times; $ <?= (int) $row['product_price']; ?>
      </div>
      <div class="border col-2 col-lg-1 d-flex justify-content-center align-items-center text-center">
        $ <?= $row['product_summ']; ?>
      </div>
      <div class="border col-2 col-lg-1 d-flex justify-content-center align-items-center text-center quantity-goods me-0">
        <button type="submit" name="del_product" value="true" onclick="this.submit" title="Delete product from cart"><i class="bi bi-trash fs-4"></i></button>
      </div>
    </div>
  </form>
  <?php
    }
  ?>
  <div class="row border bg-dark text-light text-end p-2">
    <div class="col-2 col-md-1 ms-auto">
      Total:
    </div>
    <div class="col-2 col-md-1">
      $ <?= $data->total; ?>
    </div>
  </div>
  <div class="back-shop-btn mt-3 p-0">
    <a href="/shop" class="btn btn-default">Continue Shopping</a>
  </div>
  <div class="row my-5">
    <div class="col-12">
      <h2>Ready to place an order?</h2>
      <?= $order_form; ?>
    </div>
  </div>
</div>
  <?php
  }
  ?>
