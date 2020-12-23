<?php
include_once './connect.php';
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
$table_partners = '';
$modal_edit = '';
$modal_delete = '';

$sql_table_body = "SELECT * FROM tbl_product ORDER BY id DESC";
$query_table_body = mysqli_query($connect, $sql_table_body);

if (mysqli_num_rows($query_table_body) > 0) {
    while ($row_table_body = mysqli_fetch_array($query_table_body)) {

        //--------------- Start TABLE BODY ---------------
        $table_partners .= '
                <tr>
                    <td><a id="td-' . $row_table_body["id"] . '">' . $row_table_body["id"] . '<a></td>
                    <td>' . $row_table_body["product_name"] . '</td>
                    <td>' . $row_table_body["product_unit_price"] . '</td>
                    <td>' . $row_table_body["product_unit"] . '</td>
                    <td>' . $row_table_body["product_stock"] . '</td>
                    <td><a href="delete-product.php?id=' . $row_table_body["id"] . '"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
        ';
    }
}

if (isset($_POST["submit"])) {
    $product_name = $_POST["product_name"];
    $product_unit_price = $_POST["product_unit_price"];
    $product_unit = $_POST["product_unit"];
    $product_stock = $_POST["product_stock"];

    $upload_dir = "images/products/";
    $fileName = basename($_FILES["product_image"]["name"]);
    $targetFilePath = $upload_dir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
            $product_image = $fileName;
        }
    }

    

    if (isset($product_name) && isset($product_unit_price) && isset($product_unit) && isset($product_image) && isset($product_stock) && isset($product_image)) {
        $sql = "INSERT INTO tbl_product (
            product_name,
            product_unit_price,
            product_unit,
            product_image,
            product_stock
            )
            VALUES (
            '$product_name',
            '$product_unit_price',
            '$product_unit',
            '$product_image',
            '$product_stock'
            )";
    $query = mysqli_query($connect, $sql);
              
    header('location: admin.php?page_layout=product');
    }         
}

?>

<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add a new product</h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form role="form" method="post" enctype="multipart/form-data">

                <div class="form-body">
                    <div class="row">
                    <div class="col-md-8 col-12">
                        <div class="form-group">
                        <label for="" class="form-label">Product name</label>
                        <input type="text" id="" class="form-control" name="product_name"
                            placeholder="Product name"  required>
                        </div>

                        <div class="form-group">
                        <label for="" class="form-label">Unit</label>
                        <input type="text" id="" class="form-control" name="product_unit"
                            placeholder="Unit"  required>
                        </div>

                        <div class="form-group">
                        <label for="" class="form-label">Unit price</label>
                        <input type="text" id="" class="form-control" name="product_unit_price"
                            placeholder="Unit price"  required>
                        </div>


                        <div class="form-group">
                        <label for="" class="form-label">Quantity</label>
                        <input type="text" id="" class="form-control" name="product_stock"
                            placeholder="Quantity"  required>
                        </div>
                    </div>


                    <div class="col-md-4 col-12">
                        <div class="form-group">

                            <label for="" class="form-label">Product image</label>
                            <div class="form-file">

                                        <input type="file" class="form-file-input" name="product_image" id="file-upload" value="" required>
                                        
                            </div>
                        </div>
                    </div>

                    </div>


                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1 mb-1" name="submit">Add</button>
                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="container">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Product</th>
                <th scope="col">Unit</th>
                <th scope="col">Unit price</th>
                <th scope="col">Quantity</th>
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
</section>
