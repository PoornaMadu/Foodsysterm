<!DOCTYPE html>
<html lang="en">
<?php
require 'Php/connection.php';
if (!isset($_GET['id'])) {
	header('Location: index.php');
}
$sql = "SELECT * FROM products p INNER JOIN category c ON c.id=p.cat_id INNER JOIN nutrients n ON p.id=n.product_id WHERE p.id=" . $_GET['id'];
$data[] = array();
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		array_push($data, $row);
	}
}
if (!isset($data[1])) header('Location: index.php');
$output = $data[1];
$qty = 1;
?>

<head>
	<title><?php echo $output['name']; ?> - Product</title>
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
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", {
			packages: ["corechart"]
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Nutrient', 'quantity'],
				['Protein', <?php echo ($output['n1_unit'] == 'mg' ? $output['n1'] : $output['n1_unit'] == 'g' ? 100 * $output['n1'] : $output['n1']) ?>],
				['Fat', <?php echo ($output['n2_unit'] == 'mg' ? $output['n2'] : $output['n2_unit'] == 'g' ? 100 * $output['n2'] : $output['n2']) ?>],
				['Carbs', <?php echo ($output['n3_unit'] == 'mg' ? $output['n3'] : $output['n3_unit'] == 'g' ? 100 * $output['n3'] : $output['n3']) ?>],
				['Fiber', <?php echo ($output['n4_unit'] == 'mg' ? $output['n4'] : $output['n4_unit'] == 'g' ? 100 * $output['n4'] : $output['n4']) ?>],
				['Iron', <?php echo ($output['n5_unit'] == 'mg' ? $output['n5'] : $output['n5_unit'] == 'g' ? 100 * $output['n5'] : $output['n5']) ?>],
			]);

			var options = {
				title: 'Nutrients Stat',
				pieHole: 0.4,
			};

			var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
			chart.draw(data, options);
		}
	</script>
</head>
<!-- strat nav -->

<body class="goto-here">
	<?php include 'navbar.php' ?>
	<?php
	if (isset($_GET['id']) && isset($_GET['quantity'])) {
		$id = $_GET['id'];
		if ($_GET['quantity'] <= 0) {
			echo "<script>alert('Quantity cannot be Negative!!');</script>";
			echo "<script>window.open('item.php?id=" . $id . "','_self');</script>";
		};
		$qty = $_GET['quantity'];
		$user_id = $_SESSION['user_id'];
		$checksql = "SELECT * FROM cart WHERE itemid=$id AND userid=$user_id AND status=0";
		$checkresult = mysqli_query($conn, $checksql);
		if (mysqli_num_rows($checkresult) > 0) {
			echo "<script>alert('Item Already added to cart!!');</script>";
			echo "<script>window.open('item.php?id=" . $id . "','_self');</script>";
			return 0;
		} else {
			$sql = "INSERT INTO cart(userid, itemid, qty, status) VALUES ('$user_id','$id','$qty','0')";
			if (mysqli_query($conn, $sql)) {
				echo "<script>alert('Successfully added to cart');</script>";
				echo "<script>window.open('cart.php','_self');</script>";
			} else {
				echo "<script>alert('Something went wrong');</script>";
				echo "<script>window.open('dried.php','_self');</script>";
			}
		}
	}

	?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="/Foodmart/index.php">Home</a></span> <span class="mr-2"><a href="/Foodmart/shop.php">Product</a></span> <span><?php echo $output['name']; ?></span></p>
					<h1 class="mb-0 bread"><?php echo $output['name'] ?></h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="images/product-1.jpg" class="image-popup"><img src="images/<?php echo $output['img']; ?>" class="img-fluid" alt="Beans-1kg"></a>
					<div id="donutchart" style="width: 900px; height: 500px;" class="ml-n5"></div>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3><?php echo $output['name']; ?>
						<?php echo $output['unit'] === '' ? '' : (' - 1 ' . $output['unit']); ?></h3>

					<p class="price"><span>Rs. <?php echo $output['price']; ?></span></p>
					<p>Protein: <?php echo ($output['n1'] . ' ' . $output['n1_unit']) ?></p>
					<p>Fat: <?php echo ($output['n2'] . ' ' . $output['n2_unit']) ?></p>
					<p>Carbs: <?php echo ($output['n3'] . ' ' . $output['n3_unit']) ?></p>
					<p>Fiber: <?php echo ($output['n4'] . ' ' . $output['n4_unit']) ?></p>
					<p>Iron: <?php echo ($output['n5'] . ' ' . $output['n5_unit']) ?></p>
					<form action="" name="addform" id="addform">
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
									<div class="select-wrap">

									</div>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
								<span class="input-group-btn mr-2">
									<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
										<i class="ion-ios-remove"></i>
									</button>
								</span>
								<input type="number" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="<?php echo number_format($output['qty'], 0); ?>">
								<span class="input-group-btn ml-2">
									<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
										<i class="ion-ios-add"></i>
									</button>
								</span>
							</div>
						</div>
						<p>
						<div class="btn btn-black py-3 px-5" onclick="document.getElementById('addform').submit();">Add to Cart</div>
						</p>
					</form>
					<div class="ml-5 mt-5">
						<h4>Item Description</h4>
						<p><?php echo $output['description']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row">
				<div class="mouse">
					<a href="/Foodmart/index.php" class="mouse-icon">
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
							<li><a href="/Foodmart/shop.php" class="py-2 d-block">Shop</a></li>
							<li><a href="/Foodmart/about.php" class="py-2 d-block">About</a></li>
							<li><a href="/Foodmart/contact.php" class="py-2 d-block">Contact Us</a></li>
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
								<li><a href="contact.html"><span class="icon icon-envelope"></span><span class="text">foodmart@gmail.com</span></a></li>
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

	<script>
		$(document).ready(function() {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());
				if (quantity >= <?php echo $output['qty']; ?>) {
					alert("You can't order more than <?php echo $output['qty']; ?> items");
					return false;
				}

				// If is not undefined

				$('#quantity').val(quantity + 1);

				// Increment

			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>

</body>

</html>