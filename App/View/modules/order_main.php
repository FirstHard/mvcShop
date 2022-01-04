  <h1 class="text-center py-1 my-5"><?= $headers->title; ?></h1>
  <div class="container my-5">
    <div class="row">
      <div class="col-3 text-center">
        <h4>Status:</h4>
        <p><?= $status; ?></p>
      </div>
      <div class="col-3 text-center">
        <h4>Created:</h4>
        <p><?= $created_at; ?></p>
      </div>
      <div class="col-3 text-center">
        <h4>Modified:</h4>
        <p><?= $modified_at; ?></p>
      </div>
      <div class="col-3 text-center">
        <h4>Total:</h4>
        <p>$&nbsp;<?= round($total, 2); ?></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-4 text-center fw-bold">
        Products:
      </div>
      <div class="col-4 text-center fw-bold">
        Customer info:
      </div>
      <div class="col-4 text-center fw-bold">
        Delivery info:
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-4">
        //product image/link, name/link, price, quantity
      </div>
      <div class="col-4">
        <p class="text-blured"><?= $client_first_name; ?></p>
        <p class="text-blured"><?= $client_last_name; ?></p>
        <p class="text-blured"><?= $client_phone_number; ?></p>
        <p class="text-blured"><?= $client_email; ?></p>
      </div>
      <div class="col-4">
        <p class="text-blured"><?= $track_number; ?></p>
        <p class="text-blured"><?= $delivery_postcode; ?></p>
        <p class="text-blured"><?= $delivery_country_id; ?></p>
        <p class="text-blured"><?= $delivery_region_id; ?></p>
        <p class="text-blured"><?= $delivery_city_id; ?></p>
        <p class="text-blured"><?= $delivery_street; ?></p>
        <p class="text-blured"><?= $delivery_house_number; ?></p>
        <p class="text-blured"><?= $delivery_appartment_number; ?></p>
      </div>
    </div>
  </div>