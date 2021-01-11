<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promo Page</title>
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
      width: 100%;
    }

    .promo-div {
      text-align: center;
      width: 100%;
      margin-top: 20px;
    }

    .promo-list-div {
      text-align: left;
      margin-left: -40px;
      width: 100vw;
      padding: 15px;
      margin-top: 15px;
    }

    .promo-list-div button {
      font-size: 15px;
      width: 50%;
      margin: 0 !important;
      margin-top: 10px !important;
    }
  </style>
</head>
<body>
  <div class="modal" id="promo-modal">
    <div class="modal-lg" id="promo-modal-check">
      <div class="close-modal">
        <span href="#" onclick="closeModal()">&#x2716;</span>
      </div>
      <h2 id="promo-name"></h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
      Excepturi impedit reiciendis illo vel corrupti porro 
      consectetur optio obcaecati harum delectus quis laborum
      culpa ratione voluptas, ea vitae aliquid rem ab.</p>
      <div class="modal-footer-btn">
        <button class="btn btn-green">Avail promo</button>
      </div>
    </div>

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
      <a href="#">
        <span class="active">
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
      <h2>Promos</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">shopping_cart</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="content">
        <small>You are currently subscribed to</small>
        <span style="display: flex; align-items: center;">
          <h1 class="text-green">Student Promo</h1>
          <i class="material-icons text-disabled" style="font-size: 18px">help</i>
        </span>
        <div class="promo-div">
          <h3>Available temporary promos</h3>
          <div class="promo-list-div text-primary shadow-1">
            <h3>Christmas Promo</h3>
            <p><strong>P75 off &#x00B7</strong> Dec 01 - Dec 31</p>
            <button class="btn btn-reg" promo-name="Christmas" onclick="showPromo(this)">View promo details</button>
          </div>
          <div class="promo-list-div text-primary shadow-1">
            <h3>New Year Promo</h3>
            <p><strong>P100 off &#x00B7</strong> Jan 01 - Jan 31</p>
            <button class="btn btn-reg" promo-name="New Year" onclick="showPromo(this)">View promo details</button>
          </div>
          <div class="promo-list-div text-primary shadow-1">
            <h3>Valentines Promo</h3>
            <p><strong>P75 off &#x00B7</strong> Feb 01 - Feb 28</p>
            <button class="btn btn-reg" promo-name="Valentines" onclick="showPromo(this)">View promo details</button>
          </div>
          <div class="promo-list-div text-primary shadow-1">
            <h3>Back-to-school Promo</h3>
            <p><strong>P50 off &#x00B7</strong> Aug 01 - Aug 31</p>
            <button class="btn btn-reg" promo-name="Back-to-school" onclick="showPromo(this)">View promo details</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {
      showPromo = (elem) => {
        let promoModal = document.getElementById('promo-modal');
        let promoName = document.getElementById('promo-name');
        let name = elem.getAttribute('promo-name');

        promoName.innerText = `${name} Promo`;
        promoModal.style.display = 'flex';
      }

      closeModal = () => {
        document.getElementById('promo-modal').style.display = 'none';
      }

      document.addEventListener('click', (evt) => {
        let target = evt.target;
        let modal = document.getElementById('promo-modal');
        let checkModal = document.getElementById('promo-modal-check')
        let buttons = document.getElementsByClassName('btn btn-reg');

        do {
          for(let i = 0; i<buttons.length; i++) {
            if(target == buttons[i] || target == checkModal) {
              return;
            }
          }

          target = target.parentNode;
        } while(target);
        modal.style.display = 'none';
      })
    }
  </script>
</body>
</html>