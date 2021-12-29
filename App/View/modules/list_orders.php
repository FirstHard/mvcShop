        <section id="ordersTable" class="ordersTable">
          <div class="container">
            <h1 class="text-center py-1"><?= $headers->title; ?></h1>
            <?php
              if (isset($pagination_block)) {
            ?>
            <div class="row mt-3">
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <h5 class="text-center">Page <?= $pagination->current_page; ?> from <?= $pagination->amount; ?></h5>
                  <?= $pagination_block; ?>
                </nav>
              </div>
            </div>
            <?php
              }
              if ($main_content) {
            ?>
            <div class="row bg-dark text-light text-center py-2 mt-1">
              <div class="col-1">
                #ID
              </div>
              <div class="col-2">
                Order
              </div>
              <div class="col-3">
                Status / Created at
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
                <?= $order->status; ?><br><?= $order->created_at; ?>
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
                <a href="#" class="btn btn-outline-primary disabled mx-auto"><i class="bi bi-archive"></i></a>
              </div>
            </div>
            <?php
                }
              } else {
            ?>
            <h4 class="text-center my-5">No orders find</h4>
            <?php
              }
              if (isset($pagination_block)) {
            ?>
            <div class="row mt-3">
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <h5 class="text-center">Page <?= $pagination->current_page; ?> from <?= $pagination->amount; ?></h5>
                  <?= $pagination_block; ?>
                </nav>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </section>