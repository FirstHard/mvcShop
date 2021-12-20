              <h2 class="py-2">Order filters</h2>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="order_search" placeholder="Search order" aria-label="Search order" aria-describedby="button_order_search" disabled>
                <button class="btn btn-outline-secondary disabled" type="button" id="button_order_search">Search</button>
              </div>
              <div class="mb-3">
                <form id="show_by" action="" method="get">
                  <select class="form-select" name="show_by" aria-label="Default select example" onchange="this.form.submit()">
                    <option value="" selected disabled>Show by:</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                  </select>
                </form>
              </div>