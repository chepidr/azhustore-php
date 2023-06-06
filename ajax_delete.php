<?php
require_once 'include/database.php';

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];
$size=$_REQUEST['size'];

$username=$_COOKIE['username'];
$users = "SELECT * FROM `users` WHERE `username`='$username'";
if($user_result = $link->query($users)){
    foreach($user_result as $user){
        $cart=unserialize(base64_decode($user['cart']));
        for($i = 0; $i < count($cart); ++$i){
            if($type=='clothes'){
                if($cart[$i]['size']==$size && $cart[$i]['type']==$type && $cart[$i]['id']==$id){
                    
                    array_splice($cart, $i, 1);
                    $cart=base64_encode(serialize($cart));
                    $users="UPDATE `users` SET `cart`='$cart' WHERE `username`='$username'";
                    $user_result = $link->query($users);
                }
            }
            else{
                if($cart[$i]['type']==$type && $cart[$i]['id']==$id){
                    array_splice($cart, $i, 1);
                    $cart=base64_encode(serialize($cart));
                    $users="UPDATE `users` SET `cart`='$cart' WHERE `username`='$username'";
                    $user_result = $link->query($users);
                }
            }
            
        }
    }
}
?>
