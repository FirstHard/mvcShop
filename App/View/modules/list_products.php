        <section id="Products" class="Products">
          <div class="container py-5">
            <h2 class="text-center"><?= $data->page->title; ?></h2>
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
            ?>
            <div class="row mt-5">
<?php
              foreach ($data->products as $product) {
                include('product_list_item.php');
              }
?>
            </div>
            <?php
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