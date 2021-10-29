<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
session_start();
require 'Php/connection.php';
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$city = $_POST['city'];
$pcode = $_POST['pcode'];
$paymentMethod = $_POST['pay'];

$total = $_POST['total'];

$last_id = 0;

$sql = "INSERT INTO orders(fname, lname, addr1, addr2, city, zip, phone, email, total, payment_method) VALUES ('$fname', '$lname', '$addr1', '$addr2', '$city', '$pcode', '$mobile', '$email', '$total', '$paymentMethod')";
$result = $conn->query($sql);

if ($result) {
    $last_id = $conn->insert_id;
    //cart to details
    $sqlcart = "SELECT * FROM cart WHERE userid = '" . $_SESSION['user_id'] . "'";
    $cartdata = $conn->query($sqlcart);
    if ($cartdata->num_rows > 0) {
        while ($row = $cartdata->fetch_assoc()) {
            $sql = "INSERT INTO order_details(order_id, item_id, qty) VALUES ('$last_id', '" . $row['itemid'] . "', '" . $row['qty'] . "')";
            $conn->query($sql);
            //reduce qty
            $sql3 = "UPDATE products SET qty = qty - " . $row['qty'] . ",sold=sold+" . $row['qty'] . " WHERE id = '" . $row['itemid'] . "'";
            $conn->query($sql3);
        }
    }
    //delete cart
    $sql = "DELETE FROM cart WHERE userid = '" . $_SESSION['user_id'] . "'";
    $conn->query($sql);

    if ($paymentMethod == 'Cash On Delivery') {
        header("Location: orderdone.php?ordid=$last_id");
    }
}
?>

<body onload="submit()" style="display: none">
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        <input type="hidden" name="merchant_id" value="1219027">
        <input type="hidden" name="return_url" value="http://localhost/foodsysterm/orderdone.php">
        <input type="hidden" name="cancel_url" value="http://localhost/foodsysterm/checkout.php">
        <input type="hidden" name="notify_url" value="http://localhost/foodsysterm/payherenotify.php">
        <br><br>Item Details<br>
        <input type="text" name="order_id" value="<?php echo $last_id ?>">
        <input type="text" name="items" value="<?php echo $last_id ?>"><br>
        <input type="text" name="currency" value="LKR">
        <input type="text" name="amount" value="<?php echo $total ?>">
        <br><br>Customer Details<br>
        <input type="text" name="first_name" value="<?php echo $fname ?>">
        <input type="text" name="last_name" value="<?php echo $lname ?>"><br>
        <input type="text" name="email" value="<?php echo $email ?>>
        <input type=" text" name="phone" value="<?php echo $mobile ?>"><br>
        <input type="text" name="address" value="<?php echo $addr1 . ' ' . $addr2 ?>">
        <input type="text" name="city" value="<?php echo $city ?>">
        <input type="hidden" name="country" value="Sri Lanka"><br><br>
        <input type="submit" value="Buy Now">
    </form>
</body>
<script>
    function submit() {
        document.forms[0].submit();
    }
</script>

</html>