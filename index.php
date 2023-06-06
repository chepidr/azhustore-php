<?php

require_once 'include/database.php';
$output1='';
$output2='';
$exists=false;

if(isset($_COOKIE['username'])){
    header('Location: main.php');
}

if(isset($_GET['sign_type'])){
    $sign_type=$_GET['sign_type'];
    $username=$_GET['username'];
    $password=$_GET['password'];
    if(mb_strlen($username)<4 || mb_strlen($username)>30){
        $output1='Недопустимая длинна имени';
        $output2='Недопустимая длинна имени';
    }
    else if(mb_strlen($password)<4 || mb_strlen($password)>30){
        $output1='Недопустимая длинна пароля';
        $output2='Недопустимая длинна пароля';
    }
    else{
        if($sign_type=='sign_up'){
            $users = "SELECT * FROM `users`";
            if($result = $link->query($users)){
                foreach($result as $row){
                    if($row['username']==$username){
                        $exists=true;
                        $output1='Имя уже существует';
                    }
                }
            }
            if(!$exists){
                $hash_pswd=password_hash($password,PASSWORD_DEFAULT);
                $users="INSERT INTO `users` (`id`, `username`, `password`, `cart`, `transactions`) VALUES (NULL,'$username','$hash_pswd','','')";
                $result = $link->query($users);
                setcookie('username',$username,time()+3600*24*30,"/");
                header('Location: main.php');
                $output1='Добавлено';
            }
        }

        if($sign_type=='sign_in'){
            $users = "SELECT * FROM `users` WHERE `username`='$username'";
            if($result = $link->query($users)){
                foreach($result as $row){
                    if($row['username']==$username){
                        $exists=true;
                        if(password_verify($password,$row['password'])){
                            setcookie('username',$username,time()+3600*24*30,"/");
                            header('Location: main.php');
                        }
                        else{
                            $output2='Неверный пароль';
                        }
                    }
                }
            }
            if(!$exists){
                $output2='Имя не существует';
            }
        }
    }
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
    
   
    <script>
        $(document).ready(function(){

            $('#signup').click(function(){
                $('#signup').addClass('tabs__item-active');
                $('#signin').removeClass('tabs__item-active');
                $('#tab_01').addClass('tabs__block-active');
                $('#tab_02').removeClass('tabs__block-active');
            });

            $('#signin').click(function(){
                $('#signin').addClass('tabs__item-active');
                $('#signup').removeClass('tabs__item-active');
                $('#tab_02').addClass('tabs__block-active');
                $('#tab_01').removeClass('tabs__block-active');
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
                        <a href="index.php" class="nav__link active">Вход</a>  
                    </nav>
                </div>

                <div class="header__block">
                    <div class="header__inst">
                        <a href="https://www.instagram.com/azhu.store/" class="header__inst-link"><img src="images/insta.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="signin">
        <div class="container">
            <div class="signin__wrapper">
                <div class="signin__content">
                    <div class="signin__tabs">
                        <nav class="tabs__items">
                            <a href="#" class="tabs__item tabs__item-active" id="signup">Регистрация</a>
                            <a href="#" class="tabs__item" id="signin">Вход</a>
                        </nav>

                        <div class="tabs__body">
                            <div id="tab_01" class="tabs__block tabs__block-active">
                                <form class="form">
                                    <div class="input-container ic1">
                                      <input id="username" name="username" class="input" type="text" placeholder=" ">
                                      <div class="cut"></div>
                                      <label for="username" class="placeholder">Имя</label>
                                    </div>
                                    <div class="input-container ic2">
                                      <input id="password" name="password" class="input" type="text" placeholder=" ">
                                      <div class="cut"></div>
                                      <label for="password" class="placeholder">Пароль</label>
                                      
                                    </div>
                                    <input type="hidden" name="sign_type" value="sign_up">
                                    <button type="text" class="submit">Зарегистрироваться</button>

                                    <div class="sign__output">
                                        <?php echo $output1; ?>
                                    </div>
                                </form>

                                
                            </div>

                            <div id="tab_02" class="tabs__block">
                                <form class="form">
                                <div class="input-container ic1">
                                      <input id="username" name="username" class="input" type="text" placeholder=" ">
                                      <div class="cut"></div>
                                      <label for="username" class="placeholder">Имя</label>
                                    </div>
                                    <div class="input-container ic2">
                                      <input id="password" name="password" class="input" type="text" placeholder=" ">
                                      <div class="cut"></div>
                                      <label for="password" class="placeholder">Пароль</label>
                                      
                                    </div>
                                    <input type="hidden" name="sign_type" value="sign_in">
                                    <button type="text" class="submit">Войти</button>

                                    <div class="sign__output">
                                        <?php echo $output2; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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