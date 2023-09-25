
<?php 
 session_start();
 include("classes/connect.php");
 include("classes/product.php");
 include("classes/users.php");
 include("classes/wishlist.php");

 
$admin = 0;



 if(isset($_SESSION['mystore_userid'])){
   $user = new User();
   $userid = $_SESSION['mystore_userid'];
   $us_data = $user->get_data($userid);
   $admin = $us_data['admin'];

   $wishlist = new Wishlist();
   $wishes= $wishlist->get_wishes($userid);
 }
?>
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
                        <div class="col-lg-12 text-center display-3 mt-5 text-dark">
                            Ваші побажання
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <?php 
					if(is_bool($wishes)){
						echo "<div class='mb-5 text-muted col-lg-12 text-center display-4'>";
						echo   "Немає предметів";
						echo "</div>";
					}
					else{
						foreach ($wishes as $row) {
						$product_class = new Product();
						$row_product = $product_class->get_data($row['product_id']);
						include("wish-card.php");
						}
					}
             		?>
                    </div>
                  </div>
              </main>
              <footer>
      
              </footer>
              <script src="js/bootstrap.bundle.min.js"></script>
              <script src="js/tiny-slider.js"></script>
              <script src="js/custom.js"></script>
              <script src="js/main.js"></script>
              <script src="headfoot.js"></script>
          </body>