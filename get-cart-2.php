<?php

session_start();

$total_price = 0;

$output = '';
$total_order_input = '';

if (!empty($_SESSION["cart"])) {
    $number_row = 1;
    foreach ($_SESSION["cart"] as $keys => $values) {
        $subtotal = $values["product_price"] * $values["product_quantity"];
        $output .= '
            <tr>
                <td>' . $number_row . '</td>
                <td>' . $values["product_name"] . '</td>

                <td>' . $values["product_quantity"] . '</td>
                <td>' . $values["product_price"] . '</td>
                <td>' . $subtotal . '</td>
            </tr>
        ';
        $number_row++;
        $total_price = $total_price + $subtotal;
    }
    $output .= '
            <tr>
                <td colspan="4" align="right">Subtotal</td>
                <td>' . $total_price . '</td>
            </tr>
    ';
    $total_order_input .= '<input type="number" class="form-control" value="' . $total_price . '" id="order_total" name="order_total" readonly="readonly">';

} else {
    $total_order_input .= '<input type="number" class="form-control" value="0" id="order_total" name="order_total" readonly="readonly">';

    $output .= '
            <tr>
                <td colspan="6" align="center">This cart is empty!</td>
            </tr>
    ';
}

echo $output . "," . $total_order_input;
