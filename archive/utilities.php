<?php
include "database.php";

// This function returns whether the string is an email or not.
function isEmail(string $str) {
    $email = filter_var($str, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function createAccount(string $first, string $last, string $email, string $password) {
    if (ctype_alpha($first)) {
        echo "Valid first name.";
    } else {
        echo "Invalid first name.";
    }
    
    if (ctype_alpha($last)) {
        echo "Valid last name.";
    } else {
        echo "Invalid last name.";
    }
    
    if (isEmail($email)) {
        return false;
    } else {
    }
    
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $token = openssl_random_pseudo_bytes(16);
    $token = bin2hex($token);
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO " .$table ." (firstname, lastname, email, password, token) 
    VALUES ('".$first."', '".$last."', '".$email."', '".$password."', '".$token."')";
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
        $conn.close();
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn.close();
        return false;
    }
    $conn.close();
}

?>