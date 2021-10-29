<html>

<head>
  <title>Order Successful</title>
  <link rel="stylesheet" type="text/css" href="css/booksuc.css">
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
</head>

<body class="bodyclass2" onload="myFunction()" style="margin:0;">
  <?php include("navbar.php"); ?>
  <center>
    <div id="loader"></div>
    <div style="display:none;" id="myDiv" class="animate-bottom">
      <h2>Booking complete!</h2>
      <p>We are happy to have you here!</p>
      <img src="images/Tick.png" width="280" height="280">
      <br>
      <a href="index.php">
        <button class="btn btn-dark">Go to Home</button>
      </a>
    </div>
  </center>
  <?php
  // print_r($result);
  ?>

  <script>
    var myVar;

    function myFunction() {
      myVar = setTimeout(showPage, 6000);
    }

    function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("myDiv").style.display = "block";
    }
  </script>
</body>

</html>