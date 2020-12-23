<?php 
include_once './connect.php';
if (isset($_GET["id"])) {
    $order_id = $_GET["id"];
    $sql_delete = "DELETE FROM tbl_order WHERE id='$order_id'";
    $query_delete = mysqli_query($connect, $sql_delete);
    header('location: admin.php?page_layout=order');
}

?>