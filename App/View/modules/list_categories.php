        <div class="container py-5">
          <h2 class="text-center">Shop by categories</h2>
          <div class="row mt-5">
          <?php
            foreach ($data->main_data as $category) {
          ?>
            <div class="col-12 col-md-6 col-lg-3">
              <div class="card mb-3">
                <a href="/shop/category/<?= $category->getId() ?>">
                  <img src="/src/images/categories/<?= $category->getImageName() ?>" class="card-img-top" alt="<?= $category->getName() ?>">
                </a>
                <div class="card-body">
                  <h5 class="card-title"><a href="/shop/category/<?= $category->getId() ?>"><?= $category->getName() ?></a></h5>
                  <div class="card-text"><?= $category->getShortDescription() ?></div>
                  <div class="card-button">
                      <a href="/shop/category/<?= $category->getId() ?>" class="btn btn-default text-uppercase"><i class="bi bi-bag-plus"></i> Shop</a>
                  </div>
                </div>
              </div>
            </div>
          <?php
            }
          ?>
          </div>
        </div>