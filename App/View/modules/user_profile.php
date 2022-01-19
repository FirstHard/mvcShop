        <section id="userData">
          <h1 class="text-center py-1"><?= $data->page->title; ?></h1>
          <div class="container">
            <div class="row">
              <?php
                $user = $data->main_data;
              ?>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <b>Login:</b> <?= $user->getLogin(); ?>
                </li>
                <li class="list-group-item">
                  <b>Email:</b> <?= $user->getEmail(); ?>
                </li>
                <li class="list-group-item">
                  <b>Phone number:</b> <?= $user->getPhoneNumber(); ?>
                </li>
                <li class="list-group-item">
                  <b>First name:</b> <?= $user->getFirstName(); ?>
                </li>
                <?php
                  if (!empty($user->getMiddleName())) {
                ?>
                <li class="list-group-item">
                  <b>Middle name:</b> <?= $user->getMiddleName(); ?>
                </li>
                <?php
                }
                ?>
                <li class="list-group-item">
                  <b>Registered at:</b> <?= $user->getRegisteredAt(); ?>
                </li>
                <li class="list-group-item">
                  <b>Postcode:</b> <?= $user->getPostcode(); ?>
                </li>
                <li class="list-group-item">
                  <b>State:</b> <?= $user->getState(); ?>
                </li>
                <li class="list-group-item">
                  <b>City:</b> <?= $user->getCity(); ?>
                </li>
                <li class="list-group-item">
                  <b>Street:</b> <?= $user->getStreet(); ?>
                </li>
                <li class="list-group-item">
                  <b>House number:</b> <?= $user->getHouseNumber(); ?>
                </li>
                <?php
                  if (!empty($user->getApartmentNumber())) {
                ?>
                <li class="list-group-item">
                  <b>Apartment number:</b> <?= $user->getApartmentNumber(); ?>
                </li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
        </section>