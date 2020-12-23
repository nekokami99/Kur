<?php
include_once './connect.php';
session_start();


if (isset($_POST["submit"])) {
    $customer_name = $_POST["customer_name"];
    $email = $_POST["email"];
    $order_note = $_POST["order_note"];
    $order_payment = $_POST["order_payment"];
    $order_total = $_POST["order_total"];
    if (isset($customer_name) && isset($email) && isset($order_note) && isset($order_payment) && isset($order_total)) {
        $sql = "INSERT INTO tbl_order (
            customer_name,
            email,
            order_note,
            order_payment,
            order_total,
            order_time
            )
            VALUES (
            '$customer_name',
            '$email',
            '$order_note',
            '$order_payment',
            '$order_total',
            NOW()
            )";
    $query = mysqli_query($connect, $sql);

    $sql_id = "SELECT * FROM tbl_order ORDER BY id DESC LIMIT 1";
    $query_id = mysqli_query($connect, $sql_id);
    $row_id = mysqli_fetch_array($query_id);
    $order_id = $row_id["id"];

    foreach ($_SESSION["cart"] as $keys => $values) {
        $product_name = $values["product_name"];
        $product_price = $values["product_price"];
        $product_quantity = $values["product_quantity"];
        $product_stock = $values["product_stock"];
        $product_id= $values["product_id"];
        if (isset($order_id)
            && isset($product_id)
            && isset($product_price)
            && isset($product_quantity)) {
            $sql_order_detail = "INSERT INTO tbl_order_detail (
                            order_id,
                            product_id,
                            product_price,
                            product_quantity,
                            created_at
                            )
                            VALUES (
                            '$order_id',
                            '$product_id',
                            '$product_price',
                            '$product_quantity',
                            NOW()
                            )";
            $query_order_detail = mysqli_query($connect, $sql_order_detail);
    
            $value_update_product_stock = $product_stock - $product_quantity;
            $sql_update_product_stock = "UPDATE tbl_product SET
                product_stock = '$value_update_product_stock'
                WHERE id='$product_id'";
            $query_update_product_stock = mysqli_query($connect, $sql_update_product_stock);
    
        }
    }
    unset($_SESSION["cart"]);
    header('location: thanks.php');
    }
}
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
        <p class="lead text-muted">This is your cart. Please add your information</p>
        <p class="lead text-muted">Please make right decision because you can't redo once you had confirmed your cart</p>
      </div>
    </div>
  </section>
  <div class="container">
  
  <div class="row">
    <div class="col">
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
        </tbody>
    </table>
    </div>
    <div class="col">
    <form method ="POST">
        <div class="mb-3" >
            <label for="message-text" class="col-form-label">Customer</label>
            <div>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
        </div>
        <div class="mb-3" >
            <label for="message-text" class="col-form-label">Email</label>
            <div>
            <input type="text" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="mb-3" >
            <label for="message-text" class="col-form-label">Note</label>
            <div>
            <input type="text" class="form-control" id="order_note" name="order_note" required>
            </div>
        </div>
        <div class="mb-3" >
            <label for="message-text" class="col-form-label">Total</label>
            <div id="total_order_input">
            <input type="text" class="form-control" id="order_total" name="order_total">
            </div>
        </div>
        <div class="mb-3">
        <label for="exampleDataList" class="form-label">Payment</label>
            <select class="form-select" aria-label="Default select example" id="order_payment" name="order_payment" required>
                <option value="">Choose payment option</option>
                <option value="Credit">CREDIT</option>
                <option value="Cash">CASH</option>
            </select>
        </div>   
        <div class="modal-footer">
            <a type="button" class="btn btn-secondary" href="index.php">Back</a>
            <button type="submit" class="btn btn-primary" id="submit" name="submit">Confirm cart</button>
        </div>
    </form>
    </div>
  </div>
</div>
</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="mb-1">Copyright &copy; MYSTORE</p>
  </div>
</footer>
      <script>

        function load_cart_data(){
            $.ajax({
                url: "get-cart-2.php",
                type: "POST",
                success: function(value){
                    var data = value.split(",");
                    $('#all_items').html(data[0]);
                    $('#total_order_input').html(data[1]);
                }
            });
        };

        load_cart_data();
      </script>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>


  </body>
</html>
