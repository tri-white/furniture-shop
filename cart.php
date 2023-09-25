<?php 
 session_start();
 include("classes/connect.php");
 include("classes/product.php");
 include("classes/users.php");
 include("classes/cart.php");
 include("classes/order.php");

 
$admin = 0;
$sum=0;
 if(isset($_SESSION['mystore_userid'])){
    $userid=$_SESSION['mystore_userid'];
   $user = new User();
   $us_data = $user->get_data($userid);
   $admin = $us_data['admin'];

   $cart = new Cart();

   if(isset($_POST['phone'])){

        $order = new Order();
        $order_create = $order->create_order($userid, $_POST);
        if($order_create !=""){
            echo "<div class='container text-center bg-danger my-2 py-2 text-light'>";
            echo $order_create;
            echo "</div>";

        }
        else{
            echo "<div class='container text-center bg-success my-2 py-2 text-light'>";
            echo "Замовлення оформлено! Очікуйте повідомлень";
            echo "</div>";
            $res = $cart->clear_cart($userid);
            header("Location: cart.php");
            die;
        }
   }

    $carts = $cart->get_data($userid);

    $sum = $cart->get_sum($userid);

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
                    Ваша корзина
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-12 px-5 d-flex order-2 order-lg-1">
                    <?php 
					if(is_bool($carts)){
						echo "<div class='mb-5 text-muted col-lg-12 text-center display-4'>";
						echo   "Немає предметів";
						echo "</div>";
					}
					else{
                        $i=0;
						foreach ($carts as $row) {
                            $product_class = new Product();
                            $cart_class = new Cart();
                            $row_cart = $cart_class->get_data($row['user_id'])[$i];
                            $row_product = $product_class->get_data($row['product_id']);
                            include("cart-card.php");
                            $i=$i+1;
						}
					}
             		?>
                </div>
                <div class="col-lg-5 col-md-12 order-1 order-lg-2">
                    <div class="col-12 fs-5 fw-bold">
                        Загальна вартість: <?php echo $sum; ?> грн.
                    </div>
                    <form action="" method="POST" class="mt-3">
                        <div class="form-group">
                            <label for="address">Адреса доставки</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Ваша адреса" required>
                        </div>
                        <div class="form-group mb-3">
  <label for="phone">Тел.</label>
  <input type="text" class="form-control" id="phone" name="phone"
         placeholder="Ваш телефон" required pattern="[0-9]+" title="Please enter only digits">
</div>

                        <div class="col-12 button mx-auto px-auto mt-3">
                        <button type="submit" class="btn btn-primary mx-auto align-self-center text-center" style="width:100%;">Оформити замовлення</button>

                        </div>
                        
                    </form>
                </div>
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
    
    <script>
        const inputFields = document.getElementsByClassName("amounter");
        inputFields.addEventListener('change', function() {
            const value = parseFloat(this.value); // Parse the input value as a float
            if (isNaN(value)) return; // Return if the value is not a number
            if (value < 0) {
                this.value = '0'; // Set the input value to 0 if it's negative
            }
        });
    </script>
</body>