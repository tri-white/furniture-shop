<?php
?>
<div class="card mt-2">
                   
                  <div class="card-body">
                  <a href="order-page.php?id=<?php echo $row_order['id']; ?>" class="text-decoration-none link-dark">
                    <p class="card-text mt-2 comment-text fs-7 mb-0 text-wrap">Замовлення №<?php echo $row_order['id'];?></p>
                    <p class="card-text mt-2 comment-text fs-7 mb-0 text-wrap">Дата замовлення <?php echo $row_order['date'];?></p>
                    <div class="footer-comment align-items-center d-flex justify-content-end align-items-center">
                      <?php if($admin==1) :?>
                        <a class="my-auto me-4 link-dark" href="remove-order-all.php?orderid=<?php echo $row_order['id']; ?>">
                        <i class="fa fa-trash-can"></i>
                      </a>
                      <?php endif; ?>
                  </a> 

                    </div>      
                  </div>
                </div>