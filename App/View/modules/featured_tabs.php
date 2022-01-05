        <section id="featuredTabs" class="featuredTabs">
          <div class="container py-5">
            <h2 class="text-center">Products specially for you:</h2>
            <div class="row mt-5">
              <div class="col-12">
                <ul class="nav nav-tabs justify-content-center" id="productsTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-controls="new" aria-selected="true">New arrivals</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="top-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="top" aria-selected="false">Top</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured" type="button" role="tab" aria-controls="featured" aria-selected="false">Recommended</button>
                  </li>
                </ul>
                <div class="tab-content border border-top-0 mx-auto" id="productsTabContent">
                  <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                    <div class="row p-3">
                      <?php
                      foreach ($data['newArrivalsProducts'] as $product) {
                      ?>
                      <div class="col-12 col-md-6 col-lg-3">
                        <div class="card mb-3">
                          <a href="product/<?= $product->alias ?>">
                            <img src="/src/images/products/<?= $product->image_name ?>" class="card-img-top" alt="<?= $product->name ?>">
                          </a>
                          <div class="card-body">
                            <h5 class="card-title"><a href="product/<?= $product->alias ?>"><?= $product->name ?></a></h5>
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
                      <div class="col-12">
                        <div class="card-button">
                          <a href="#" class="btn btn-success text-uppercase">All new items <i class="bi bi-chevron-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="top" role="tabpanel" aria-labelledby="top-tab">
                    <div class="row p-3">
                      <?php
                      foreach ($data['topProducts'] as $product) {
                      ?>
                      <div class="col-12 col-md-6 col-lg-3">
                        <div class="card mb-3">
                          <a href="product/<?= $product->alias ?>">
                            <img src="/src/images/products/<?= $product->image_name ?>" class="card-img-top" alt="<?= $product->name ?>">
                          </a>
                          <div class="card-body">
                            <h5 class="card-title"><a href="product/<?= $product->alias ?>"><?= $product->name ?></a></h5>
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
                      <div class="col-12">
                        <div class="card-button">
                          <a href="#" class="btn btn-success text-uppercase">All bestsellers <i class="bi bi-chevron-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                    <div class="row p-3">
                      <?php
                      foreach ($data['recommendedProducts'] as $product) {
                      ?>
                      <div class="col-12 col-md-6 col-lg-3">
                        <div class="card mb-3">
                          <a href="product/<?= $product->alias ?>">
                            <img src="/src/images/products/<?= $product->image_name ?>" class="card-img-top" alt="<?= $product->name ?>">
                          </a>
                          <div class="card-body">
                            <h5 class="card-title"><a href="product/<?= $product->alias ?>"><?= $product->name ?></a></h5>
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
                      <div class="col-12">
                        <div class="card-button">
                          <a href="#" class="btn btn-success text-uppercase">All Recommended <i class="bi bi-chevron-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>