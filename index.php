<?php
  require "./functions/connect.php";
  session_start();

  if(isset($_SESSION["user"]) && isset($_SESSION["pass"])) {
    header("Location: ./pages/profile.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="icon" href="./img/gym_logo.png">
  <title>California Fitness Gym - Members</title>
</head>
<body>
  <div class="full-page-loader" id="loader">
    <div class="loader"></div>
  </div>
  <main>
    <div class="logo">
      <img src="./img/gym_logo.png" alt="gym-logo">
      <p>California Fitness Gym</p>
    </div>
    <div class="sign-in">
      <div class="form-field">
        <input class="form-input" type="text" name="username" id="username">
        <label for="username">Username</label>
      </div>
      <div class="form-field">
        <input class="form-input" type="password" name="password" id="password">
        <label for="password">Password</label>
      </div>
      <small id="error-msg"></small>
      <button class="btn" id="login" type="submit">Login</button>
    </div>
  </main>

  <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    $("#login").on("click", function() {
      let user = $("#username").val();
      let pass = $("#password").val();
      $("#error-msg").text("");

      $.ajax({
        method: 'post',
        type: 'json',
        url: './functions/login_process.php',
        data: {
          user: user,
          pass: pass
        },
        success: function(res) {
          if(res == 0) {
            $("#error-msg").text("Invalid username or password");
          } else {
            document.getElementById('loader').style.display = "flex";
            setTimeout(() => {
              window.location.href = "./pages/profile.php";
            }, 750);
          }
        },
      });
    });
  </script>
</body>
</html>