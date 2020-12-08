<?php

function emptyInputSignup($name, $email, $pwd, $pwdRepeat, $phone, $address, $city) {
  $result;
  if (empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat) || empty($phone) || empty($address) || empty($city)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email) {
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
  $result;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function emailExists($conn, $email) {
  $sql = "SELECT * FROM users WHERE usersEmail = ?;"; //? is a placeholder
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../register.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $pwd, $phone, $address, $city) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersPwd, usersPhone, usersAddress, usersCity) VALUES (?, ?, ?, ?, ?, ?);"; //? is a placeholder
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../register.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $hashedPwd, $phone, $address, $city);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../register.php?error=none");
  exit();
}

function emptyInputLogin($username, $pwd) {
  $result;
  if (empty($username) || empty($pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false) {
    header("location: ../index.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $uidExists["usersPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ../index.php?error=wronglogin");
    exit();
  } else if ($checkPwd === true) {
    session_start();
    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUid"];
    header("location: ../index.php");
    exit();
  }
}
