      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6 my-5">
            <h3 class="text-center">Please sign up!</h3>
            <div class="card">
              <div class="card-body">
                <form action="/cart/checkout?cart_token=<?= $data->cart_token; ?>" id="checkout" method="POST" autocomplete="off">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="inputLogin" class="form-label">Login*</label>
                      <input type="text" name="login" id="inputLogin" class="form-control" placeholder="Input your login" aria-label="Login" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputPassword" class="form-label">Password*</label>
                      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Input your password" aria-label="Password" minlength="6" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputEmail" class="form-label">Email*</label>
                      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Input your Email" aria-label="Email" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputPhone" class="form-label">Phone</label>
                      <input type="phone" name="phone_number" id="inputPhone" class="form-control" placeholder="Input your Phone number" aria-label="Phone">
                    </div>
                    <div class="col-md-4">
                      <label for="inputFirstName" class="form-label">First name*</label>
                      <input type="text" name="first_name" id="inputFirstName" class="form-control" placeholder="Input your first name" aria-label="First name" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputLastName" class="form-label">Last name*</label>
                      <input type="text" name="last_name" id="inputLastName" class="form-control" placeholder="Input your last name" aria-label="Last name" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputMiddleName" class="form-label">Middle name</label>
                      <input type="text" name="middle_name" id="inputMiddleName" class="form-control" placeholder="Input your middle name" aria-label="Middle name">
                    </div>
                    <div class="col-md-4">
                      <label for="inputStreet" class="form-label">Street*</label>
                      <input type="text" name="street" id="inputStreet" class="form-control" placeholder="1234 Main St" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputHouse" class="form-label">House*</label>
                      <input type="text" name="house_number" id="inputHouse" class="form-control" placeholder="House number" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputApartment" class="form-label">APT number</label>
                      <input type="text" name="apartment_number" id="inputApartment" class="form-control" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="col-md-4">
                      <label for="inputCity" class="form-label">City*</label>
                      <input id="inputCity" name="city" class="form-control" placeholder="Apartment, studio, or floor" required>
                    </div>
                    <div class="col-md-4">
                      <label for="inputState" class="form-label">State*</label>
                      <select id="inputState" name="state" class="form-select" required>
                        <option value="" disabled selected>Choose state...</option>
                        <?php
                          foreach ((new \App\Model\StateMapper())->getStates() as $state) {
                        ?>
                        <option value="<?= $state->getName() ?>"><?= $state->getName() ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Zip</label>
                      <input type="text" name="postcode" class="form-control" id="inputZip">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <h6>* All fields marked with an asterisk are required</h6>
          </div>
          <div class="col-12 col-lg-6 my-5 border-start what-register-give">
            <h3 class="text-center">What does account registration give?</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">You will be able to view your order history</li>
              <li class="list-group-item">You can change your data on the site</li>
              <li class="list-group-item">You will be able to get discounts and participate in Promotions</li>
              <li class="list-group-item">You will not lose your shopping cart if you are away for a long time or log into the site from another device</li>
              <li class="list-group-item">We will save for you a list of the products you viewed during your last visit to our site.</li>
            </ul>
          </div>
          <button type="submit" form="checkout" class="btn btn-primary btn-lg mx-auto">Checkout</button>
        </div>
      </div>