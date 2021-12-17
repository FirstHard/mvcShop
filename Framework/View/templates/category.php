            <main>
              <div class="row">
                <div class="col-12">
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Предыдущая">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Следующая">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="row">
                <?php
                  foreach ($products as $item) {
                    $quantity = $this->getQuantity($item['product_id']);
                    $button_class = 'default';
                    $button_text = 'Купить';
                ?>
                <div class="col-12 col-md-3 col-lg-4">
                  <div class="card mb-3">
                    <a href="<?= $item['alias'] ?>.html">
                      <img src="images/products/<?= $item['image'] ?>" class="card-img-top" alt="<?= $item['name'] ?>">
                    </a>
                    <div class="card-body">
                      <h4 class="card-title"><a href="<?= $item['alias'] ?>.html"><?= $item['name'] ?></a></h4>
                      <h5>Артикул: <?= $item['articule'] ?></h5>
                      <?php
                        if ($item['product_price'] == 0 || $quantity == 0) {
                          $button_class = 'secondary';
                          $button_text = 'Посмотреть';
                      ?>
                      <div class="no-in-stock">
                        <span class="text-danger">Нет на складе!</span>
                      </div>
                      <?php
                        } else {
                      ?>
                      <div class="price">
                        <span>
                          $&nbsp;<?= $item['product_price'] ?>
                        </span>
                      </div>
                      <h6 class="text-success">На складе: <?= $quantity ?></h6>
                      <?php
                        }
                        ?>
                      <div class="card-text mb-3"><?= $item['short_description'] ?></div>
                      <div class="card-button">
                        <a href="cart.html" class="btn btn-<?= $button_class; ?> text-uppercase"><i class="bi bi-bag-plus"></i> <?= $button_text; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                ?>
              </div>
              <div class="row">
                <div class="col-12">
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Предыдущая">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Следующая">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </main>