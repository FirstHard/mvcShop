        <section id="featuredTabs" class="featuredTabs">
          <div class="container py-5">
            <h2 class="text-center">Products in Category</h2>
            <div class="row mt-5">
<?php
              foreach ($data as $product) {
?>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card mb-3">
                  <a href="product/<?= $product->id ?>">
                  <img src="/src/images/products/<?= $product->image_name ?>" class="card-img-top" alt="<?= $product->name ?>">
                  </a>
                  <div class="card-body">
                    <h5 class="card-title"><a href="product/<?= $product->id ?>"><?= $product->name ?></a></h5>
                    <p>Articule: <?= $product->shop_articule ?></p>
                    <div class="card-price">
                        <span>
                        $&nbsp;<?= $product->price ?>
                        </span>
                    </div>
                    <div class="card-text"><?= $product->short_description ?></div>
                    <div class="card-button">
                        <a href="#" class="btn btn-default text-uppercase"><i class="bi bi-bag-plus"></i> Buy</a>
                    </div>
                  </div>
                </div>
              </div>
<?php
              }
?>
            </div>
          </div>
        </section>