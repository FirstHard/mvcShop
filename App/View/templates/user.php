<!doctype html>
<html lang="en">
<head>
  <?= $head_block; ?>
</head>
<body>
  <div class="body-wrapper">
    <header>
      <?= $header_block; ?>
    </header>
    <main>
      <div class="container my-5">
        <div class="row">
          <?= $data->ui; ?>
          <?php
            $main_class = 'col-12';
            if (isset($asaid_modules)) {
              $main_class = 'col-12 col-lg-9';
          ?>
          <div class="col-12 col-lg-3">
            <aside>
              <?= $asaid_modules; ?>
            </aside>
          </div>
          <?php
            }
          ?>
          <div class="<?= $main_class ?>">
            <?= $main_block; ?>
          </div>
        </div>
      </div>
    </main>
    <footer class="bg-dark py-5 mt-5">
      <?= $footer_block; ?>
    </footer>
  </div>
  <script src="/src/assets/js/bootstrap.bundle.min.js"></script>
</body>