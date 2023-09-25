<?php
  session_start();

  include("classes/connect.php");
  include("classes/login.php");
  include("classes/users.php");
  include("classes/comment.php");
  include("classes/order.php");
  include("classes/product.php");

  $admin=0;
    if(isset($_SESSION['mystore_userid']) && isset($_GET['id'])){
    $orderid = $_GET['id'];
    $order = new Order();
    $order_data = $order->get_data_order($orderid);
    $order_info = $order->get_items($order_data['id']);
    $user = new User();
    $user_data = $user->get_data($order_data['user_id']);
    }
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
            Замовлення №<?php echo $order_data['id']; ?>
          </div>
          <div class="ms-3 fs-2 mb-3">
            Дані покупця
          </div>
          <a  class="d-block " href="profile.php?id=<?php echo $user_data['id']; ?>">Покупець: <?php echo $user_data['username'];?></a>
          <a class="d-block text-decoration-none link-dark" >Дата створення: <?php echo $order_data['date'];?></a>
          <a class="d-block text-decoration-none link-dark" >Адреса доставки: <?php echo $order_data['address'];?></a>
            <a class="d-block text-decoration-none link-dark" >Телефон: <?php echo $order_data['phone'];?></a>
            <div class="ms-3 fs-2 mb-3 mt-3">
            Товари
          </div>
          <?php 
                          $i=0;
                          foreach ($order_info as $row) {
                            $prod = new Product();
                            $row_product = $prod->get_data($order_info[$i]['product_id']);
                            $row_order = $row;
                            include("order-item.php");
                            $i=$i+1;
                          }   
                      
                      ?>
            <p class="m-0">Загальна вартість: <?php echo $order->get_sum($order_data['id']); ?>   </p>
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