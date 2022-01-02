<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i" rel="stylesheet">
  <link rel="shortcut icon" href="/src/images/favicon.ico" />
  <link rel="icon" type="image/vnd.microsoft.icon" href="/src/images/favicon.ico">
  <link rel="icon" type="image/x-icon" href="/src/images/favicon.ico">
  <link rel="icon" href="/src/images/favicon.ico" /> 
  <title>Homework #15: JavaScript. LocalStorage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    code {
      display: block;
      padding: 0.5em;
      background: #F0F0F0;
    }
    code:hover {
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-10 offset-1 mt-3">
        <div class="d-inline-flex w-100 links">
          <a href="#import_json" class="btn btn-outline-success ms-0 me-2 storage">Import data to LocalStorage</a>
          <a href="#clear_ls" class="btn btn-outline-danger ms-0 me-2 storage">Clear data from LocalStorage</a>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-10 offset-1 logs">
        <div class="d-inline-flex justify-content-between align-items-center w-100">
          <div class="rounded-top ps-2 pt-2 pb-1 bg-secondary text-warning w-100">
            <h5>Console:</h5>
          </div>
        </div>
        <div id="results" style="color: #fff; border: 1px solid #000; padding: 10px; width: auto; height: 400px; overflow-y: auto; background: #2b2b2b;"></div>
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text rounded-0" id="commang_Line_start">></span>
          <input id="console_line" type="text" class="form-control bg-dark text-light border-dark rounded-0" placeholder="Type or paste your command line here" autofocus>
        </div>
        <div class="commands-list mt-3">
          <div class="row mt-3">
            <div class="col-6">
              <h5>Accepted commands (click to copy):</h5>
            </div>
            <div class="col-6">
              <h5>Description of the commands:</h5>
            </div>
            <div class="col-12"><hr class="my-1"></div>
            <div class="col-6">
              <code>/show --average-age</code>
            </div>            
            <div class="col-6">
              <p class="mb-0">Show awerage age of peoples in list</p>
            </div>
            <div class="col-12"><hr class="my-1"></div>
            <div class="col-6">
              <code>/show --max-lang-count</code>
            </div>
            <div class="col-6">
              <p class="mb-0">Show max languages from peoples list</p>
            </div>
            <div class="col-12"><hr class="my-1"></div>
            <div class="col-6">
              <code>/show --count-female</code>
            </div>
            <div class="col-6">
              <p class="mb-0">Show the count of girls</p>
            </div>
            <div class="col-12"><hr class="my-1"></div>
            <div class="col-6">
              <code>/show --count-male</code>
            </div>
            <div class="col-6">
              <p class="mb-0">Show count of guys</p>
            </div>
            <div class="col-12"><hr class="my-1"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="assets/js/homework15.js"></script>

</body>
</html>
