<?php
print_r($_POST);
 ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="iso-8859-1">
  <title>Help a neighbor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" type="image/png" href="pictures/favicon.png">
  <script type="text/javascript" src="js/main.js"></script>
</head>

<body>
  <div class="text-container">
    <a href="index.html"><img src="pictures/logo.png" alt="my logo"></a>
    <nav>
      <!-- Top Navigation Menu -->
      <div class="topnav">
        <!-- Navigation links (hidden by default) -->
        <ul>
          <div id="myLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#about">About us</a></li>
            <li><a href="faq.html">FAQ</a></li>
          </div>
        </ul>
        <a href="javascript:void(0);" class="icon" onclick="showMenu()">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    </nav>
    <div class="register-container">
      <form class="form" id="form" action="includes/signup.inc.php" method="post">
        <h1>Register Here</h1><br>
        <p>Fill in this form to create an account.</p>
        <hr>

        <label>Full name</label>
        <input type="text" placeholder="abc@example.com" name="name">

          <label>Email</label>
          <input type="text" placeholder="abc@example.com" name="email">

          <label>Password</label>
          <input type="password" placeholder="Enter password" name="pwd">

          <label>Repeat password</label>
          <input type="password" placeholder="Repeat password" name="pwdrepeat"><br>

          <label>Phone</label>
          <input type="text" placeholder="Phone" name="phone"><br>

          <label>Address</label>
          <input type="text" placeholder="Address" name="address"><br>

          <label>City</label>
          <input type="text" placeholder="City" name="city"><br>

          <input type="checkbox" name="usertype" id="Check1" value="hero" onclick="checkboxSelector(this.id)" checked="checked"> <!-- checkboxSelector is a function in js to make it possible to only choose one checkbox -->
          <label for="checkHero"><b>I want to be a hero</b></label><br>

          <input type="checkbox" name="usertype" id="Check2" value="need" onclick="checkboxSelector(this.id)">
          <label for="CheckInNeed"><b>I need a hero</b></label><br>

        <hr>
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p><br>
        <button type="submit" id="registerbtn" name="submit" value="submit" >Register</button>
      </form>
      <?php

      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo "<p>Fill in all fields</p>";
        } else if ($_GET["error"] == "invalidemail") {
          echo "<p>Choose a proper email!</p>";
        } else if ($_GET["error"] == "passwordsdontmatch") {
          echo "<p>Passwords doesn't match!</p>";
        } else if ($_GET["error"] == "stmtfailed") {
          echo "<p>Something went wrong. Try again.</p>";
        } else if ($_GET["error"] == "emailtaken") {
          echo "<p>The email is already taken!</p>";
        } else if ($_GET["error"] == "none") {
          echo "<p>You have signed up!</p>";
        }
      }

      ?>
    </div>
    <div class="register-footer">
      <p>Already have an account?
        <a>
          <element onclick="document.getElementById('id01').style.display='block'">Sign in</element>
        </a>
      </p>
    </div>
    <!-- The Modal -->
    <div id="id01" class="modal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <!-- Modal Content -->
      <form class="modal-content animate" action="faq.html" id="signin-form">
        <div class="signin-container">

          <div class="form-control">
            <label><b>Email</b></label>
            <input type="email" placeholder="abc@example.com" id="email-signin">
            <small>Error message</small>
          </div>

          <div class="form-control">
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter password" id="password-signin">
            <small>Error message</small>
          </div>

          <label>
            <input type="checkbox" checked="checked" id="remember"> Remember me
          </label>
          <br>
          <button type="submit">Sign in</button>
        </div>

        <div class="cancel-signin-container">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>
