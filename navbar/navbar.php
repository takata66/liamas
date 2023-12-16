<nav class="navbar navbar-expand-lg navbar-light bg-light font-family-3" style="background-color: white !important; border-bottom:1px solid black">
    
    <a class="navbar-brand" href="/liamas/index.php">
        <img src="/liamas/assets/img/logo.svg" style="width:100px; height:100px; object-fit: cover; ">
        LIAMAS
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Переключить навигацию">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<li class="nav-item"><a class="nav-link" href="/liamas/profile/user_profile.php">' . $_SESSION['username'] . '</a></li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="/liamas/cart/cart.php"><img src="/liamas/assets/img/cart.png"></a>';
                echo '</li>';
            } else {
                echo '<li class="nav-item"><a class="nav-link" href="/liamas/authentication/login.php">Войти</a></li>';
            }
            echo '<li class="nav-item"><a class="nav-link" href="/liamas/catalog/catalog.php">Каталог</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/liamas/about.php">О нас</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/liamas/orders/orders.php">Заказы</a></li>';
            ?>
        </ul>
    </div>
</nav>
