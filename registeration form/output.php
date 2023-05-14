<?php
// define variables and set to empty values
$name = $email = $phone = $address = $password = $ConfirmPassowrd = $username = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["fname"]);
  $email = test_input($_POST["E-mail"]);
  $phone = test_input($_POST["phone"]);
  $username = test_input($_POST["username"]);
  $address = test_input($_POST["Address"]);
  $ConfirmPassowrd = test_input($_POST["confirm_password"]);
  $password = test_input($_POST["password"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $phone;
echo "<br>";
echo $address;
echo "<br>";
echo $username;
echo "<br>";
echo $email;
echo "<br>";
echo $password;
echo "<br>";
?> 