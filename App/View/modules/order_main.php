  <h1 class="text-center py-1"><?= $data->page->title; ?>: <?= $data->single_order->getOrderNumber(); ?></h1>
  <div class="container my-5">
    <div class="row">
      <div class="col-3 text-center">
        <h4>Status:</h4>
        <p><?= $data->single_order->getStatus(); ?></p>
      </div>
      <div class="col-3 text-center">
        <h4>Created:</h4>
        <p><?= $data->single_order->getCreatedAt(); ?></p>
      </div>
      <div class="col-3 text-center">
        <h4>Modified:</h4>
        <p><?= $data->single_order->getModifiedAt(); ?></p>
      </div>
      <div class="col-3 text-center">
        <h4>Amount products:</h4>
        <p><?= count($data->single_order->getProducts()); ?> <b>items</b></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-4 text-center fw-bold">
        Products:
      </div>
      <div class="col-4 text-center fw-bold">
        Customer info:
      </div>
      <div class="col-4 text-center fw-bold">
        Delivery info:
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-4 mb-3">
        <?php
          foreach ($data->single_order->getProducts() as $product_data) {
        ?>
        <div class="product-item-wrapper row">
          <div class="col-4 order-product-thumb p-2">
            <a href="/product/view/<?= $product_data['order_product']->getId() ?>">
              <img src="/src/images/products/<?= $product_data['order_product']->getImageName() ?>" alt="<?= $product_data['order_product']->getName() ?>" class="img-fluid">
            </a>
          </div>
          <div class="col-8">
            <h6><a href="/product/view/<?= $product_data['order_product']->getId() ?>"><?= $product_data['order_product']->getName() ?></a></h6>
            <p><b>Articule:</b> <?= $product_data['order_product']->getShopArticule() ?></p>
            <p><?= $product_data['amount'] ?> <b>pcs.</b> &times; $&nbsp;<?= (int) $product_data['product_price'] ?></p>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
      <div class="col-4 border-start order-delivery-info mb-3">
        <p><b>Name:</b> <span class="fst-italic"><?= $data->single_order->getClientFirstName(); ?></span></p>
        <p><b>Surname:</b> <span class="fst-italic"><?= $data->single_order->getClientLastName(); ?></span></p>
        <p><b>Phone:</b> <span class="fst-italic"><?= $data->single_order->getClientPhoneNumber(); ?></span></p>
        <p><b>Email:</b> <span class="fst-italic"><?= $data->single_order->getClientEmail(); ?></span></p>
      </div>
      <div class="col-4 border-start order-delivery-info mb-3">
        <p><b>Track No.:</b> <span class="fst-italic"><?= $data->single_order->getTrackNumber(); ?></span></p>
        <p><b>Postcode:</b> <span class="fst-italic"><?= $data->single_order->getDeliveryPostcode(); ?></span></p>
        <p><b>State:</b> <span class="fst-italic"><?= $data->single_order->getDeliveryState(); ?></span></p>
        <p><b>City:</b> <span class="fst-italic"><?= $data->single_order->getDeliveryCity(); ?></span></p>
        <p><b>Street:</b> <span class="fst-italic"><?= $data->single_order->getDeliveryStreet(); ?></span></p>
        <p><b>House No.:</b> <span class="fst-italic"><?= $data->single_order->getDeliveryHouseNumber(); ?></span></p>
        <p><b>APT No.:</b> <span class="fst-italic"><?= $data->single_order->getDeliveryApartmentNumber(); ?></span></p>
      </div>
      <hr>
      <div class="col-12">
        <a href="/orders" class="btn btn-default"><i class="bi bi-arrow-left-short"></i> Back to Orders</a>
        <h5 class="text-end">Total: $&nbsp;<?= (int) $data->single_order->getTotal() ?></h5>
      </div>
    </div>
  </div>