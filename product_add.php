
  <?php 
session_start(); 
include("classes/connect.php");
include("classes/users.php");
include("classes/product.php");


$product = new Product();
  $categories = $product->get_categories();

$admin=0;
if(isset($_SESSION['mystore_userid'])){
  $user = new User();
  $us_data = $user->get_data($_SESSION['mystore_userid']);
  $admin = $us_data['admin'];
}
if(isset($_FILES['image']['name']) && $admin==1){
	$prod = new Product();
	$res = $prod->create_product($_POST, $_FILES);
	if($res!= ""){
	  echo "<div class='container text-center bg-danger my-2 py-2 text-light'>";
	  echo $res;
	  echo "</div>";
	}else{
	  //header("Location: shop.php");
	  //die;
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

        <!-- Start Hero Section -->
<div class="hero d-flex align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1 class="text-center">Додавання асортименту</h1>
				</div>
			</div>
		</div>
	</div>
</div>


		<div class="container mt-5">
	<div class="row justify-content-center">
	  <div class="col-lg-4">
		<form method="post" action="" enctype="multipart/form-data">
			<div class="mb-3">
			  <label for="product-name" class="form-label">Назва предмету</label>
			  <input type="text" class="form-control" id="furniture-name" name="name-prod" required>
			</div>
			<div class="mb-3">
			  <label for="product-price" class="form-label">Ціна предмету</label>
			  <input type="number" class="form-control" id="furniture-price" name="price" step="0.01" required>
			</div>
			<div class="mb-3">
			  <label for="product-image" class="form-label">Фотографія предмету</label>
			  <input type="file" class="form-control" id="furniture-image" name="image" required>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <select name="category" class="form-select" aria-label="Категорія" style="width:100%;" required>
                  <?php foreach ($categories as $category): ?>
                  <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
			<div class="d-grid gap-2">
			  <button type="submit" class="btn btn-primary" id="add-button">Додати в асортимент</button>
			</div>
		  </form>
	  </div>
	</div>
  </div>

    <footer>
    </footer>

		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/main.js"></script>
		<script src="js/counter.js"></script>
		<script src="headfoot.js"></script>
	</body>
</html>
