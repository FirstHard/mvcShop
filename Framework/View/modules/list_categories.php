        <section id="featuredTabs" class="featuredTabs">
          <div class="container py-5">
            <h2 class="text-center">Shop by categories</h2>
            <div class="row mt-5">
<?php
              foreach ($main_content as $category) {
?>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card mb-3">
                  <a href="/shop/category/<?= $category->id ?>">
                    <img src="/src/images/categories/<?= $category->image_name ?>" class="card-img-top" alt="<?= $category->name ?>">
                  </a>
                  <div class="card-body">
                    <h5 class="card-title"><a href="/shop/category/<?= $category->id ?>"><?= $category->name ?></a></h5>
                    <div class="card-text"><?= $category->short_description ?></div>
                    <div class="card-button">
                        <a href="/shop/category/<?= $category->id ?>" class="btn btn-default text-uppercase"><i class="bi bi-bag-plus"></i> Shop</a>
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