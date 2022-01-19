            <div class="border border-info border-2 rounded p-3">
              <form action="?do=set_password" method="post">
                <label for="setPassword" class="form-label">Password *</label>
                <div class="input-group mb-3">
                  <input type="hidden" name="id" value="<?= $data->main_data->getId(); ?>">
                  <input type="password" name="password" class="form-control" id="setPassword" placeholder="Input Your new password" aria-describedby="setPassword" minlength="6" required>
                  <button class="btn btn-outline-secondary" type="submit">Submit</button>
                </div>
              </form>
            </div>