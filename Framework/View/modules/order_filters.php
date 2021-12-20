              <h2 class="py-2">Order filters</h2>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="order_search" placeholder="Order number or date" aria-label="Search order" aria-describedby="button_order_search" disabled>
                <button class="btn btn-outline-secondary disabled" type="button" id="button_order_search" title="Search order">Search</button>
              </div>
              <form id="show_by" action="" method="get">
                <div class="input-group mb-3">
                  <select class="form-select" name="show_by" aria-label="Default select example" onchange="this.form.submit()">
                    <option value="" selected disabled>Show by:</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                  </select>
                  <?php
                    if ($order_by === 'ASC') {
                  ?>
                  <a href="?order_by=DESC" class="btn btn-outline-secondary" type="button" id="button_ordered_asc" title="Sorted ascending"><i class="bi bi-caret-up"></i></a>
                  <?php
                    } else {
                  ?>
                  <a href="?order_by=ASC" class="btn btn-outline-secondary" type="button" id="button_ordered_desc" title="Sorted descending"><i class="bi bi-caret-down"></i></a>
                  <?php
                    }
                  ?>
                </div>
              </form>