<?php
include_once './connect.php';

$table_detail ='';
$product_name_in_table ='';
$customer_name='';
$email='';
$note='';

$sql_select_product = "SELECT * FROM tbl_product";
$query_select_product = mysqli_query($connect, $sql_select_product);

$sql_order_view = "SELECT * FROM tbl_order ORDER BY id DESC LIMIT 1";
$query_order_view = mysqli_query($connect, $sql_order_view);
$row_order_view = mysqli_fetch_array($query_order_view);
$order_id = $row_order_view["id"];


    $customer_name = $row_order_view["customer_name"];
    $email = $row_order_view["email"];
    $order_id = $row_order_view["id"];
    $note = $row_order_view["order_note"];


//$order_id = $row_order_view["id"];

$sql_detail = "SELECT * FROM tbl_order_detail WHERE order_id='$order_id'";
$query_detail = mysqli_query($connect, $sql_detail);
$number_row = 1;
while ($row_table_body = mysqli_fetch_array($query_detail)) {

    while ($row_select_product = mysqli_fetch_array($query_select_product)){
        if ($row_select_product["id"] == $row_table_body["product_id"] ){
            $product_name_in_table = $row_select_product["product_name"];
        }
    }
    
    $table_detail .= '
            <tr>
                <td>' . $number_row. '</td>
                <td>' . $product_name_in_table . '</td>
                <td>' . $row_table_body["product_quantity"] . '</td>
                <td>' . $row_table_body["product_price"] . '</td>
                <td>' . $row_table_body["product_quantity"]*$row_table_body["product_price"]. '</td>
            </tr>
    ';
    $number_row++;
}
    $table_detail .= '
                <tr>
                    <td colspan="4">Total</td>
                    <td>' . $row_order_view["order_total"]. '</td>
                </tr>
        ';
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Your cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>



    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


  </head>
  <body>

<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="index.php" class="navbar-brand d-flex align-items-center">
        <i class="fas fa-truck"></i>
        <strong>MYSTORE</strong>
      </a>
      <a href="#" class="navbar-brand d-flex align-items-center">
        <i class="fas fa-user-tie"></i>
      </a>
    </div>
  </div>
</header>

<main>
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Vending Machine Page</h1>
        <p class="lead text-muted">Thanks for buying at MyStore!</p>
        <p class="lead text-muted">Here is your check!</p>
      </div>
    </div>
  </section>
  <div class="container">
  <table class='table table-hover' id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="all_items">
        <?php
            echo $table_detail;
        ?>
        </tbody>
    </table>
    </div>

    <div class="container">
  <div class="row">
    <div class="col-sm">
    <strong>Customer:</strong>
       <?php
      echo $customer_name;
      ?>
    </div>
    <div class="col-sm">
    <strong>Email:</strong>
     <?php
      echo $email;
      ?>
    </div>
    </div>
    <strong>Note:</strong>
    <?php
    echo $note;
    ?>
  </div>

</div>
</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="mb-1">Copyright &copy; MYSTORE</p>
  </div>
</footer>
      

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>


  </body>
</html>