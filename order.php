<?php
include_once './connect.php';
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

$table_partners = '';
$modal_edit = '';
$modal_delete = '';

$sql_table_body = "SELECT * FROM tbl_order ORDER BY id DESC";
$query_table_body = mysqli_query($connect, $sql_table_body);

if (mysqli_num_rows($query_table_body) > 0) {
    while ($row_table_body = mysqli_fetch_array($query_table_body)) {

        //--------------- Start TABLE BODY ---------------
        $table_partners .= '
                <tr>
                    <td><a id="td-' . $row_table_body["id"] . '">' . $row_table_body["id"] . '<a></td>
                    <td>' . $row_table_body["customer_name"] . '</td>
                    <td>' . $row_table_body["email"] . '</td>
                    <td>' . $row_table_body["order_time"] . '</td>
                    <td>' . $row_table_body["order_note"] . '</td>
                    <td>' . $row_table_body["order_payment"] . '</td>
                    <td>' . $row_table_body["order_total"] . '</td>
                    <td><a href="delete-order.php?id=' . $row_table_body["id"] . '"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
        ';
    }
}


?>

<div class="d-grid gap-2 d-md-block" style="margin: 10px">
    
</div>


<div class="container">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Customer</th>
                <th scope="col">Email</th>
                <th scope="col">Order time</th>
                <th scope="col">Order note</th>
                <th scope="col">Order payment</th>
                <th scope="col">Order total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
           echo $table_partners;
           ?>
        </tbody>
    </table> 
</div>