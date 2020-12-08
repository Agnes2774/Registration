<?php

if (isset($_POST["submit"])) {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];
  $city = $_POST["city"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($name, $email, $pwd, $pwdRepeat, $phone, $address, $city) !== false) {
    header("location: ../register.php?error=emptyinput");
    exit();
  }
  if (invalidEmail($email) !== false) {
    header("location: ../register.php?error=invalidemail");
    exit();
  }
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../register.php?error=passwordsdontmatch");
    exit();
  }
  if (emailExists($conn, $email) !== false) {
    header("location: ../register.php?error=emailtaken");
    exit();
  }

  createUser($conn, $name, $email, $pwd, $phone, $address, $city);

} else {
  header("location: ../register.php");
  exit();
}
