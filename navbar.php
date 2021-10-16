<!DOCTYPE html>
<html lang="en">
<?php
require 'Php/connection.php';
session_start();
$cookie_name = "logged";
$logged = false;
$result2 = '';
if (!isset($_COOKIE[$cookie_name])) {
    // header("Location: login.php");
    // header("Location:Loging.php?error=redirectfromHome");
    $logged = false;
} else if (isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name]) {
    $sql2 = "SELECT * FROM cart c INNER JOIN products p ON c.itemid=p.id WHERE userid=" . $_SESSION['user_id'] . " AND status=0";
    $result2 = mysqli_query($conn, $sql2);
    $logged = true;
} else {
    $logged = false;
}
// print_r($_SESSION);


$sql = "SELECT * FROM products ORDER BY sold DESC LIMIT 6";
$producttop[] = array();
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_image = $row['img'];
        $product_quantity = $row['qty'];
        $product_sold = $row['sold'];
        $unit = $row['unit'];
        $item = [
            "id" => $product_id,
            "name" => $product_name,
            "price" => $product_price,
            "img" => $product_image,
            "qty" => $product_quantity,
            "sold" => $product_sold,
            "unit" => $unit

        ];
        array_push($producttop, $item);
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">



    <style>
        body {
            font-family: "Open Sans", sans-serif;
        }

        h2 {
            color: #333;
            text-align: center;
            text-transform: uppercase;
            font-family: "Roboto", sans-serif;
            font-weight: bold;
            position: relative;
            margin: 30px 0 60px;
        }

        h2::after {
            content: "";
            width: 100px;
            position: absolute;
            margin: 0 auto;
            height: 3px;
            background: #8fbc54;
            left: 0;
            right: 0;
            bottom: -10px;
        }

        .col-center {
            margin: 0 auto;
            float: none !important;
        }

        .carousel {
            padding: 0 70px;
        }

        .carousel .carousel-item {
            color: #999;
            font-size: 14px;
            text-align: center;
            overflow: hidden;
            min-height: 290px;
        }

        .carousel .carousel-item .img-box {
            width: 135px;
            height: 135px;
            margin: 0 auto;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 50%;
        }

        .carousel .img-box img {
            width: 100%;
            height: 100%;
            display: block;
            border-radius: 50%;
        }

        .carousel .testimonial {
            padding: 30px 0 10px;
        }

        .carousel .overview {
            font-style: italic;
        }

        .carousel .overview b {
            text-transform: uppercase;
            color: #7AA641;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            margin-top: -20px;
            top: 50%;
            background: none;
        }

        .carousel-control-prev i,
        .carousel-control-next i {
            font-size: 68px;
            line-height: 42px;
            position: absolute;
            display: inline-block;
            color: rgba(0, 0, 0, 0.8);
            text-shadow: 0 3px 3px #e6e6e6, 0 0 0 #000;
        }

        .carousel-indicators {
            bottom: -40px;
        }

        .carousel-indicators li,
        .carousel-indicators li.active {
            width: 12px;
            height: 12px;
            margin: 1px 3px;
            border-radius: 50%;
            border: none;
        }

        .carousel-indicators li {
            background: #999;
            border-color: transparent;
            box-shadow: inset 0 2px 1px rgba(0, 0, 0, 0.2);
        }

        .carousel-indicators li.active {
            background: #555;
            box-shadow: inset 0 2px 1px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+94712852054</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">Foodsysterm@gmail.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/Foodsysterm/index.php">FOOD MART</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ((strpos($_SERVER['REQUEST_URI'], "index") !== false) ? 'active' : '') ?>"><a href="/Foodsysterm/index.php" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown <?php echo ((strpos($_SERVER['REQUEST_URI'], "shop") !== false) ? 'active' : '') ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="/Foodsysterm/shop.php">All Product</a>
                            <a class="dropdown-item" href="/Foodsysterm/vegetable.php">Vegetable</a>
                            <a class="dropdown-item" href="/Foodsysterm/Fruits.php">Fruits</a>
                            <a class="dropdown-item" href="/Foodsysterm/Jucie.php">Drinks</a>
                            <a class="dropdown-item" href="/Foodsysterm/Dried.php">Dried</a>
                        </div>
                    </li>
                    <li class="nav-item <?php echo ((strpos($_SERVER['REQUEST_URI'], "about") !== false) ? 'active' : '') ?>"><a href="/Foodsysterm/about.php" class="nav-link">About Us</a></li>
                    <li class="nav-item <?php echo ((strpos($_SERVER['REQUEST_URI'], "contact") !== false) ? 'active' : '') ?>"><a href="/Foodsysterm/contact.php" class="nav-link">Contact</a></li>
                    <?php if (!$logged) {
                    ?>
                        <li class="nav-item"><a href="/Foodsysterm/Loging.php" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="/Foodsysterm/Signup.php" class="nav-link">Register</a></li>
                    <?php } ?>
                    <li class="nav-item cta cta-colored <?php echo ((strpos($_SERVER['REQUEST_URI'], "cart") !== false) ? 'active' : '') ?>"><a href="/Foodsysterm/cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?php echo (isset($_COOKIE[$cookie_name])) ? $result2->num_rows : '0' ?>]</a></li>
                    <?php if ($logged) {
                    ?>
                        <li class="nav-item float-right"><a href="/Foodsysterm/logout.php" class="nav-link">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>