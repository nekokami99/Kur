<?php
ob_start();
session_start();
include_once './connect.php';
if (!isset($_SESSION['username'])) {
    header('location: login.php');
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
      
        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle bg-dark" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
  ADMIN<i class="fas fa-user-tie"></i>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><a class="dropdown-item" href="logout.php">Log out</a></li>
  </ul>
</div>
</div>
    </div>
  </div>
</header>

<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Vending Machine Page</h1>
                <p class="lead text-muted">This is the page for admin!</p>
            </div>
        </div>
    </section>

    <div class="container">
        <ul class="nav bg-dark">
            <li class="nav-item">
                <a class="nav-link text-white" href="admin.php?page_layout=product">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin.php?page_layout=order">Order</a>
            </li>
        </ul>

        <?php
            if (isset($_GET["page_layout"])) {
                switch ($_GET["page_layout"]) {
                    case "product":include_once './product.php';
                        break;
                    case "order":include_once './order.php';
                        break;
                    case "order-detail":include_once './order-detail.php';
                        break;
                    default:include_once './admin.php';
                }
            } else {
                include_once './admin.php';
            }
        ?>
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