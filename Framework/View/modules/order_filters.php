              <h2 class="py-2">Order filters</h2>
              <form id="search" action="" method="POST" class="mb-3">
                <label for="order_search">Search order by number or date*</label>
                <div class="input-group">
                  <input type="text" id="order_search" class="form-control" name="search" placeholder="Search order number" aria-label="Search order number" aria-describedby="button_order_search">
                  <button class="btn btn-outline-secondary" type="submit" id="button_order_search" title="Search order number">Search</button>
                </div>
                <small>* Date search format: YYYY-MM-DD</small>
              </form>
              <form id="show_by" action="" method="get">
                <label for="order_search">Sorting quantity per page and orientation:</label>
                <div class="input-group mb-3">
                  <select class="form-select" id="order_search" name="show_by" aria-label="Select quantity per page" onchange="this.form.submit()">
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
              <form id="select_order_dates" action="" method="get">
                <label for="orders_dates_from">Orders from date:</label>
                <input id="orders_dates_from" class="form-control" type="datetime-local" name="orders_dates_from" value="" step="1" min="" max="">
                <button href="" type="submit" class="btn btn-success mt-3">Search by date</button>
              </form>