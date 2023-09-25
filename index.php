
<?php
	session_start();
	include("classes/connect.php");
	include("classes/product.php");
	$product = new Product();
	$key="";
	$cat="all";
	$sort="name-desc";
	$products = $product->get_products($key, $cat, $sort);
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
								<h1>Сучасний інтер'єр <span clsas="d-block"><br>Студія дизайну</span></h1>
								<p class="mb-4">Інноваційні рішення від італійських дизайнерів.</p>
								<p><a href="shop.html" class="btn btn-secondary me-2">Перейти до покупок</a><a href="#header-of-items" class="btn btn-white-outline">Переглянути</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="images/couch.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<!-- Start First Column -->
		<div class="container-fluid">
			<div class="row">
			  <div class="col-md-12 col-lg-6 mx-auto text-center mt-5">
				<h2 class="mb-4 section-title display-4">Вироблені з якісних матеріалів</h2>
				<p class="mb-4 lead w-75 mx-auto ms-lg-15">Топові меблі від найвідоміших дизайнерів 21 століття, прямо тут і зараз! Неймовірна якість, фантастичний комфорт, бездоганний вигляд</p>
			  </div> 
			</div>
		  </div>
		  
		  
		  
<!-- End First Column -->

<!-- Start Product Section -->
<div class="product-section" id="popular-items">
	<div class="container">
	  <div class="row justify-content-center">

		
		<!-- here will go item-index.php 3 items -->
		<?php 
					if(is_bool($products)){
						echo   "";
					}
					else{
						$i=1;
						foreach ($products as $row) {
							if($i>3) break;
							$product_class = new Product();
							$row_product = $product_class->get_data($row['id']);
							include("item-index.php");
							$i=$i+1;
						}
					}
             		?>

	  </div>
	</div>
  </div>
  <!-- End Product Section -->

  

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h2 class="section-title">Про нас</h2>
						<p>Ми - первопрохідці у технологіях вироблення декору які затверджені ISO стандартами якості у 2020 році. Виробляємо декорації на замовлення клієнтів по всій Європі.</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/truck.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Швидка &amp; Безкоштовна доставка</h3>
									<p>Доставимо ваше замовлення у будь-яку частину Європи протягом тижня.</p>
								</div>
							</div>


							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/support.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Підтримка 24/7</h3>
									<p> Наша служба підтримки працює цілодобово без перерв! Середній час відповіді на ваше питання - 30хв.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/return.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Безкоштовні миттєві повернення</h3>
									<p>Згідно з законом України про права споживачів, ми пропонуємо повернення ваших замовлень протягом 2 тижнів з моменту придбання.</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->

		<!-- Start We Help Section -->
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
							<div class="grid grid-1"><img src="images/img-grid-1.jpg" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="images/img-grid-2.jpg" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="images/img-grid-3.jpg" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title mb-4">Ми Допомагаємо Вам Зробити Сучасний Інтер'єр Вашого Будинку</h2>
						<p> Наша компанія працює на замовлення. Ми готові вислухати ваші пропозиції та запропонувати декілька макетів згідно ваших вимог. Наші робітники - кваліфіковані експерти, які виконують свої завдання швидко та якісно, а також готові співпрацювати з замовником наживу.</p>

						<ul class="list-unstyled custom-list my-4">
							<li>Італійські експерти</li>
							<li>Робота на замовлення</li>
							<li>Підтримка та поради</li>
							<li>Короткі сроки виконання</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End We Help Section -->

		<footer>

		</footer>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/main.js"></script>
		<script src="headfoot.js"></script>
	</body>

</html>
