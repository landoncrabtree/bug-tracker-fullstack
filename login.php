<?php
require __DIR__ . '/vendor/autoload.php';

$db = new \PDO('mysql:dbname=avastfun_bugtracker;host=localhost;charset=utf8mb4', 'avastfun_bugtracker_admin', '4Vs4YvmDzrJHReH');
$auth = new \Delight\Auth\Auth($db);

// If admin, redirect to Admin Dashboard.
if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
    header('Location: https://projects.landon.pw/bugtracker/admin');
    die();
}

// Otherwise, if logged in, redirect to index.
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

    <title>Bug Tracker | Login</title>

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

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            if ($_POST['remember'] == "on") {
                                                $rememberDuration = (int) (60 * 60 * 24 * 30); // Keep user logged in for 30 days.
                                            }
                                            else {
                                                $rememberDuration = null;
                                            }
                                            try {
                                                $auth->login($_POST['email'], $_POST['password'], $rememberDuration);
                                                if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
                                                    echo "<script>window.location.replace('https://projects.landon.pw/bugtracker/admin');</script>";
                                                } else {
                                                  echo "<script>window.location.replace('https://projects.landon.pw/bugtracker/');</script>";
                                                }
                                            }
                                            catch (\Delight\Auth\InvalidEmailException $e) {
                                                echo "The email or password entered is incorrect.";
                                            }
                                            catch (\Delight\Auth\InvalidPasswordException $e) {
                                                echo "The email or password entered is incorrect.";
                                            }
                                            catch (\Delight\Auth\EmailNotVerifiedException $e) {
                                                echo "Your email is not verified yet.";
                                            }
                                            catch (\Delight\Auth\TooManyRequestsException $e) {
                                                echo "Too many requests.";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <form class="user" method="POST" action="#">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" id="remember" name="remember">
                                                <label>Remember Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" id="submit" name="submit">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="./register">Create an Account!</a>
                                    </div>
                                </div>
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

</body>

</html>
