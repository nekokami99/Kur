<?php 
include_once './connect.php';
if (isset($_GET["id"])) {
    $product_id = $_GET["id"];
    $sql_delete = "DELETE FROM tbl_product WHERE id='$product_id'";
    $query_delete = mysqli_query($connect, $sql_delete);
    header('location: admin.php?page_layout=product');
}

?>