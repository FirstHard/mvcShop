      <div class="container my-5 product-wrapper">
        <div class="row">
          <div class="col-12 col-lg-6 p-4">
            <div class="prod-thumb">
              <a type="button"  data-bs-toggle="modal" data-bs-target="#productModal">
                <img src="/src/images/products/<?= $product->getImageName(); ?>" alt="<?= $product->getName(); ?>" class="product-img">
              </a>
              <div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="productModalLabel"><?= $product->getName(); ?> Articule: <?= $product->getShopArticule(); ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <img src="/src/images/products/<?= $product->getImageName(); ?>" alt="<?= $product->getName(); ?>" class="product-img">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 p-4">
            <div class="product-info">
              <h1 class="title"><?= $product->getName(); ?></h1>
              <div class="prices">
                <h4>Price:</h4>
                <?php
                if ($product->getNewPrice() > 0) {
                ?>
                <span class="product-old-price">$&nbsp;<?= (int) $product->getPrice() ?></span>
                <span class="product-new-price">$&nbsp;<?= (int) $product->getNewPrice() ?></span>
                <?php
                } else {
                ?>
                <span class="product-new-price">$&nbsp;<?= (int) $product->getPrice() ?></span>
                <?php
                }
                ?>
              </div>
              <div class="product-short-description">
                <?= $product->getShortDescription(); ?>
              </div>
              <div class="d-flex">
                <div class="product-quantity">
                  <div class="input-group quantity-goods">
                    <input type="button" value="-" id="button_minus" title="Reduce the quantity">
                    <input type="text" id="num_count" name="quantity" value="1" title="Input quantity">
                    <input type="button" value="+" id="button_plus" title="Increase the quantity">
                  </div>
                </div>
                <a href="#" class="btn btn-default text-uppercase"><i class="bi bi-bag-plus"></i> Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product-full-description">
              <h4>Description:</h4>
              <?= $product->getFullDescription(); ?>
            </div>
          </div>
        </div>
      </div>