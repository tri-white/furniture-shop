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
if(isset($_GET['id']) && is_numeric($_GET['id'])){
  $id = $_GET['id'];

    $user = new User();
    $user_data = $user->get_data($id);
    if(!$user_data){
      header("Location: index.php");
      die;
    }

    $comm = new Comment();
    $comms = $comm->get_user_comments($id);

    $order = new Order();
    $orders = $order->get_data($id);
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
    <div class="container mt-5">

      <!-- username start -->
      <div class="row">
        <div class="col-lg-12">
          <div class="profile-info text-center mt-2">
            <div class="profile-image mx-auto" style="height:150px; width:150px;">
              <img src="images/user_male.jpg" style="width:100%; height:100%; object-fit: contain;"
                class="rounded-circle border border-1 border-dark" alt="Profile Picture">
            </div>
            <h5><?php echo $user_data['username'] ?></h5>
            <?php if($admin==1 && $_SESSION['mystore_userid']!=$_GET['id']) :?>
            <a class="my-auto me-4 link-dark" href="remove_profile.php?id=<?php echo $user_data['id']; ?>">
              <i class="fa fa-trash-can"></i>
            </a>
            <?php endif; ?>
          </div>
        </div>

      </div>
      <!-- username end -->
      <div class="row mt-5">
        <div class="col-6">
          <div class="text-center fs-5 fw-bold">
            Відгуки
          </div>
          <?php 
                        if(is_bool($comms)){
                          echo "<div class='mb-5 text-muted col-lg-12 text-center display-4'>";
                          echo   "Немає відгуків";
                          echo "</div>";
                        }
                        else{
                          foreach ($comms as $row) {
                          $user_class = new User();
                          $comment_class = new Comment();
                          $row_user = $user_class->get_data($row['user_id']);
                          $row_comment = $comment_class->get_data($row['id']);
                          include("profile-comment-card.php");
                          }
                        }     
                      
                      ?>
        </div>
        <div class="col-6">
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
                          $user_class = new User();
                          $order_class = new Order();
                          $row_user = $user_class->get_data($row['user_id']);
                          $row_order = $order_class->get_data($row['user_id'])[$i];
                          include("profile-order-card.php");
                          $i=$i+1;
                          }
                        }     
                      
                      ?>
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