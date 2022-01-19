                      <div class="col-12 col-md-6 col-lg-3">
                        <div class="card mb-3">
                          <a href="/product/view/<?= $product->getId() ?>">
                            <img src="/src/images/products/<?= $product->getImageName() ?>" class="card-img-top" alt="<?= $product->getName() ?>">
                          </a>
                          <div class="card-body">
                            <h5 class="card-title"><a href="/product/view/<?= $product->getId() ?>"><?= $product->getName() ?></a></h5>
                            <p><b>Articule:</b> <?= $product->getShopArticule() ?></p>
                            <div class="card-price text-center">
                              <h6>Price:</h6>
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
                            <div class="card-text short-description"><?= $product->getShortDescription() ?></div>
                            <div class="card-button">
                              <a href="#" class="btn btn-default text-uppercase"><i class="bi bi-bag-plus"></i> Buy</a>
                            </div>
                          </div>
                        </div>
                      </div>