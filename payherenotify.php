<?php
require 'Php/connection.php';
//update order payment id
$order_id = $_POST['order_id'];
$payment_id = $_POST['payment_id'];
$sql = "UPDATE orders SET online_pay_id = '$payment_id' WHERE id = $order_id";
$result = $conn->query($sql);
