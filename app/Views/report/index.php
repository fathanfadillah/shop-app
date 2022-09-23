<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Shop App</title>
  </head>
  <body>
    <div class="container">
        <h1 class="text-center">Report</h1>

        <form action="/report/filter" method="post">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col">
              <select class="form-select" aria-label="Default select example" name="area">
                <option value="" selected>Select Area</option>
                <?php foreach ($areaQuery as $element) : ?>      
                  <option value="<?= $element['area_id']?>"><?= $element['area_name']?></option>  
                <?php endforeach;?>
              </select>
            </div>
            <div class="col">
              <label for="dateFrom">Date From :</label>
              <input type="date" name="dateFrom">
            </div>
            <div class="col">
              <label for="dateFrom">Date To :</label>   
              <input type="date" name="dateTo">
            </div>
            <div class="col">
              <button type="submit">VIEW</button>
            </div>
          </div>
        </form>
        
      <div class="mt-5">
        <h2>Bar</h2>
        <div>
          <canvas id="myChart" width="400" height="400"></canvas>
        </div>
      </div>
      
      <div class="mt-5">
        <h2>Table</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">brand</th>
                <?php foreach ($averageCompliances as $product) : ?>
                  <th scope="col"><?= $product->store_area?></th>
                <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($averageProductsPerArea as $key=>$product) : ?>
                <tr>
                  <td>
                    <?= $key ?>
                  </td>
                <?php foreach ($product as $productDetail) : ?>
                  <td><?= $productDetail->compliance ?></td>
                <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <script>
      const labels = []
      const data =  []
      
      <?php foreach ($averageCompliances as $element) : ?>
        labels.push(`<?= $element->store_area?>`)
        data.push(<?= $element->compliance?>)  
      <?php endforeach;?>         
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Nilai",
                data: data,
                backgroundColor: [
                  "rgb(124, 181, 236)",
                ],
                borderWidth: 1,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              yAxes: {
                ticks: {
                  min: 0,
                  stepSize: 10,
                  max: 100
                },
              },
            },
          },
        });
    </script>
  </body>
</html>