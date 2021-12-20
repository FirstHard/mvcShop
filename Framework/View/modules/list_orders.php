        <section id="featuredTabs" class="featuredTabs">
          <div class="container">
            <h1 class="text-center py-1">My orders list</h1>
            <div class="row">
              <div class="col-12">
                <div class="btn-group justify-content-center w-100" role="group" aria-label="Orders selection">
                  <a type="button" class="btn btn-primary disabled">All</a>
                  <a type="button" class="btn btn-danger disabled">Pending</a>
                  <a type="button" class="btn btn-warning disabled">Processing</a>
                  <a type="button" class="btn btn-success disabled">In delivery</a>
                  <a type="button" class="btn btn-info disabled">Payment awaiting</a>
                  <a type="button" class="btn btn-secondary disabled">Closed</a>
                  <a type="button" class="btn btn-outline-secondary disabled">Archived</a>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <h5 class="text-center">Page <?= $pagination_obj->current_page; ?> from <?= $pagination_obj->amount; ?></h5>
                  <?= $pagination_block; ?>
                </nav>
              </div>
            </div>
            <div class="row bg-dark text-light text-center py-2 mt-1">
              <div class="col-1">
                #ID
              </div>
              <div class="col-2">
                Order
              </div>
              <div class="col-3">
                Status / Modified at
              </div>
              <div class="col-3">
                For client
              </div>
              <div class="col-2">
                Total
              </div>
              <div class="col-1">
                Actions
              </div>
            </div>
<?php
              foreach ($main_content as $key => $order) {
?>
            <div class="row border py-1">
              <div class="col-1 text-center">
                <?= $order->id; ?>
              </div>
              <div class="col-2">
                <h6 class="order-number">
                  Order number: <a href="orders/<?= $order->id; ?>"><?= $order->order_number; ?></a>
                </h6>
              </div>
              <div class="col-3 text-center">
                <?= $order->status; ?><br><?= $order->modified_at; ?>
              </div>
              <div class="col-3">
                <b>Name:</b> <?= $order->client_first_name; ?><br>
                <b>Last name:</b> <?= $order->client_last_name; ?><br>
              </div>
              <div class="col-2">
                <div class="order-total text-center">
                  <h6>Order total:</h6>
                  <span>
                    $&nbsp;<?= (int) $order->total; ?>
                  </span>
                </div>
              </div>
              <div class="col-1 fs-4 text-center d-flex align-items-center">
                <!-- <a href="#" class="btn btn-outline-success disabled"><i class="bi bi-file-earmark-arrow-down"></i></a> -->
                <a href="#" class="btn btn-outline-primary disabled mx-auto"><i class="bi bi-archive"></i></a>
              </div>
            </div>
<?php
              }
?>
            <div class="row mt-5">
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <?= $pagination_block; ?>
                  <h5 class="text-center">Page <?= $pagination_obj->current_page; ?> from <?= $pagination_obj->amount; ?></h5>
                </nav>
              </div>
            </div>
          </div>
        </section>