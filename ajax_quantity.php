<?php
require_once 'include/database.php';

$result=[];
$result['total']=0;

$id=$_REQUEST['id'];
$quantity=$_REQUEST['quantity'];
$type=$_REQUEST['type'];
$size=$_REQUEST['size'];

$username=$_COOKIE['username'];
$users = "SELECT * FROM `users` WHERE `username`='$username'";
if($user_result = $link->query($users)){
    foreach($user_result as $user){
        $cart=unserialize(base64_decode($user['cart']));
        for($i = 0; $i < count($cart); ++$i){
            if(isset($cart[$i]['size'])){
                if($cart[$i]['size']==$size && $cart[$i]['type']==$type && $cart[$i]['id']==$id){
                    $cart[$i]['quantity']=$quantity;
                    $result['cost']=$cart[$i]['price']*$quantity;
                }
            }
            else{
                if($cart[$i]['type']==$type && $cart[$i]['id']==$id){
                    $cart[$i]['quantity']=$quantity;
                    
                    $result['cost']=$cart[$i]['price']*$quantity;
                }
            }
            
        }
        foreach($cart as $item){
            $result['total']+=$item['price']*$item['quantity'];
        }
    }
}

$cart=base64_encode(serialize($cart));
$users="UPDATE `users` SET `cart`='$cart' WHERE `username`='$username'";
$user_result = $link->query($users);

echo json_encode($result);

?>