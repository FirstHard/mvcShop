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
                      foreach ($data->newArrivalsProducts as $product) {
                        include 'product_list_item.php';
                      }
                      ?>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="top" role="tabpanel" aria-labelledby="top-tab">
                    <div class="row p-3">
                      <?php
                      foreach ($data->topProducts as $product) {
                        include 'product_list_item.php';
                      }
                      ?>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                    <div class="row p-3">
                      <?php
                      foreach ($data->recommendedProducts as $product) {
                        include 'product_list_item.php';
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>