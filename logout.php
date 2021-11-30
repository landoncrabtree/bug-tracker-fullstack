<?php
require __DIR__ . '/vendor/autoload.php';

$db = new \PDO('mysql:dbname=avastfun_bugtracker;host=localhost;charset=utf8mb4', 'avastfun_bugtracker_admin', '4Vs4YvmDzrJHReH');
$auth = new \Delight\Auth\Auth($db);

$auth->logOut();
header('Location: https://projects.landon.pw/bugtracker/');
die();
?>