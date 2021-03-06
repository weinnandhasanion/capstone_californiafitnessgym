<?php 
require "./../functions/connect.php";
session_start();

if(!isset($_SESSION["member_id"])) {
  header("Location: ./../index.php");
}

$monthlyHasValue = false;
$annualHasValue = false;
$subscribed = false;
$paidMonthly = false;
$paidAnnual = false;

$sql = "SELECT * FROM paymentlog 
      WHERE member_id = '".$_SESSION["member_id"]."' 
      AND payment_description = 'Monthly Subscription' 
      ORDER BY date_payment DESC";
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res) > 0) {
  $monthlyHasValue = true;
  $monthlyData = array();
  while($row = mysqli_fetch_array($res)) {
    $monthlyData[] = $row;
  }

  $monthly = $monthlyData[0];
  $date = new DateTime($monthly["date_payment"]);
  
  $monthlyStart = $date->format('Y-m-d');
  $monthlyEnd = date("Y-m-d", strtotime($monthlyStart. " + 30 days"));
} else {
  $monthlyHasValue = false;
}

$sql2 = "SELECT * FROM paymentlog 
      WHERE member_id = '".$_SESSION["member_id"]."' 
      AND payment_description = 'Annual Membership' 
      ORDER BY date_payment DESC";
$res2 = mysqli_query($con, $sql2);
if(mysqli_num_rows($res2) > 0) {
  $annualHasValue = true;
  $annualData = array();
  while($row = mysqli_fetch_array($res2)) {
    $annualData[] = $row;
  }

  $annual = $annualData[0];
  $y = new DateTime($annual["date_payment"]);

  $annualStart = $y->format('Y-m-d');
  $annualEnd = date("Y-m-d", strtotime($annualStart. " + 365 days"));
} else {
  $annualHasValue = false;
}

if($monthlyHasValue) {
  $now = date("Y-m-d");
  ($now > $monthlyEnd) ? $paidMonthly = false : $paidMonthly = true;
}

if($annualHasValue) {
  $now = date("Y-m-d");
  ($now > $annualEnd) ? $paidAnnual = false : $paidAnnual = true;
}

($paidMonthly && $paidAnnual) ? $subscribed = true : $subscribed = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pay Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="stylesheet" href="./../css/loader.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .sub-cont {
      width: 100%;
      margin-top: 40px;
    }

    .modal-footer-btn {
      display: flex;
      justify-content: center;
      padding: 20px 20px 0 20px;
      width: 80%;
    }

    .list-div {
      margin-top: 20px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }

    .list-item.left {
      width: 50%;
      text-align: left;
    }

    .list-item.right {
      width: 50%;
      text-align: right;
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
  <div class="modal" id="post-payment">
    <div class="modal-md" class="text-center">
      <h3 class="fw-600" id="payment-stat"></h3>
      <div style="height: 50px"></div>
      <div class="modal-footer" style="justify-content: flex-end">
        <a href="#" id="close-post-payment">Close</a>
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
      <a href="#">
        <span class="active">
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
      <a href="./payment_history.php">
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
      <h2>Pay</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">payment</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="content">
        <?php if($subscribed == false): ?>
        <h2>Your subscription is currently <span class="text-red">due.</span></h2>
        <?php else: ?>
        <h2>Your subscription is currently <span class="text-green">ongoing.</span></h2>
        <?php endif ?>
        <div class="list-div">
          <div class="list-item left">
            <h4>Availed promo(s)</h4>
          </div>
          <div class="list-item right" style="display: flex; align-items: center !important; justify-content: flex-end;">
            <h4>N/A</h4>
            <i class="material-icons text-disabled" style="font-size: 13px">help</i>
          </div>
        </div>
        <div class="list-div">
          <div class="list-item left">
            <h4>Monthly Subscription</h4>
          </div>
          <div class="list-item right">
            <h4>P750.00 
            <?php if($paidMonthly): ?>
              <span class="text-green" id="monthlypay">Paid</span>
            <?php else: ?>
              <span class="text-red" id="monthlypay">Due</span>
            <?php endif ?>
            </h4>
          <?php if($paidMonthly): ?>
            <small>Expires on 
          <?php 
            $a = new DateTime($monthlyEnd);
            $exp = $a->format("m/d/Y");
            echo $exp;
          ?>
            </small>
          <?php elseif(!$monthlyHasValue): ?>
            <small>No payment</small>
          <?php else: ?>
            <small>Expired on
          <?php 
            $a = new DateTime($monthlyEnd);
            $exp = $a->format("m/d/Y");
            echo $exp;
          ?>
            </small>
          <?php endif ?>
          </div>
        </div>
        <div class="list-div">
          <div class="list-item left">
            <h4>Annual Membership</h4>
          </div>
          <div class="list-item right">
            <h4>P200.00 
            <?php if($paidAnnual): ?>
            <span class="text-green" id="annualpay">Paid</span>
            <?php else: ?>
            <span class="text-red" id="annualpay">Due</span>
            <?php endif ?>
            </h4>
            <?php if($paidAnnual): ?>
            <small>Expires on
              <?php 
              $a = new DateTime($annualEnd);
              $exp = $a->format("m/d/Y");
              echo $exp;
              ?>
            </small>
            <?php elseif(!$annualHasValue): ?>
            <small>No payment</small>
            <?php else: ?>
            <small>Expired on
              <?php 
              $a = new DateTime($annualEnd);
              $exp = $a->format("m/d/Y");
              echo $exp;
              ?>
            </small>
            <?php endif ?>
          </div>
        </div>
        <hr style="border: 1px solid black; width: 100%">
        <div class="list-div" style="margin-top: 0">
          <div class="list-item left">
            <small>To pay</small>
          </div>
          <div class="list-item right">
            <h4 id="to-pay">P0.00</h4>
          </div>
        </div>
        <!-- <button class="btn btn-disabled fw-600">Pay P0.00</button> -->
        <div id="smart-button-container" style="margin-top: 20px; width: 80vw; z-index: 1">
          <div style="text-align: center;">
            <div id="paypal-button-container"></div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://www.paypal.com/sdk/js?client-id=AYXeISRpvW_Zd2FLKTbdaTdMHrJLCGRoNeimz1g9SMBy-_mMNVduiP8fiSpvbd0QF8pXvSe-a7bZOgdn&currency=PHP&disable-funding=credit,card" data-sdk-integration-source="button-factory"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="./../js/sidebar.js"></script>
  <script>
    function initPayPalButton(amt, items) {
      console.log()
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'black',
          layout: 'vertical',
          label: 'pay',
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [
              {
                "amount": 
                { 
                  "currency_code":"PHP",
                  "value": amt,
                  "breakdown": {
                    "item_total": {
                      "currency_code": "PHP",
                      "value": amt
                    }
                  }
                },
                "items": items
              },
            ]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            console.log(details);

            let data = {
              paymentId: details.id,
              amount: details.purchase_units[0].amount.value,
              paymentDate: details.create_time,
              status: details.status,
              items: details.purchase_units[0].items
            }

            if(data.status === "COMPLETED") {
              $.ajax({
                url: "./../functions/process_paypal.php",
                type: "json",
                method: "POST",
                data: {
                  data: JSON.stringify(data)
                },
                success: function(data) {
                  console.log(data);
                  if(data == 1 || data == 2) {
                    $("#payment-stat").addClass("text-green").text("Your payment is successful!");
                    $("#post-payment").css("display", "flex");
                  } else {
                    $("#payment-stat").addClass("text-red").text("Your payment is unsuccessful. Please try again later.");
                    $("#post-payment").css("display", "flex");
                  }
                }
              });
            }
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    
    window.onload = () => {
      $("#loader").css("display", "none");
      $("#confirm-logout").on("click", function() {
        $.ajax({
          url: "./../functions/logout_process.php",
          type: "json",
          method: "post",
          success: function() {
            window.location.reload();
          }
        });
      });

      $("#close-post-payment").click(function() {
        window.location.reload();
      })

      let m = $("#monthlypay").text();
      let a = $("#annualpay").text();
      let toPay = $("#to-pay");
      if(m == 'Due' && a == 'Paid') {
        toPay.text("P750.00");
      } else if(m == 'Paid' && a == 'Due') {
        toPay.text("P200.00");
      } else if(m == 'Due' && a == 'Due') {
        toPay.text("P950.00");
      } else {
        toPay.text("P0.00");
      }

      if(document.querySelector("#to-pay").innerText != "P0.00") {
        let amt = $("#to-pay").text();
        let amount = amt.slice(1, amt.indexOf("."));

        function getItems(amount) {
          if(amount == "750") {
            return [
              {
                "name": "Monthly Subscription",
                "unit_amount": {
                  "currency_code": "PHP",
                  "value": 750
                },
                "quantity": "1"
              }
            ];
          } else if(amount == "200") {
            return [
              {
                "name": "Annual Membership",
                "unit_amount": {
                  "currency_code": "PHP",
                  "value": 200
                },
                "quantity": "1"
              }
            ];
          } else if(amount == "950") {
            return [
              {
                "name": "Monthly Subscription",
                "unit_amount": {
                  "currency_code": "PHP",
                  "value": 750
                },
                "quantity": "1"
              },
              {
                "name": "Annual Membership",
                "unit_amount": {
                  "currency_code": "PHP",
                  "value": 200
                },
                "quantity": "1"
              }
            ]
          }
        };
        let items = getItems(amount);
        
        initPayPalButton(amount, items);
      }
    }
  </script>
</body>
</html>