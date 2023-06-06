<?php

require_once 'include/database.php';

if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}

// require_once 'vendor/autoload.php';

// $stripe = new \Stripe\StripeClient(
//     'pk_test_51Mk9O5HYCepetZoC67tidOOgmPzNOVN6VwyTAgeTS8V66kOphjYytH712zrNv1W8392ebRQcPH1fNUnY33TMtyUx00r91L71jh'
// );
//   $stripe->products->create([
//     'name' => 'Gold Special',
// ]);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="x-icon" href="images/main-logo.png">
    <title>AzhuStore</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://js.stripe.com/v3/"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        function viewProduct(id, type) {
            location.href = 'productview.php?type=' + type + '&id=' + id;
        }
        
    </script>
</head>

<body>

    <div id="myModal" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="tabs__block tabs__block-active">
                <form class="form">
                    <div class="input-container ic1">
                        <input id="nameSurname" name="nameSurname" class="input" type="text" placeholder=" ">
                        <div class="cut"></div>
                        <label for="nameSurname" class="placeholder">Имя фамилия</label>
                    </div>
                    <div class="input-container ic2">
                        <input id="region" name="region" class="input" type="text" placeholder=" ">
                        <div class="cut"></div>
                        <label for="region" class="placeholder">Область</label>

                    </div>

                    <div class="input-container ic2">
                        <input id="city" name="city" class="input" type="text" placeholder=" ">
                        <div class="cut"></div>
                        <label for="city" class="placeholder">Город</label>

                    </div>

                    <div class="input-container ic2">
                        <input id="address" name="address" class="input" type="text" placeholder=" ">
                        <div class="cut"></div>
                        <label for="address" class="placeholder">Адрес</label>

                    </div>
                    
                    <div class="input-container ic2">
                        <input id="postcode" name="postcode" class="input" type="text" placeholder=" ">
                        <div class="cut"></div>
                        <label for="postcode" class="placeholder">Почтовый индекс</label>

                    </div>

                    <div class="input-container ic2">
                        <input id="phoneNumber" name="phoneNumber" class="input" type="text" placeholder=" ">
                        <div class="cut"></div>
                        <label for="phoneNumber" class="placeholder">Номер телефона</label>

                    </div>
                    <input type="hidden" name="sign_type" value="sign_up">
                    <button type="text" class="submit">Оплатить</button>

                </form>


            </div>
        </div>

    </div>

    <div id="page-preloader" class="preloader">
        <div class="loader">

        </div>
    </div>

    <header id="header" class="header">
        <div class="container">
            <div class="header__wrapper">
                <div class="header__block">
                    <img src="images/logo.png" class="header__logo" alt="">
                </div>

                <div class="header__block">
                    <nav class="nav">
                        <a href="main.php" class="nav__link">Главная</a>
                        <a href="odezhda.php" class="nav__link">Одежда</a>
                        <a href="sumki.php" class="nav__link">Сумки</a>
                        <a href="perfumes.php" class="nav__link">Парфюмы</a>


                    </nav>
                </div>

                <div class="header__block">
                    <div class="header__inst">
                        <a href="https://www.instagram.com/azhu.store/" class="header__inst-link"><img
                                src="images/insta.png" alt=""></a>
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

    <section class="intro clothes">
        <div class="container">
            <div class="intro__content goods">
                <div class="intro__block">
                    <h1 class="intro__title">
                        Корзина
                    </h1>
                </div>
            </div>
        </div>
    </section>


    <section class="cart">
        <div class="container">


            <?php
            $total = 0;
            $username = $_COOKIE['username'];
            $users = "SELECT * FROM `users` WHERE `username`='$username'";
            if ($user_result = $link->query($users)) {
                foreach ($user_result as $user) {
                    $cart = unserialize(base64_decode($user['cart']));
                    if ($user['cart'] == '' || count($cart) == 0) {
                        echo '<p style="color:gray">В корзине ничего нет</p>';
                    } else {

                        foreach ($cart as $item) {
                            $type = $item['type'];
                            $id = $item['id'];
                            $quantity = $item['quantity'];
                            $size = '';
                            if ($type == 'clothes') {
                                $size = $item['size'];
                            }
                            $product = "SELECT * FROM `goods_$type` WHERE `id`=$id";
                            if ($product_result = $link->query($product)) {
                                foreach ($product_result as $row) {
                                    $img = $row['image'];
                                    $name = $row['name'];
                                    $desc = $row['description'];
                                    $price = $row['price'];
                                    if ($type == 'clothes') {
                                        $max_quantity = $row[$size];
                                    } else {
                                        $max_quantity = $row['quantity'];
                                    }
                                }
                            }
                            $total += $quantity * $price;
                            echo '
                                        <div class="cart__row" >
                                            <div class="cart__img" onclick="viewProduct(' . $row['id'] . ',`' . $type . '`)" style="cursor:pointer">
                                                <img src="' . $img . '" alt="">
                                            </div>
                                            <div class="cart__info">
                                                <div class="cart__title" onclick="viewProduct(' . $row['id'] . ',`' . $type . '`)" style="cursor:pointer">' . $name . '</div>
                                                <div class="cart__subtitle__size">' . $size . '</div>
                                                <input type="number" class="cart__quantity" value=' . $quantity . ' min=1 max=' . $max_quantity . ' rel=' . $id . ' rel1="' . $type . '" rel2="' . $size . '">
                                            </div>
                                            <br>
                                            <div class="cart__itemtotal" id="item-total-' . $id . '-' . $type . '' . $size . '">
                                                ' . $quantity * $price . ' Тг
                                            </div>
                                            <div class="cart__bucket">
                                                <a class="cart__delete" rel=' . $id . ' rel1="' . $type . '" rel2="' . $size . '">
                                                    <img src="images/delete.png" class=""  alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <hr>';
                        }
                        echo '<div class="cart__row">
                                        <button class="cart__button" id="myBtn" >Заказать</button>
                                        <div class="cart__total">
                                            В итоге: ' . $total . ' Тг
                                        </div>
                                    </div>';
                    }
                }
            }




            ?>



        </div>
    </section>

    <section class="footer">
        <div class="container">
            <div class="footer__content">
                <div class="footer__item">
                    <img src="images/logo.png" class="footer__logo" alt="">
                </div>

                <div class="footer__item">
                    <div class="footer__title">Контакты</div>
                    <div class="footer__contacts">+7 (812) 123-45-67</div>
                </div>

                <div class="footer__item">
                    <div class="footer__title">Мы в Instagram</div>
                    <div class="footer__contacts"><a href="https://www.instagram.com/azhu.store/"><img
                                src="images/insta.png" alt=""></a></div>
                </div>
            </div>
        </div>

    </section>

    <script src="javascript.js"></script>
    <script src="js/functions.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/jquery-3.6.3.js"></script>

</body>

</html>