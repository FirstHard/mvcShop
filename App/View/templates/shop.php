<!doctype html>
<html lang="en">
<head>
  <?= $head_block; ?>
</head>
<body>
  <div id="app" class="body-wrapper">
    <header>
      <?php echo $header_block; ?>
    </header>
    <main>
      <h2 class="text-center py-5"><?= $data->page->title; ?></h2>
      <products-list></products-list>
      <!-- <div class="container my-5">
        <div class="row">
          <?php
            /* $main_class = 'col-12';
            if (isset($asaid_modules)) {
              $main_class = 'col-12 col-lg-9'; */
          ?>
          <div class="col-12 col-lg-3">
            <aside>
              <?php // $asaid_modules; ?>
            </aside>
          </div>
          <?php
            //}
          ?>
          <div class="<?php // $main_class ?>">
            <?php // $main_block; ?>
          </div>
        </div>
      </div> -->
    </main>
    <cart-modal></cart-modal>
    <footer class="bg-dark py-5 mt-5">
      <?= $footer_block; ?>
    </footer>
  </div>
  <script src="/src/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../js/main.js"></script>
</body>