<?php
require __DIR__ . '/vendor/autoload.php';

$db = new \PDO('mysql:dbname=avastfun_bugtracker;host=localhost;charset=utf8mb4', 'avastfun_bugtracker_admin', '4Vs4YvmDzrJHReH');
$auth = new \Delight\Auth\Auth($db);

if ($auth->isLoggedIn()) {
    header('Location: https://projects.landon.pw/bugtracker/');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bug Tracker | Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                <?php
                                if (isset($_POST['submit'])) {
                                    try {
                                        $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username']);
                                        echo "Your account has been created successfully.";
                                        echo "<script>window.location.replace('https://projects.landon.pw/bugtracker/login');</script>";
                                    }
                                    catch (\Delight\Auth\InvalidEmailException $e) {
                                        echo "That is not a valid email address.";
                                    }
                                    catch (\Delight\Auth\InvalidPasswordException $e) {
                                        echo "Invalid password.";
                                    }
                                    catch (\Delight\Auth\UserAlreadyExistsException $e) {
                                        echo "A user with that email already exists.";
                                    }
                                    catch (\Delight\Auth\TooManyRequestsException $e) {
                                        echo "Too many requests";
                                    }
                                }
                                ?>
                            </div>
                            <form class="user" method="POST" action="#">
                                <div class="form-group">
                                    <input type="email" required class="form-control form-control-user" id="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" required oninput="verifyPassword()" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" required oninput="verifyPassword()" class="form-control form-control-user" id="password-repeat" name="password-repeat" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <p id="validation"></p>
                                <p id="samepassword"></p>
                                <button class="btn btn-primary btn-user btn-block" id="submit" name="submit" disabled>Register Account</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="./login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
    // Checks the password input to ensure it follows policy.
    function verifyPassword() {
        let p1 = document.getElementById("password").value;
        let p2 = document.getElementById("password-repeat").value;

        // Check to ensure passwords match.
        if (p1 != p2) {
            if (p1.length < 8) {
                document.getElementById("validation").innerHTML = "Your password must be 8 characters or more.";
            } else {
                document.getElementById("validation").innerHTML = "";
            }
            document.getElementById("samepassword").innerHTML = "Your passwords do not match.";
            document.getElementById("submit").disabled = true;
        } else {
            if (p1.length < 8) {
                document.getElementById("validation").innerHTML = "Your password must be 8 characters or more.";
                document.getElementById("submit").disabled = true;
            } else {
                document.getElementById("validation").innerHTML = "";
                document.getElementById("submit").disabled = false;
            }
            document.getElementById("samepassword").innerHTML = "";
        }
    }
    </script>
</body>
</html>
