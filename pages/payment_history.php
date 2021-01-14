<?php 
require "./../functions/connect.php";
session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["pass"])) {
  header("Location: ./../index.php");
}

$sql = "SELECT * FROM paymentlog WHERE member_id = '".$_SESSION["member_id"]."' ORDER BY date_payment DESC";
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res)) {
  $rows = array();
  while($row = mysqli_fetch_assoc($res)) {
    $rows[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment History Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">

  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    main {
      overflow-y: hidden !important;
    }

    .main-cont {
      padding-left: 0 !important;
    }

    .button-cont {
      width: 100vw;
      padding: 0 !important;
      margin-top: 9vh;
      height: 8vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .button-cont select {
      padding: 5px;
      border-radius: 5px;
      font-size: 14px;
    }

    .history-div {
      border-top: 1px solid #2c2c2c;
      border-bottom: 1px solid #2c2c2c;
      width: 100vw;
      height: 47.5vh;
      overflow-y: scroll;
      overflow-x: hidden;
      padding-top: 20px;
      padding-left: 30px;
      padding-right: 30px;
    }

    .print-cont {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100vw;
    }

    .print-cont button {
      width: 70%;
    }

    .list-div {
      width: 100%;
      margin-bottom: 5px;
    }

    .list-div hr {
      margin-block-start: 0.1em !important;
      margin-block-end: 0.2em !important;
      border-color: black;
      border-width: 1px;
    }

    .list-div .list-content {
      display: flex;
      justify-content: space-between;
    }

    .list-content a {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="full-page-loader" id="loader">
    <div class="loader"></div>
  </div>
  <!-- Logout confirmation modal -->
  <div class="modal" id="logout-modal">
    <div class="modal-sm">
      <p class="fw-600">Are you sure you want to logout?</p>
      <div style="height: 50px"></div>
      <div class="modal-footer">
        <a href="#" id="confirm-logout" class="text-red fw-600">Logout</a>
        <a href="#" id="cancel-logout">Cancel</a>
      </div>
    </div>
  </div>
  <div class="sidebar" id="sidebar">
    <i class="material-icons" style="font-size: 32px" id="back">keyboard_backspace</i>
    <div class="items">
      <a href="./profile.php">
        <span>
          <i class="material-icons">account_circle</i>
          <h2>Profile</h2>
        </span>
      </a>
      <a href="./pay.php">
        <span>
          <i class="material-icons">payment</i>
          <h2>Pay</h2>
        </span>
      </a>
      <a href="./promos.php">
        <span>
          <i class="material-icons">shopping_cart</i>
          <h2>Promos</h2>
        </span>
      </a>
      <a href="#" class="active">
        <span>
          <i class="material-icons">history</i>
          <h2>Payment History</h2>
        </span>
      </a>
      <a href="./program.php">
        <span>
          <i class="material-icons">settings</i>
          <h2>Program</h2>
        </span>
      </a>
      <a href="./notifications.php">
        <span>
          <i class="material-icons">notifications_active</i>
          <h2>Notifications</h2>
        </span>
      </a>
      <a href="./tutorial.php">
        <span>
          <i class="material-icons">slow_motion_video</i>
          <h2>Tutorials</h2>
        </span>
      </a>
    </div>
    <div class="logout">
      <button class="btn btn-red" style="width: 80%" id="logout-btn">Logout</button>
    </div>
  </div>
  <main>
    <div class="menu">
      <i class="material-icons" style="font-size: 32px;" id="menu">menu</i>
      <h2>Payment History</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">history</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="button-cont">
        <select name="timestamp" id="timestamp">
          <option value="alltime" selected>All-time</option>
          <option value="today">Today</option>
          <option value="yesterday">Yesterday</option>
          <option value="last7days">Last 7 days</option>
          <option value="last30days">Last 30 days</option>
        </select>
      </div>
      <div class="history-div">
        <?php 
        foreach($rows as $row) {
        ?>
        <div class="list-div">
          <small class="payment-date fw-800 text-disabled">
          <?php 
          $d = new DateTime($row["date_payment"]);
          $date = $d->format("M d, Y");
          echo $date;
          ?>
          </small>
          <hr>
          <div class="list-content">
            <div class="left">
              <p class="payment-for fw-600"><?php echo $row["payment_description"] ?></p>
              <a href="#" class="text-red">Details</a>
            </div>
            <div class="right">
              <p class="payment-amount fw-600 text-green">P<?php echo $row["payment_amount"] ?>.00</p>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
        
      </div>
      <div class="print-cont">
        <button class="btn btn-reg">Print payment history</button>
      </div>
    </div>
  </main>

  <script src="./../js/sidebar.js"></script>
  <script>
    $("#loader").css("display", "flex");
    $(document).ready(function() {
      $("#loader").css("display", "none");
    })
  </script>
</body>
</html>