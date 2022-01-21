        <div class="row">
          <div class="col-12 my-5">
            <h3 class="text-center">Please check your details!</h3>
            <div class="card">
              <div class="card-body">
                <form action="?do=checkout" id="checkout" method="POST" autocomplete="off">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="inputEmail" class="form-label">Email*</label>
                      <input type="email" name="email" value="<?= $data->user->getEmail(); ?>" id="inputEmail" class="form-control" placeholder="Input your Email" aria-label="Email" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputPhone" class="form-label">Phone</label>
                      <input type="phone" name="phone_number" value="<?= $data->user->getPhoneNumber(); ?>" id="inputPhone" class="form-control" placeholder="Input your Phone number" aria-label="Phone">
                    </div>
                    <div class="col-md-4">
                      <label for="inputFirstName" class="form-label">First name*</label>
                      <input type="text" name="first_name" value="<?= $data->user->getFirstName(); ?>" id="inputFirstName" class="form-control" placeholder="Input your first name" aria-label="First name" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputLastName" class="form-label">Last name*</label>
                      <input type="text" name="last_name" value="<?= $data->user->getLastName(); ?>" id="inputLastName" class="form-control" placeholder="Input your last name" aria-label="Last name" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputMiddleName" class="form-label">Middle name</label>
                      <input type="text" name="middle_name" value="<?= $data->user->getMiddleName(); ?>" id="inputMiddleName" class="form-control" placeholder="Input your middle name" aria-label="Middle name">
                    </div>
                    <div class="col-md-4">
                      <label for="inputStreet" class="form-label">Street*</label>
                      <input type="text" name="street" value="<?= $data->user->getStreet(); ?>" id="inputStreet" class="form-control" placeholder="1234 Main St" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputHouse" class="form-label">House*</label>
                      <input type="text" name="house_number" value="<?= $data->user->getHouseNumber(); ?>" id="inputHouse" class="form-control" placeholder="House number" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputApartment" class="form-label">APT number</label>
                      <input type="text" name="apartment_number" value="<?= $data->user->getApartmentNumber(); ?>" id="inputApartment" class="form-control" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="col-md-4">
                      <label for="inputCity" class="form-label">City*</label>
                      <input id="inputCity" name="city" value="<?= $data->user->getCity(); ?>" class="form-control" placeholder="Apartment, studio, or floor" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputState" class="form-label">State*</label>
                      <select id="inputState" name="state" class="form-select" required>
                        <?php
                          $states = (new \App\Model\StateMapper())->getStates();
                        ?>
                        <option value="" disabled>Choose state...</option>
                        <?php
                          foreach ($states as $state) {
                            if ($state->getName() == $data->user->getState()) {
                              $selected = 'selected';
                            } else {
                              $selected = '';
                            }
                        ?>
                        <option value="<?= $state->getName() ?>" <?= $selected; ?>><?= $state->getName() ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Zip</label>
                      <input type="text" name="postcode" value="<?= $data->user->getPostcode(); ?>" class="form-control" id="inputZip">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <h6>* All fields marked with an asterisk are required</h6>
          </div>
          <button type="submit" form="checkout" class="btn btn-primary btn-lg mx-auto">Checkout</button>
        </div>