<?php

require 'Php/connection.php';
$error = "";
$mailid = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $mailid = $_POST["emailid"];
    $password = $_POST["password"];


    if (empty($mailid) || empty($password)) {
        header("Location:Loging.php?error=emptyfields");
        exit();
    } else {

        $sql = "SELECT * FROM  user WHERE email='$mailid' AND password='" . md5($password) . "'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];

                $cookie_name = "logged";
                $cookie_value = true;
                setcookie($cookie_name, $cookie_value, time() + (86400), "/");
                header("Location: /Foodsysterm/index.php?logged=true");
                exit();
            }
        } else {
            // header("Location:Loging.php?success=false");
            $error = "Invalid Email or Password";
        }

        $conn->close();
    }
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
    <style>
        .cls-heading {
            text-align: center;
        }

        .my-shadow {
            box-shadow: 9px 4px 14px -3px rgba(87, 82, 82, 0.75);
            -webkit-box-shadow: 9px 4px 14px -3px rgba(87, 82, 82, 0.75);
            -moz-box-shadow: 9px 4px 14px -3px rgba(87, 82, 82, 0.75);
        }
    </style>

</head>

<body>

    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">


                    <div class="d-flex align-items-center h-custom-2 px-6 ms-xl-5 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form action="Loging.php" method="POST" style="width: 23rem;">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2">Email address</label>
                                <input type="email" id="form2" value="<?php echo $mailid; ?>" name="emailid" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3">Password</label>
                                <input type="password" id="form3" value="<?php echo $password; ?>" name="password" class="form-control form-control-lg" />
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-primary" type="submit">Login</button>
                                <!-- <a href="index.php" class="btn btn-danger">Back</a> -->
                                <div class="text-danger">
                                    <?php echo $error ?>
                                </div>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="Foget password.html">Forgot password?</a></p>
                            <p>Don't have an account? <a href="signup.php" class="link-info">Register here</a></p>

                        </form>

                    </div>

                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="images/Loging 1.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>