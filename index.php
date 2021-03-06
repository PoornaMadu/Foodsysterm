<!DOCTYPE html>
<html lang="en">
<?php
require 'Php/connection.php';

$sql = "SELECT * FROM products WHERE qty>0 ORDER BY sold DESC LIMIT 6";
$producttop[] = array();
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		array_push($producttop, $row);
	}
}
?>

<head>
	<title>Food Mart.Store</title>
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

<body class="goto-here">
	<?php include 'navbar.php' ?>
	<?php
	if (isset($_GET['id']) && isset($_GET['qty'])) {
		$id = $_GET['id'];
		$qty = $_GET['qty'];
		$user_id = $_SESSION['user_id'];
		$checksql = "SELECT * FROM cart WHERE itemid=$id AND userid=$user_id AND status=0";
		$checkresult = mysqli_query($conn, $checksql);
		if (mysqli_num_rows($checkresult) > 0) {
			echo "<script>alert('Item Already added to cart!!');</script>";
			echo "<script>window.open('index.php','_self');</script>";
			return 0;
		}
		$sql = "INSERT INTO cart(userid, itemid, qty, status) VALUES ('$user_id','$id','$qty','0')";
		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('Successfully added to cart');</script>";
			echo "<script>window.open('cart.php','_self');</script>";
		} else {
			echo "<script>alert('Something went wrong');</script>";
			echo "<script>window.open('index.php','_self');</script>";
		}
	}
	?>
	<!-- Slide menu -->
	<section id="home-section" class="hero">
		<div class="home-slider owl-carousel">
			<div class="slider-item" style="background-image: url(images/bg_1.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center">

						<div class="col-md-12 ftco-animate text-center">
							<h1 class="mb-2">We serve Fresh Vegestables &amp; Fruits</h1>
							<h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
							<p><a href="about.php" class="btn btn-primary">View More Details</a></p>
						</div>

					</div>
				</div>
			</div>

			<div class="slider-item" style="background-image: url(images/bg_2.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center">

						<div class="col-sm-12 ftco-animate text-center">
							<h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
							<h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
							<p><a href="/Foodsysterm/shop.php" class="btn btn-primary">View More Details</a></p>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<br>



	<!-- Shope menu -->
	<section class="ftco-section ftco-category ftco-no-pt">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-6 order-md-last align-items-stretch d-flex">
							<div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(images/category.jpg);">
								<div class="text text-center">
									<h2>Vegetables</h2>
									<p>Protect the health of every home</p>
									<p><a href="/Foodsysterm/shop.php" class="btn btn-primary">Shop now</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/category-2.jpg);">
								<div class="text px-3 py-1">
									<h2 class="mb-0"><a href="/Foodsysterm/fruits.php">Fruits</a></h2>
								</div>
							</div>
							<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(images/category-1.jpg);">
								<div class="text px-3 py-1">
									<h2 class="mb-0"><a href="/Foodsysterm/vegetables.php">Vegetables</a></h2>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/category-3.jpg);">
						<div class="text px-3 py-1">
							<h2 class="mb-0"><a href="/Foodsysterm/Jucie.php">Juices</a></h2>
						</div>
					</div>
					<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(images/category-4.jpg);">
						<div class="text px-3 py-1">
							<h2 class="mb-0"><a href="/Foodsysterm/Dried.php">Dried</a></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Featured Products</span>
					<h2 class="mb-4">Our popular Products</h2>
					<p>#01 Fresh and Quality products in Sri Lanka.</p>
				</div>
			</div>
		</div>
		<!-- Product List -->
		<div class="container">
			<div class="row">
				<?php
				foreach ($producttop as $key => $value) {
					if (empty($value)) continue;
					if ($value['qty'] == 0) continue;
					if (!isset($value['old_price'])) continue;
				?>
					<div class="col-md-6 col-lg-3 ftco-animate">
						<div class="product">
							<a href="item.php?id=<?php echo $value['id']; ?>" class="img-prod"><img class="img-fluid" style="width:300px;height:300px;object-fit:cover;" src="images/<?php echo $value['img']; ?>" alt="Beans-1kg">
								<div class="overlay"></div>
							</a>
							<div class="text py-3 pb-4 px-3 text-center">
								<h3><a href="item.php?id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></h3>
								<div class="d-flex">
									<div class="pricing">
										<p class="price"><span class="price">Rs:<?php echo $value['price']; ?> <?php echo $value['unit'] === '' ? '' : (' per ' . $value['unit']); ?></span></p>
										<?php if ($value['old_price'] > $value['price'] && $value['old_price'] != 0) { ?>
											<p class="price"><span class="mr-2 price-dc">Rs. <?php echo $value['old_price']; ?></span></p>
										<?php } ?>
									</div>
								</div>
								<div class="bottom-area d-flex px-3">
									<div class="m-auto d-flex">
										<a href="?id=<?php echo $value['id']; ?>&qty=1" class="buy-now d-flex justify-content-center align-items-center mx-1">
											<span><i class="ion-ios-cart"></i></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</section>

	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row">
				<div class="mouse">
					<a href="/Foodsysterm/index.php" class="mouse-icon">
						<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
					</a>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">FOOD MART</h2>
						<p>Hello,
							We love hearing your thoughts and suggestions.
							You may contact us via;
							Hotline number:+94712852054.</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="https://twitter.com/?lang=en"><span class="icon-twitter"></span></a></li>
							<li class="ftco-animate"><a href="https://www.facebook.com/"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="https://www.instagram.com/?hl=en"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Menu</h2>
						<ul class="list-unstyled">
							<li><a href="/Foodsysterm/shop.php" class="py-2 d-block">Shop</a></li>
							<li><a href="/Foodsysterm/about.php" class="py-2 d-block">About</a></li>
							<li><a href="/Foodsysterm/contact.php" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Help</h2>
						<div class="d-flex">
							<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
								<li><a href="#" class="py-2 d-block">Shipping Information</a></li>
								<li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
								<li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
							</ul>
							<ul class="list-unstyled">
								<li><a href="contact.html" class="py-2 d-block">FAQs</a></li>
								<li><a href="contact.html" class="py-2 d-block">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">56/5 Raja Mawath,Rathmalana</span></li>
								<li><a href="contact.html"><span class="icon icon-phone"></span><span class="text">+94712852054</span></a></li>
								<li><a href="contact.html"><span class="icon icon-envelope"></span><span class="text">Foodsysterm@gmail.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p>
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | <i class="" aria-hidden="true"></i> by <a href="index.html" target="_blank">Food Mart</a>

					</p>
				</div>
			</div>
		</div>
	</footer>




	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>

</body>

</html>