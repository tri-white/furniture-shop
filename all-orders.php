<?php
  session_start();

  include("classes/connect.php");
  include("classes/login.php");
  include("classes/users.php");
  include("classes/comment.php");
  include("classes/order.php");

  $admin=0;
if(isset($_SESSION['mystore_userid'])){
  $user = new User();
  $us_data = $user->get_data($_SESSION['mystore_userid']);
  $admin = $us_data['admin'];
}

  $order = new Order();
  $orders = $order->get_all_data();
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="scss/cart.css">

  <title> Фурні </title>
</head>

<body>
  <header>
  </header>

  <main>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
          <div class="text-center fs-5 fw-bold">
            Замовлення
          </div>
          <?php 
                        if(is_bool($orders)){
                          echo "<div class='mb-5 text-muted col-lg-12 text-center display-4'>";
                          echo   "Немає замовлень";
                          echo "</div>";
                        }
                        else{
                          $i=0;
                          foreach ($orders as $row) {
                          $row_order = $orders[$i];
                          include("profile-order-card-all.php");
                          $i=$i+1;
                          }
                        }     
                      
                      ?>

            </div>
        </div>
    </div>
  </main>

  <footer>

  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="headfoot.js"></script>
</body>

</html>