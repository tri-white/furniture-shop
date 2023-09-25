

<div class="col-lg-3 col-md-4 col-sm-6 m-5 text-center align-items-center px-auto">
<a class="product-item mx-auto" href="product-page.php?id=<?php echo $row_product['id']; ?>">
        <img src="<?php echo $row_product['photo'];?>" class="img-fluid product-thumbnail mx-auto" style="height:10rem">
        <h3 class="product-title"><?php echo $row_product['name']; ?></h3>
        <strong class="product-price"><?php echo $row_product['price']; ?></strong>
      </a>
      <div class="d-flex align-items-center">
        <input class="amounter" type="number" value="<?php echo $row_cart['quantity']; ?>" name="quantity" step="1" required>
        <a href="delete_cart.php?cartid=<?php echo $row_cart['id']; ?>">
          <i class="fa fa-close ms-1">
        </i>
      </div>
    </a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.amounter').on('change', function() {
      var newQuantity = $(this).val(); // Get the new quantity value
      var redirectUrl = 'update-cart.php?product=<?php echo $row_product['id'];?>&quantity=' + newQuantity; // Build the redirect URL with the new quantity
      
      window.location.href = redirectUrl; // Redirect to the update-cart.php with the updated quantity
    });
  });
</script>
