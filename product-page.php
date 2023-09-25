<?php 
session_start();
include("classes/connect.php");
include("classes/product.php");
include("classes/comment.php");
include("classes/wishlist.php");
include("classes/users.php");
include("classes/cart.php");
$like = 0;
$admin = 0;
if(isset($_SESSION['mystore_userid'])){
    $user = new User();
    $us_data = $user->get_data($_SESSION['mystore_userid']);
    $admin = $us_data['admin'];
  }
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $prod = new Product();
    $prod_data = $prod->get_data($id);
    if(!$prod_data){
        header("Location: shop.php");
        die;
    }

    $comm = new Comment();
    $comms = $comm->get_comments($id);

    if(isset($_SESSION['mystore_userid'])){
        $usid = $_SESSION['mystore_userid'];
        $wish = new Wishlist();
        $like = $wish->check_wish($usid, $id);
    }
}
if(isset($_POST['description'])){
    $comm = new Comment();
    $result = $comm->create_comment($_SESSION['mystore_userid'], $_POST);
    if($result!=""){
        echo "<div class='container text-center bg-danger my-2 py-2 text-light'>";
        echo $result;
        echo "</div>";
      }
      header("Location:product-page.php?id=".$id);
      exit;
}
else if(isset($_POST['quantity'])){
      $productid = $id;
      $userid = $_SESSION['mystore_userid'];
      $quantity = $_POST['quantity'];
      $cart = new Cart();
      $res = $cart->add_cart($userid, $productid, $quantity);
      if($res!=""){
        echo "<div class='container text-center bg-danger my-2 py-2 text-light'>";
        echo $res;
        echo "</div>";
      }
      else{
        echo "<div class='container text-center bg-success my-2 py-2 text-light'>";
        echo "Товар додано в корзину";
        echo "</div>";
      }
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
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-6">
        <img src="<?php echo $prod_data['photo'];?>" style="max-width:100%;">
      </div>
      <div class="col-lg-6">
        <div class="col-lg-12 fs-5 fw-bold ps-3 mt-2">
          <?php echo $prod_data['name']; ?>
        </div>
        <div class="col-lg-12 fs-5 ps-3 mt-2">
          <?php echo $prod_data['price']; ?> грн.
        </div>

        <div class="col-lg-12 mt-3 d-flex">
          <form method="POST">
            <div class="col-lg-5 ps-3 d-inline">
              <input id="quant" type="number" name="quantity" step="1" required>
            </div>
            <div class="col-lg-3 ps-3 d-inline">
              <button class="p-2" type="submit"><i class="fa fa-shopping-cart"></i></a>
            </div>
            <div class="col-lg-3 ps-3 d-inline">
              <?php if(isset($_SESSION['mystore_userid']) && $like==0) : ?>
              <a href="add_wishlist.php?user=<?php echo $_SESSION['mystore_userid']; ?>&product=<?php echo $id; ?>"><i class="fa fa-heart" style="color:black;"></i></a>
              <?php else : ?>
              <a href="add_wishlist.php?user=<?php echo $_SESSION['mystore_userid']; ?>&product=<?php echo $id; ?>"><i class="fa fa-heart" style="color:red;"></i></a>
              <?php endif; ?>
            </div>
            <?php if(isset($_SESSION['mystore_userid']) && $admin==1) : ?>
          <a href="remove_product.php?product=<?php echo $id; ?>">
            <i class="fa fa-trash-can ms-3"></i>
          </a>
        <?php endif; ?>
          </form>
          

        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <!-- YOUR COMMENT -->
      <?php if(isset($_SESSION['mystore_userid'])) : ?>
      <div class="card-body">
        <form method="POST" action="" autocomplete="off">
          <div class="input-group align-items-center">
            <input type="hidden" name="product_id" value="<?php echo $prod_data['id']; ?>">
            <input name="description" type="text" class="form-control" placeholder="Ваш відгук"
              aria-label="Add a comment" aria-describedby="comment-button">
            <button class="btn btn-success" type="submit" id="comment-button">Додати відгук</button>
          </div>
        </form>
      </div>
      <?php endif; ?>
      <!-- END YOUR COMMENT -->
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- comments -->
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
						include("comment-card.php");
						}
					}
             		?>
      </div>
    </div>
  </div>
  <footer>

  </footer>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/main.js"></script>
  <script src="headfoot.js"></script>
  <script>
    const inputFields = document.getElementById('quant');
    inputFields.addEventListener('change', function() {
      const value = parseFloat(this.value); // Parse the input value as a float
      if (isNaN(value)) return; // Return if the value is not a number
      if (value < 0) {
        this.value = '0'; // Set the input value to 0 if it's negative
      }
    });
  </script>
</body>

</html>