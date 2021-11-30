<?php
require __DIR__ . '/vendor/autoload.php';

#$conn = new mysqli($servername, $username, $password, $dbname);
#if ($conn->connect_error) {
#    die("Connection failed: " . $conn->connect_error . " Make sure 'database.php' is correctly set.");
#}
#
#// Register request
#if (isset($_POST["register"])) {
#    if (isset($_POST["register-firstName"])) {
#        if (isset($_POST["register-lastName"])) {
#            if (isset($_POST["register-email"])) {
#                if (isset($_POST["register-password"])) {
#                    
#                    $first = mysql_real_escape_string($_POST["register-firstName"]);
#                    $last = mysql_real_escape_string($_POST["register-lastName"]);
#                    $email = mysql_real_escape_string($_POST["register-email"]);
#                    $password = mysql_real_escape_string($_POST["register-password"]);
#                    
#                    // Check if name is alphabetic.
#                    if (!(ctype_alpha($first)) || !(ctype_alpha($last))) {
#                        echo "Your name can only contain characters.\n";
#                        return;
#                    }
#                    
#                    // Check if email address is valid email.
#                    if (!(isEmail($email))) {
#                        echo "Your email address is invalid.\n";
#                        return;
#                    }
#                    
#                    $password = password_hash($password, PASSWORD_BCRYPT);
#                    $token = openssl_random_pseudo_bytes(16);
#                    $token = bin2hex($token);
#                    $sql = "INSERT INTO ".$table." (firstname, lastname, email, password, token) 
#                    VALUES ('".$first."', '".$last."', '".$email."', '".$password."', '".$token."')";
#                    if ($conn->query($sql) === true) {
#                        echo "New record created successfully";
#                    } else {
#                        echo "Error: " . $sql . "<br>" . $conn->error;
#                    }
#                    $conn.close();
#                }
#            }
#        }
#    }
#// Login request
#} else if (isset($_POST["login"])) {
#    if (isset($_POST["login-email"])) {
#        if (isset($_POST["login-password"])) {
#            $email = mysql_real_escape_string($_POST["login-email"]);
#            $password = mysql_real_escape_string($_POST["login-password"]);
#            $sql = "SELECT id, email, password FROM ".$table." WHERE email = ?";
#            if ($conn->query($sql) === true) {
#                echo $sql;
#            } else {
#                echo $sql;
#            }
#        }
#    }
#}
?> 

<DOCTYPE html>
    <html>
        <head>
            <title>Bug Tracker</title>
        </head>
        <body>
            <h1>Bug Tracker</h1>
            <p>Welcome to the Bug Tracker panel!</p>
            <h3>Sign Up</h3>
            <form action="#" method="POST">
                <input name="register-firstName" id="register-firstName" placeholder="First Name" required type="text">
                <input name="register-lastName" id="register-lastName" placeholder="Last Name" required type="text">
                <input name="register-email" id="register-email" placeholder="Email" required type="email">
                <input name="register-password" id="register-password" placeholder="Password" required type="password">
                <input name="register" id="register" type="submit" value="Register!">
            </form>
            <br>
            <h3>Login</h3>
            <form action="#" method="POST">
                <input name="login-email" id="login-email" placeholder="Email" required type="email">
                <input name="login-password" id="login-password" placeholder="Password" required type="password">
                <input name="login" id="login" type="submit" value="Login In!">
            </form>
        </body>
    </html>