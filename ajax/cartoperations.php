<?php
require '../Php/connection.php';

if (isset($_GET['id']) && $_GET['op'] == 'inc') {
    $sql = "UPDATE cart SET qty=(qty+1) WHERE cart_id=" . $_GET['id'];
    $result = $conn->query($sql);
    echo $result;
} else if (isset($_GET['id']) && $_GET['op'] == 'dec') {
    $sql = "UPDATE cart SET qty=(qty-1) WHERE cart_id=" . $_GET['id'];
    $result = $conn->query($sql);
    echo $result;
}
