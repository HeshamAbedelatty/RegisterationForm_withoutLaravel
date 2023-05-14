<?php
require('DB_Ops.php');
$fname = $_POST['fname'];
$phone = $_POST['phone'];
$Address = $_POST['Address'];
$email = $_POST["E-mail"];
$Username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$birthday = $_POST['birthday'];
$image = $_FILES['image']['name'];

if (empty($fname)) {
    echo " Name field is empty";
    exit;
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
    echo "Name contains invalid characters";
    exit;
}
if (empty($phone)) {
    echo " Phone field is empty";
    exit;
} elseif (!preg_match('/^\d+$/', $phone)) {
    echo " Phone contains non-numeric characters";
    exit;
}

if (empty($email)) {
    echo " Email field is empty";
    exit;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo " Email is not valid";
    exit;
}
if (empty($password)) {
    echo " Password field is empty";
    exit;
} elseif (strlen($password) < 8) {
    echo " Password is too short";
    exit;
}
$database = new database();
$database->insert_into_database($fname, $phone, $Address, $email, $Username, $password, $confirm_password, $birthday, $image);
