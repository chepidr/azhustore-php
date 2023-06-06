<?php
    require_once 'include/database.php';
    
    if(!isset($_COOKIE['username'])){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="x-icon" href="images/main-logo.png">
    <title>AzhuStore</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script>
        function viewProduct(id,type){
          location.href='productview.php?type='+type+'&id='+id;
        }

        $(document).ready(function(){
            var type='handbags';
            var sort='';
            var size='';
            var page=1;

            $('#size').change(function(){
                size=$(this).val();
                $.ajax({
                url: 'ajax_get_products.php',
                data:{
                    'sort':sort,
                    'size':size,
                    'page':page,
                    'type':type
                },
                success: function(data){
                    
                    document.getElementById('products').innerHTML = data;

                }
                });
            });

            $('#sort').change(function(){
                sort=$(this).val();
                $.ajax({
                url: 'ajax_get_products.php',
                data:{
                    'sort':sort,
                    'size':size,
                    'page':page,
                    'type':type
                },
                success: function(data){
                    
                    document.getElementById('products').innerHTML = data;
 
                }
                });
            });

            $.ajax({
                url: 'ajax_get_products.php',
                data:{
                    'sort':sort,
                    'size':size,
                    'page':page,
                    'type':type
                },
                success: function(data){
                    
                    document.getElementById('products').innerHTML = data;

                }
            });

            window.addEventListener('scroll', () => {
                const documentRect=document.documentElement.getBoundingClientRect();
                if(documentRect.bottom<document.documentElement.clientHeight+300){
                    page++;
                }
                $.ajax({
                    url: 'ajax_get_products.php',
                    data:{
                        'sort':sort,
                        'size':size,
                        'page':page,
                        'type':type
                    },
                    success: function(data){

                        document.getElementById('products').innerHTML = data;
                    }
                });
            });
        });
    </script>
    
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
                        <a href="main.php" class="nav__link ">Главная</a>
                        <a href="odezhda.php" class="nav__link ">Одежда</a>
                        <a href="sumki.php" class="nav__link active">Сумки</a>
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


    <section class="intro handbags">
        <div class="container">
            <div class="intro__content goods">
                <div class="intro__block">
                    <h1 class="intro__title" >
                        Сумки
                    </h1>
                    
                    
                </div>
                
            </div>
        </div>
    </section>


    <section class="tovary">
        <div class="container">
            <div class="tovary__sorting">
                <div class="accordion" >
                    <select name="sort" id="sort" class="accordion__item">
                        <option value="">Сортировка</option>
                        <option value="low-high" >ЦЕНА: $–$$$</option>
                        <option value="high-low" >ЦЕНА: $$$–$</option>
                        <option value="newest" >Новые</option>
                    </select>
                </div>
            </div> 

                

            <div class="tovary__row" id="products" >
                
            </div>  
        </div>
    </section>
    

    <section class="footer goods" >
        <div class="container">
            <div class="footer__content" >
                <div class="footer__item">
                    <img src="images/logo-dark.png" class="footer__logo" alt="">
                </div>
        
                <div class="footer__item">
                    <div class="footer__title">Контакты</div>
                    <div class="footer__contacts">+7 (812) 123-45-67</div>
                </div>
        
                <div class="footer__item">
                    <div class="footer__title">Мы в Instagram</div>
                    <div class="footer__contacts"><a href="https://www.instagram.com/azhu.store/"><img src="images/insta-dark.png" alt=""></a></div>
                </div>
            </div>
        </div>
        
    </section>



    

    <script src="javascript.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
</body>
</html>