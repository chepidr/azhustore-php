<?php

require_once 'include/database.php';
if(!isset($_COOKIE['username'])){
    header('Location: index.php');
}
if(isset($_GET['log_out'])){
    unset($_COOKIE['username']);
    setcookie('username', null, -1, '/');
    header('Location: index.php'); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="x-icon" href="images/main-logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>AzhuStore</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    
   
    
    
</head>
<body>

   

    <div id="page-preloader" class="preloader">
        <div class="loader">

        </div>
    </div>
    
    <header id="header" class="header" >
        <div class="container">
            <div class="header__wrapper">
                <div class="header__block">
                    <img src="images/logo.png" class="header__logo" alt="">
                </div>

                <div class="header__block">
                    <nav class="nav">
                        <a href="main.php" class="nav__link active">Главная</a>
                        <a href="odezhda.php" class="nav__link">Одежда</a>
                        <a href="sumki.php" class="nav__link">Сумки</a>
                        <a href="perfumes.php" class="nav__link">Парфюмы</a>
                        
                        
                    </nav>
                </div>

                <div class="header__block">
                    <div class="header__inst">
                        <a href="https://www.instagram.com/azhu.store/" class="header__inst-link"><img src="images/insta.png" alt=""></a>
                    </div>
                </div>

                <div class="header__block">
                    <div class="header__cart">
                        <a href="cart.php" class="header__cart-link"><img src="images/cart.png" alt=""></a>
                    </div>
                </div>

                <div class="header__block">
                    <div class="header__cart">
                        <a href="main.php?log_out=" class="header__cart-link"><img src="images/log-out.png" alt=""></a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <section class="intro">
        <div class="container">
            <div class="intro__content">
                <div class="intro__block">
                    <h1 class="intro__title" >
                        Интернет магазин
                        Azhu Store 
                    </h1>
                    
                    
                </div>
                <div class="mousedownn" >
                    <div class="mousedown">
                        <img class="mouse__icon" src="images/mouse.png" alt="">
                        <p class="mouse__text">Прокрутите вниз</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="about__content">
                <img src="images/“.png" alt="" class="about__img">
                <p class="about__text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In arcu nibh vitae amet. Ipsum, pharetra donec ornare velit. Id at quisque accumsan risus ac ipsum ut. Sit elit, facilisi proin non malesuada sociis tristique. Viverra augue lorem ut quisque quam tortor, malesuada iaculis. Et elementum at nulla venenatis, faucibus integer. Auctor neque eros, viverra rutrum. Fames ultrices condimentum tortor nec penatibus. Velit imperdiet sapien fringilla vestibulum sit fames.
                </p>
                <p class="about__title">
                    Товары:
                </p>
            </div>
            

            <div class="products">
                <a class="products__item" href="odezhda.php">
                    <div class="products__img">
                        <div class="products__icon"><img src="images/clothes.jpg" class="" alt=""></div>
                        <div class="products__shadow"></div>
                    </div>
                    <div class="products__title">Одежда</div>
                </a>
                <a class="products__item" href="sumki.php">
                    <div class="products__img">
                        <div class="products__icon"><img src="images/handbags.jpg" class="" alt=""></div>
                        <div class="products__shadow"></div>
                    </div>
                    <div class="products__title">Сумки</div>
                </a>
                <a class="products__item" href="perfumes.php">
                    <div class="products__img">
                        <div class="products__icon"><img src="images/perfumes.jpg" class="" alt=""></div>
                        <div class="products__shadow"></div>
                    </div>
                    <div class="products__title">Парфюмы</div>
                </a>
            </div>

            
        </div>
    </section>

    <section class="footer" >
        <div class="container">
            <div class="footer__content" >
                <div class="footer__item">
                    <img src="images/logo.png" class="footer__logo" alt="">
                </div>
        
                <div class="footer__item">
                    <div class="footer__title">Контакты</div>
                    <div class="footer__contacts">+7 (812) 123-45-67</div>
                </div>
        
                <div class="footer__item">
                    <div class="footer__title">Мы в Instagram</div>
                    <div class="footer__contacts"><a href="https://www.instagram.com/azhu.store/"><img src="images/insta.png" alt=""></a></div>
                </div>
            </div>
        </div>
        
    </section>

    <script src="javascript.js"></script>
    
    
</body>
</html>