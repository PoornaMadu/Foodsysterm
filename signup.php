<?php
$error="";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require 'Php/connection.php';

	$username =$_POST['username'];
	$email =$_POST['email'];
	$password =$_POST['password'];
	$confirm_password =$_POST['confirm_password'];

	if(empty($username)){
		$error="Username is required";
	}
	elseif(empty($email)){
		$error="Email is required";
	}
	elseif(empty($password)){
		$error="Password is required";
	}
	elseif(empty($confirm_password)){
		$error="Confirm Password is required";
	}
	elseif($password!=$confirm_password){
		$error="Password does not match";
	}

	$result = mysqli_query($conn,"SELECT * FROM  user WHERE email = '".$email."'");
	// echo("Error description: " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);

	if ($row>0) {
		$error= "Email already Registered!";
	}
	else{
		$sql = "INSERT INTO user (username, email, password	) VALUES ('$username','$email','".md5($password)."')";
		if(mysqli_query($conn, $sql)){
			header('location: /Foodsysterm/index.php?signed=1');
		}
		else{
			echo "ERROR: Unable to execute $sql. " . mysqli_error($conn);
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Sign-up</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	background: #dfe7e9;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	font-size: 16px;
	transition: all 0.4s;
	box-shadow: none;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {
	border-radius: 50px;
	outline: none !important;
}
.signup-form {
	width: 480px;
	margin: 0 auto;
	padding: 30px 0;
}
.signup-form form {
	border-radius: 5px;
	margin-bottom: 20px;
	background: #fff;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 40px;
}
.signup-form a {
	color: #5cb85c;
}    
.signup-form h2 {
	text-align: center;
	font-size: 34px;
	margin: 10px 0 15px;
}
.signup-form .hint-text {
	color: #999;
	text-align: center;
	margin-bottom: 20px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form .btn {        
	font-size: 18px;
	line-height: 26px;
	font-weight: bold;
	text-align: center;
}
.signup-btn {
	text-align: center;
	border-color: #5cb85c;
	transition: all 0.4s;
}
.signup-btn:hover {
	background: #5cb85c;
	opacity: 0.8;
}
.or-seperator {
	margin: 50px 0 15px;
	text-align: center;
	border-top: 1px solid #e0e0e0;
}
.or-seperator b {
	padding: 0 10px;
	width: 40px;
	height: 40px;
	font-size: 16px;
	text-align: center;
	line-height: 40px;
	background: #fff;
	display: inline-block;
	border: 1px solid #e0e0e0;
	border-radius: 50%;
	position: relative;
	top: -22px;
	z-index: 1;
}
.social-btn .btn {
	color: #fff;
	margin: 10px 0 0 15px;
	font-size: 15px;
	border-radius: 50px;
	font-weight: normal;
	border: none;
	transition: all 0.4s;
}	
.social-btn .btn:first-child {
	margin-left: 0;
}
.social-btn .btn:hover {
	opacity: 0.8;
}
.social-btn .btn-primary {
	background: #507cc0;
}
.social-btn .btn-info {
	background: #64ccf1;
}
.social-btn .btn-danger {
	background: #df4930;
}
.social-btn .btn i {
	float: left;
	margin: 3px 10px;
	font-size: 20px;
}
</style>
</head>
<body>
<div class="signup-form">
    <form action="" method="post">
		<h2>Create an Account</h2>
	
        <div class="form-group">
        	<input type="text" class="form-control input-lg" name="username" placeholder="Username" required="required">
        </div>
		<div class="form-group">
        	<input type="email" class="form-control input-lg" name="email" placeholder="Email Address" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control input-lg" id="pwd" name="password" onkeyup="checkpwd()" pattern=".{6,}" placeholder="Password" required>
        </div>
		<div class="form-group" >
            <input type="password" class="form-control input-lg" id="cpwd" name="confirm_password" onkeyup="checkpwd()" placeholder="Confirm Password" required>
        </div>  
        <div class="form-group">

			<div class="text-danger" id="err">
        		<?php echo $error?>
      		</div>

            <button type="submit" id="btn" class="btn btn-success btn-lg btn-block signup-btn">Sign Up</button>

        </div>
    </form>
    <div class="text-center">Already have an account? <a href="Loging.html">Login here</a></div>
</div>

</body>
<script>
	// document.getElementById("err").style.display = "none";
	function checkpwd(){
		var re = new RegExp(".{6,}");
		console.log(re.test(document.getElementById("pwd").value));
		if(!re.test(document.getElementById("pwd").value)) {document.getElementById("err").innerHTML = "Password should contain at least 6 characters";document.getElementById("btn").disabled = true;return;} 
		if(document.getElementById("pwd").value != document.getElementById("cpwd").value){
			document.getElementById("err").innerHTML = "Passwords are not matching!!!";
			document.getElementById("btn").disabled = true;
			return;
		}else{
			document.getElementById("err").innerHTML = "";
			document.getElementById("btn").disabled = false;
			return;
		}
	}
	
	</script>
</html>