<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pay Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
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
        <h2>Your subscription is currently <span class="text-green">ongoing.</span></h2>
        <div class="list-div">
          <div class="list-item left">
            <h4>Availed promo(s)</h4>
          </div>
          <div class="list-item right" style="display: flex; align-items: center !important; justify-content: flex-end;">
            <h4>Student</h4>
            <i class="material-icons text-disabled" style="font-size: 13px">help</i>
          </div>
        </div>
        <div class="list-div">
          <div class="list-item left">
            <h4>Monthly Subscription</h4>
          </div>
          <div class="list-item right">
            <h4>P649.00 <span class="text-green" id="paydate">Paid</span></h4>
            <small>Expires on 09/14/2020</small>
          </div>
        </div>
        <div class="list-div">
          <div class="list-item left">
            <h4>Annual Membership</h4>
          </div>
          <div class="list-item right">
            <h4>P199.00 <span class="text-green" id="paydate">Paid</span></h4>
            <small>Expires on 08/06/2021</small>
          </div>
        </div>
        <hr style="border: 1px solid black; width: 100%">
        <div class="list-div" style="margin-top: 0">
          <div class="list-item left">
            <small>To pay</small>
          </div>
          <div class="list-item right">
            <h4>P0.00</h4>
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

  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {

    }
  </script>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'gold',
          layout: 'vertical',
          label: 'pay',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>
</body>
</html>