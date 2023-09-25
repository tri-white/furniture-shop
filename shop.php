<?php
  session_start();
  include("classes/connect.php");
  include("classes/product.php");
  include("classes/users.php");

  
$admin = 0;
$like = false;


$product = new Product();
  $categories = $product->get_categories();

  $product = new Product();
  $key="";
  $cat="all";
      $sort="name-desc";
      $products = $product->get_products($key, $cat, $sort);
  if($products==false){
    echo "<div class='container text-center bg-danger my-2 py-2 text-light'>";
    echo "Не вдалося вивести продукти з бази даних. Можливо відсутнє з'єднання";
    echo "</div>";
  }

  if(isset($_SESSION['mystore_userid'])){
    $user = new User();
    $us_data = $user->get_data($_SESSION['mystore_userid']);
    $admin = $us_data['admin'];
  }
      

  if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['search-input-key'])){
        
        $key = $_POST['search-input-key'];
        $cat = $_POST['product-category-filter'];
        $sort = $_POST['product-sort'];
        $products = $product->get_products($key,$cat,$sort);
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
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Асортимент</h1>
					</div>
				</div>
				<div class="col-lg-7">

				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

	<div class="untree_co-section product-section before-footer-section">
		<div class="container">
			<div class="row">
				<div class="mb-2 mt-5 col-lg-12 text-center display-5">
					Пошук
				</div>
				<div class="col-lg-8 col-md-10 col-sm-12 mx-auto align-items-center">
					<!-- Search bar -->
					<div class="row d-flex justify-content-center">
						<div class="col-lg-8 col-md-10 col-sm-12 text-center">
							<form method="post" action="">
								<div class="input-group">
									<input value="<?php echo $key; ?>" name="search-input-key" type="search"
										class="px-3 form-control" placeholder="Пошук..." aria-label="Search"
										aria-describedby="search-addon" />
									<button type="submit" class="btn btn-outline-dark">Знайти</button>
								</div>
								<div class="d-flex justify-content-between mb-2 mt-2">
									<div class="col-lg-6">
										<select id="product-category-filter" name="product-category-filter"
											class="form-select" aria-label="Категорія" style="width:100%;">
											<option value="all" <?php if ($cat == 'all') echo ' selected'; ?>>Всі
												категорії</option>
											<?php foreach ($categories as $category): ?>
											<option value="<?php echo $category; ?>"
												<?php if ($cat == $category) echo ' selected'; ?>>
												<?php echo $category; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-lg-6">
										<select id="product-sort" name="product-sort" class="form-select"
											aria-label="Категорія" style="width:100%;">
											<option value="price-desc"
												<?php if ($sort == 'price-desc') echo ' selected'; ?>>По ціні (↓)
											</option>
											<option value="price-asc"
												<?php if ($sort == 'price-asc') echo ' selected'; ?>>По ціні (↑)
											</option>
											<option value="feedback-desc"
												<?php if ($sort == 'name-desc') echo ' selected'; ?>>По назві (↓)
											</option>
											<option value="feedback-asc"
												<?php if ($sort == 'name-asc') echo ' selected'; ?>>По назві (↑)
											</option>
										</select>
									</div>
								</div>
						</div>
						</form>

					</div>
				</div>
				<div class="row">
					<?php 

if(is_bool($products)){
        echo "<div class='mb-5 text-muted col-lg-12 text-center display-4'>";
        echo "Не знайдено продуктів";
        echo "</div>";
}
else{
	$productsPerPage = 4;


    $totalPages = ceil(count($products) / $productsPerPage);

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $startIndex = ($currentPage - 1) * $productsPerPage;

    $currentPageProducts = array_slice($products, $startIndex, $productsPerPage);

    if (empty($currentPageProducts)){
        echo "<div class='mb-5 text-muted col-lg-12 text-center display-4'>";
        echo "Не знайдено продуктів";
        echo "</div>";
    } else {
        foreach ($currentPageProducts as $row) {
            $user_class = new User();
            $product_class = new Product();
            $row_user = $user_class->get_data($row['id']);
            $row_product = $product_class->get_data($row['id']);
            include("shop-product.php");
        }
    }
}
?>
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
							<?php
if(!is_bool($products)){
	for ($page = 1; $page <= $totalPages; $page++) {
		echo "<li class='page-item" . ($page == $currentPage ? " active" : "") . "'>";
		echo "<a class='page-link' href='?page=$page'>$page</a>";
		echo "</li>";
	}
}
        ?>
						</ul>
					</nav>


 
				</div>
				<div class="row">
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

</body>

</html>