
<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0 mx-3">
		  <a class="product-item" href="product-page.php?id=<?php echo $row_product['id']; ?>">
			<img src="<?php echo $row_product['photo']; ?>" class="img-fluid product-thumbnail"  style="height:15rem">
			<h3 class="product-title"><?php echo $row_product['name']; ?></h3>
			<strong class="product-price"><?php echo $row_product['price']?> грн.</strong>
		  </a>
		</div> 