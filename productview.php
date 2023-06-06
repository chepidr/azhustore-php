<?php
    require_once 'include/database.php';

    if(!isset($_COOKIE['username'])){
        header('Location: index.php');
    }

    $output='';
    if(isset($_GET['add'])){
        $type=$_GET['type'];
        $id=$_GET['id'];
        $cart=[];
        $username=$_COOKIE['username'];
        $users = "SELECT * FROM `users` WHERE `username`='$username'";
        if($user_result = $link->query($users)){
            foreach($user_result as $user){
                if($user['cart']==''){
                    if(isset($_GET['size'])){
                        $product = "SELECT * FROM `goods_$type` WHERE `id`=$id";
                        if($product_result = $link->query($product)){
                            foreach($product_result as $row){
                                if($_GET['size']==''){
                                    $output='<p style="color:red">выберите размер</p>';
                                }
                                elseif($row[$_GET['size']]<$_GET['quantity']){
                                    $output='<p style="color:red">превышает количество доступного</p>';
                                }
                                else{
                                    $product_array=array('id'=>$_GET['id'],'type'=>$_GET['type'], 'quantity'=>$_GET['quantity'],'size'=>$_GET['size'],'price'=>$row['price']);
                                    
                                    $cart[0]=$product_array;
                                    $output='<p style="color:green">Добавлено</p>';
                                }
                            }
                        }
                    }
                    else{
                        $product = "SELECT * FROM `goods_$type` WHERE `id`=$id";
                        if($result = $link->query($product)){
                            foreach($result as $row){
                                
                                if($row['quantity']<$_GET['quantity']){
                                    $output='<p style="color:red">превышает количество доступного</p>';
                                }
                                else{
                                    $product_array=array('id'=>$_GET['id'],'type'=>$_GET['type'], 'quantity'=>$_GET['quantity'],'price'=>$row['price']);
                                    $cart[0]=$product_array;
                                    $output='<p style="color:green">Добавлено</p>';
                                }
                            }
                        }
                    }
                }

                else{
                    
                    $cart=unserialize(base64_decode($user['cart']));
                    if(isset($_GET['size'])){   
                        $product = "SELECT * FROM `goods_$type` WHERE `id`=$id";
                        if($product_result = $link->query($product)){
                            foreach($product_result as $row){
                                if($_GET['size']==''){
                                    $output='<p style="color:red">выберите размер</p>';
                                }
                                elseif($row[$_GET['size']]<$_GET['quantity']){
                                    $output='<p style="color:red">превышает количество доступного</p>';
                                }
                                else{
                                    $product_array=array('id'=>$_GET['id'],'type'=>$_GET['type'], 'quantity'=>$_GET['quantity'],'size'=>$_GET['size'],'price'=>$row['price']);
                                    
                                    $count=count($cart);
                                    $add=true;
                                    foreach($cart as $item){
                                        if($item['size']==$_GET['size'] && $item['id']==$_GET['id']){
                                            $output='<p style="color:gray">Товар уже добавлен</p>';
                                            $add=false;
                                        }
                                    }
                                    if($add){
                                        $cart[$count]=$product_array;
                                        $output='<p style="color:green">Добавлено</p>';
                                    }
                                    
                                }
                            }
                        }
                    }
                    else{
                        $product = "SELECT * FROM `goods_$type` WHERE `id`=$id";
                        if($result = $link->query($product)){
                            foreach($result as $row){
                                
                                if($row['quantity']<$_GET['quantity']){
                                    $output='<p style="color:red">превышает количество доступного</p>';
                                }
                                else{
                                    $product_array=array('id'=>$_GET['id'],'type'=>$_GET['type'], 'quantity'=>$_GET['quantity'],'price'=>$row['price']);
                                    $count=count($cart);
                                    
                                    $add=true;
                                    foreach($cart as $item){
                                        if($item['type']==$_GET['type'] && $item['id']==$_GET['id']){
                                            $output='<p style="color:gray">Товар уже добавлен</p>';
                                            $add=false;
                                        }
                                    }
                                    if($add){
                                        $cart[$count]=$product_array;
                                        $output='<p style="color:green">Добавлено</p>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        

        $cart=base64_encode(serialize($cart));
        $users="UPDATE `users` SET `cart`='$cart' WHERE `username`='$username'";
        $user_result = $link->query($users);
        
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
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
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

    <section class="intro details">
        <div class="container">
            <div class="intro__content goods">
                <div class="intro__block">
                    
                    
                    
                </div>
                
            </div>
        </div>
    </section>

    <section class="itemview">
        <div class="container">
            
            <div class="itemview__row" id="itemview__row">
                <?php
                    $id=$_GET['id'];
                    $type=$_GET['type'];
                    $product = "SELECT * FROM `goods_$type` WHERE `id`=$id";
                    if($result = $link->query($product)){
                        foreach($result as $row){
                            if($type=='clothes'){
                                echo '<div class="itemview__col"><img src="'. $row['image'] .'" width="100%" alt=""></div><div class="itemview__col"><h1 class="itemview__title">'. $row['name'] .'</h1><h2 class="itemview__description">'. $row['description'] .'</h2><h2 class="itemview__price">'. $row['price'] .' Tg</h2><form><div class="itemview__select">    <select name="size" id="">        <option value="">Размер</option>        <option value="xl"  >XL('. $row['xl'] .')</option>        <option value="l">L('. $row['l'] .')</option>        <option value="m">M('. $row['m'] .')</option>        <option value="s">S('. $row['s'] .')</option>    <option value="xs">XS('. $row['xs'] .')</option> </select></div><div class="itemview__input"> Количество:    <input type="number" name="quantity" value="1" min="1" max="100"></div><button type="submit" name="add" class="itemview__button">Добавить в корзину</button><input name="type" type="hidden" value="'. $type .'"><input name="id" type="hidden" value="'. $id .'"></form>'. $output .'</div>';
                            }
                            else{
                                echo '<div class="itemview__col"><img src="'. $row['image'] .'" width="100%" alt=""></div><div class="itemview__col"><h1 class="itemview__title">'. $row['name'] .'</h1><h2 class="itemview__description">'. $row['description'] .'</h2><h2 class="itemview__price">'. $row['price'] .' Tg</h2><form><div class="itemview__input"> Количество:    <input type="number" name="quantity" value="1" min="1" max='. $row['quantity'] .'></div><button type="submit" name="add" class="itemview__button">Добавить в корзину</button><input name="type" type="hidden" value="'. $type .'"><input name="id" type="hidden" value="'. $id .'"></form>'. $output .'</div>';
                            }
                        }
                    }
                    else{
                        echo "Ошибка: " . $link->error;
                    }
                ?>
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
    <script src="js/jquery-3.6.3.js"></script>
    
    
</body>
</html>