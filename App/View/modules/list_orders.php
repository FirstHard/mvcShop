        <section id="ordersTable" class="ordersTable">
          <div class="container">
            <h1 class="text-center py-1"><?= $data->page->title; ?></h1>
            <?php
              if (isset($pagination_block)) {
            ?>
            <div class="row mt-3">
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <h5 class="text-center">Page <?= $data->pagination->current_page; ?> from <?= $data->pagination->amount; ?></h5>
                  <?= $pagination_block; ?>
                </nav>
              </div>
            </div>
            <?php
              }
              if (!$data->orders) {
            ?>
            <h4 class="text-center my-5">No orders find</h4>
            <?php
              } else {
            ?>
            <div class="row bg-dark text-light text-center py-2 mt-1">
              <div class="col-3">
                Order
              </div>
              <div class="col-4">
                Status / Created at
              </div>
              <div class="col-3">
                For client
              </div>
              <div class="col-2">
                Total
              </div>
            </div>
            <?php
                foreach ($data->orders as $key => $order) {
            ?>
            <div class="row border py-1">
              <div class="col-3">
                <h6 class="order-number">
                  Order number: <a href="/user/orders/<?= $order->getOrderNumber(); ?>"><?= $order->getOrderNumber(); ?></a>
                </h6>
              </div>
              <div class="col-4 text-center">
                <?= $order->getStatus(); ?><br><?= $order->getCreatedAt(); ?>
              </div>
              <div class="col-3">
                <b>Name:</b> <span class="fst-italic"><?= $order->getClientFirstName(); ?></span><br>
                <b>Last name:</b> <span class="fst-italic"><?= $order->getClientLastName(); ?></span><br>
              </div>
              <div class="col-2">
                <div class="order-total text-center">
                  <h6>Order total:</h6>
                  <span>
                    $&nbsp;<?= (int) $order->getTotal(); ?>
                  </span>
                </div>
              </div>
            </div>
            <?php
                }
              }
              if (isset($pagination_block)) {
            ?>
            <div class="row mt-3">
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <?= $pagination_block; ?>
                  <h5 class="text-center">Page <?= $data->pagination->current_page; ?> from <?= $data->pagination->amount; ?></h5>
                </nav>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </section>