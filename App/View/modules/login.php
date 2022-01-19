        <div class="col-12 col-lg-4 offset-lg-4 my-5">
          <h1 class="text-center">Please log in! *</h1>
          <?= $errors_block; ?>
          <div class="card">
            <div class="card-body">
              <form action="?do=login" method="POST" autocomplete="off">
                <div class="mb-3">
                  <label for="Login" class="form-label">Login or Email address</label>
                  <input type="login" name="login" class="form-control" id="Login" required>
                </div>
                <div class="mb-3">
                  <label for="Password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="Password" minlength="6" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">login</button>
              </form>
            </div>
          </div>
          <h6>* All fields are required</h6>
        </div>
        <div class="col-12 col-lg-4 offset-lg-4 mb-5">
          <p><b>No account yet?</b> <a href="/user/registration">User Registration</a></p>
          <p><b>Forgot Password?</b> <a href="/user/reset">Reset</a></p>
        </div>