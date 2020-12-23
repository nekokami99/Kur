<?php
ob_start();
session_start();
include_once './connect.php';

$show_products = '';
$input_hidden_product_price = '';
$input_hidden_product_stock = '';
$input_hidden_product_name = '';

$sql_table_body = "SELECT * FROM tbl_product ORDER BY id DESC";
$query_table_body = mysqli_query($connect, $sql_table_body);

if (mysqli_num_rows($query_table_body) > 0) {
    while ($row_table_body = mysqli_fetch_array($query_table_body)) {
        $show_products .= '
            <div class="col">
              <div class="card shadow-sm">
              <image class="bd-placeholder-img card-img-top" width="100%" height="100%" src="images/products/' . $row_table_body["product_image"] . '">

                <div class="card-body" style="border-top: 1px solid rgba(0,0,0,.125)">
                  <p class="card-text"><strong>' . $row_table_body["product_name"] . '</strong></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary" onclick="add_to_cart(' . $row_table_body["id"] . ')">Add to cart</button>
                      <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#view_cart">View cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        ';
        $input_hidden_product_price .= '
                                        <input type="hidden" id="product_price' . $row_table_body["id"] . '" value="' . $row_table_body["product_unit_price"] . '" required>
                                    ';

        $input_hidden_product_stock .= '
                                        <input type="hidden" id="product_stock' . $row_table_body["id"] . '" value="' . $row_table_body["product_stock"] . '" required>

                                    ';
        $input_hidden_product_name .= '
                                        <input type="hidden" id="product_name' . $row_table_body["id"] . '" value="' . $row_table_body["product_name"] . '" required>

                                    ';
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
    <title>Album example · Bootstrap v5.0</title>
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
      <a href="login.php" class="navbar-brand d-flex align-items-center">
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
        <p class="lead text-muted">This is our Main page. You will find all of our products in here!</p>
      </div>
    </div>
  </section>


  <!--Start modal cart-->
  <div class="modal fade" id="view_cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="view_cart_title">View cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                                                    <table class='table table-hover' id="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Product name</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="all_items">
                                                        </tbody>
                                                    </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a type="button" class="btn btn-primary" href="view-cart.php">Go to check out</a>
        </div>
      </div>
    </div>
  </div>

                                                    <!--End Modal cart-->

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
echo $show_products;
echo $input_hidden_product_price;
echo $input_hidden_product_stock;
echo $input_hidden_product_name;
?>

      </div>
    </div>
  </div>

</main>



<script>
      function empty_cart(){
            var action = "empty";
            $.ajax({
                url: "cart-store.php",
                type: "POST",
                data: {action: action},
                success: function(){
                    alert("Empty cart");;
                    load_cart_data();
                }
            });
        };
        function delete_cart_item(id){
            var action = "remove";
            var product_id = id;
            $.ajax({
                url: "cart-store.php",
                type: "POST",
                data: {
                    action: action,
                    product_id: product_id
                },
                success: function(){
                    alert("Delete item!");;
                    load_cart_data();
                }
            });
        };
        function update_item_quantity(id){
            var product_quantity = $("#input_product_quantity"+id).val();
            var product_stock = $("#product_stock"+id).val();
            var action = "update";
            var product_id = id;
            if (product_quantity == 0){
              alert("Quantity = 0 => Delete item!");;
                delete_cart_item(id);
            } else if (product_quantity > 0) {
                if( (parseInt(product_stock) - parseInt(product_quantity)) >= 0){
                    $.ajax({
                        url: "cart-store.php",
                        type: "POST",
                        data: {
                            action: action,
                            product_id: product_id,
                            product_quantity: product_quantity
                        },
                        success: function(){
                            load_cart_data();
                        }
                    });
                } else {
                  alert("Stock is not enough ("+ product_stock +"). Try again!");;
                    $("#form_product_quantity"+id)[0].reset();
                }
            } else {
              alert("Quantity < 0. Try again!");;
                $("#form_product_quantity"+id)[0].reset();
            };
        }
        function add_to_cart(id){
            var product_id = id;
            var product_name = $("#product_name" + product_id).val();
            var product_price = $("#product_price" + product_id).val();
            var product_stock = $("#product_stock" + product_id).val();
            var product_quantity = "1";
            var action = "add";
            var form_data = new FormData();
            form_data.append("product_id", product_id);
            form_data.append("product_name", product_name);
            form_data.append("product_price", product_price);
            form_data.append("product_quantity", product_quantity);
            form_data.append("product_stock", product_stock);
            form_data.append("action", action);
            $.ajax({
                url: "cart-store.php",
                type: "POST",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(){
                    alert("\""+ product_name + "\" has been added into cart!");
                    load_cart_data();
                }
            });
        }
        function load_cart_data(){
            $.ajax({
                url: "get-cart.php",
                type: "POST",
                success: function(value){
                    var data = value.split(",");
                    $('#all_items').html(data[0]);
                }
            });
        };
        load_cart_data();
</script>
<footer class="text-muted py-5">
  <div class="container">
    <p class="mb-1">Copyright &copy; MYSTORE</p>
  </div>
</footer>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>


  </body>
</html>
