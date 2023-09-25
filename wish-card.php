

<div class="col-lg-3 col-md-4 col-sm-6 mb-5 mt-5 text-center">
<a class="product-item" href="product-page.php?id=<?php echo $row_product['id']; ?>">
        <img src="<?php echo $row_product['photo'];?>" class="img-fluid product-thumbnail" style="height:15rem">
        <h3 class="product-title"><?php echo $row_product['name']; ?></h3>
        <strong class="product-price"><?php echo $row_product['price']; ?> грн.</strong>
       
      </a>
      <a href="delete_wish.php?user=<?php echo $_SESSION['mystore_userid']; ?>&product=<?php echo $row_product['id']; ?>" class="ms-3">
      <i class="fa fa-close">
      </i>
    </a>
</div>