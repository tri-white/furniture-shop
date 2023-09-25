

<?php 
session_start(); 
include("classes/connect.php");
include("classes/users.php");
$admin=0;
if(isset($_SESSION['mystore_userid'])){
  $user = new User();
  $us_data = $user->get_data($_SESSION['mystore_userid']);
  $admin = $us_data['admin'];
}
?>

<header>
<nav class="navbar navbar-expand-sm navbar-light bg-success">
        <div class="container">
          <a class="navbar-brand fs-3 text-light" href="index.php">Фурні.</a>
  
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fs-5">
              <li class="nav-item mx-lg-2 mx-md-1 mx-sm-0">
                <a class="nav-link text-light" href="index.php">Головна</a>
              </li>
              <li class="nav-item mx-lg-2 mx-md-1 mx-sm-0">
                <a class="nav-link text-light" href="shop.php">Асортимент</a>
              </li>
              <?php if(isset($_SESSION['mystore_userid']) && $admin==1) : ?>
              <li class="nav-item mx-lg-2 mx-md-1 mx-sm-0">
                <a class="nav-link text-light" href="product_add.php">Додати аcортимент</a>
              </li>
              <li class="nav-item mx-lg-2 mx-md-1 mx-sm-0">
                <a class="nav-link text-light" href="all-orders.php">Всі замовлення</a>
              </li>
              <?php endif; ?>
              <li class="nav-item mx-lg-2 mx-md-1 mx-sm-0 dropdown">
                <a class="nav-link dropdown-toggle pe-auto text-light" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                    <?php if(isset($_SESSION['mystore_userid'])) : ?>
                      <?php 
                        $user = new User();
                        $user_data = $user->get_data($_SESSION['mystore_userid']);
                        echo $user_data['username'];
                        ?>
                    <?php else : ?>
                    Профіль
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php if(isset($_SESSION['mystore_userid'])) : ?>

                    <li><a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['mystore_userid']?>">Мій профіль</a></li>
                    <li><a class="dropdown-item" href="cart.php">Моя корзина</a></li>
                    <li><a class="dropdown-item" href="wishlist.php">Список побажань</a></li>
                    <li><a class="dropdown-item" href="logout.php">Вихід з профілю</a></li>
                  <?php else : ?>
                    <li><a class="dropdown-item" href="login.php">Авторизація</a></li>
                    <li><a class="dropdown-item" href="registration.php">Реєстрація</a></li>
                  <?php endif; ?>

                  
                </ul>
              </li>
            </ul>
            
          </div>
        </div>
      </nav>
</header>
