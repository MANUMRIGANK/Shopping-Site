<?php
require_once('config.php');
global $conn;
if (isset($_SERVER['HTTP_REFERER'])) {
    $last_url = $_SERVER['HTTP_REFERER'];
}

if (isset($_GET['remove'])) {
    $pro_id_to_add = $_GET['remove'];
    if ($_SESSION['product_' . $pro_id_to_add] > 0) {
        $_SESSION['product_' . $pro_id_to_add]--;
        $_SESSION['just_for_green_circle_number']--;
    }
    redirect($last_url);
}
if (isset($_GET['delete'])) {
    $pro_id_to_add = $_GET['delete'];
    $_SESSION['just_for_green_circle_number'] -= $_SESSION['product_' . $pro_id_to_add];
    $_SESSION['product_' . $pro_id_to_add] = null;
    redirect($last_url);
}
if (isset($_GET['add'])) {
    $pro_id_to_add = $_GET['add'];
    $sql = "SELECT * FROM `products` WHERE product_id='$pro_id_to_add'";
    $execute = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($execute)) {
        if ($row['product_quantity'] != $_SESSION['product_' . $row['product_id']]) {
            $_SESSION['product_' . $row['product_id']] += 1;
            $_SESSION['just_for_green_circle_number'] += 1;
            redirect($last_url);
        } else {
            $_SESSION['failmsg'] = "We only have " . $row['product_quantity'] . " Quantity Available";
            redirect("Frontend/checkout.php");
        }
    }
}

function cart()
{
    $sub_total = null;
    $_SESSION['total'] = 0;
    $_SESSION['item_count'] = 0;
    foreach ($_SESSION as $name => $value) {

        if ($value > 0) {

            if (substr($name, 0, 8) == 'product_') {
                $length = strlen($name);
                $id = substr($name, 8, $length);





                global $conn;
                $sql = "SELECT * FROM `products` Where product_id = '$id'";
                $display_fetch =  mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($display_fetch)) {
                    $qtyincart = $_SESSION['product_' . $row['product_id']];
                    $sub_total = $qtyincart * $row['product_price'];
                    $_SESSION['item_count'] += $qtyincart;
                    $_SESSION['total'] += $sub_total;
                    echo <<<html
                            <tr>
                            <td>{$row['product_name']}</td>
                            <td><span>&#8377;</span>{$row['product_price']}</td>
                            <td>{$qtyincart}</td>
                            <td>{$sub_total}</td>
                            <td>
                                <div class="btn-group">
                                    <a type="button" class="btn btn-success" href="../cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
                                    <a type="button" class="btn btn-warning" href="../cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                                    <a type="button" class="btn btn-danger" href="../cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                            </td>

                            </tr>
                    html;
                }
            }
        }
    }
}
