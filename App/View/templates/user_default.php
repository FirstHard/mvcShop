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
          <?= $main_block; ?>
        </div>
      </div>
    </main>
    <footer class="bg-dark py-5 mt-5">
      <?= $footer_block; ?>
    </footer>
  </div>
  <script src="/src/assets/js/bootstrap.bundle.min.js"></script>
</body>