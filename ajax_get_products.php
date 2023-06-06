<?php
session_start();
require_once 'include/database.php';


$type=$_REQUEST['type'];
$size=$_REQUEST['size'];
$sort=$_REQUEST['sort'];
$count=4*$_REQUEST['page'];
$i = 0;

if($sort=='low-high')
{
    $clothes = "SELECT * FROM goods_$type ORDER BY price ASC";
}
elseif($sort=='high-low')
{
    $clothes = "SELECT * FROM goods_$type ORDER BY price DESC";
}
elseif($sort=='newest'){
    $clothes = "SELECT * FROM goods_$type ORDER BY id DESC";
}
elseif($sort==''){
    $clothes = "SELECT * FROM goods_$type ORDER BY id";
}

if($result = $link->query($clothes)){    
    foreach($result as $row){
        if ($i < $count) {
            if($type=='clothes'){

                if($size!=''){
                    if($row[$size]>0){
                        echo '<div class="tovary__item" onclick="viewProduct('. $row['id'] .',`'.$type.'`)"><div class="tovary__image"><img src='. $row['image'] .' alt=""></div><div class="tovary__title">'. $row['name'] .'</div><div class="tovary__content"><div class="tovary__cost">'. $row['price'] .' Tg</div><div class="tovary__sizes">XS:'. $row['xs'] .' S:'. $row['s'] .' M:'. $row['m'] .' L:'. $row['l'] .' XL:'. $row['xl'] .'</div></div></div>';
                    }
                }
                else{
                    echo '<div class="tovary__item" onclick="viewProduct('. $row['id'] .',`'.$type.'`)"><div class="tovary__image"><img src='. $row['image'] .' alt=""></div><div class="tovary__title">'. $row['name'] .'</div><div class="tovary__content"><div class="tovary__cost">'. $row['price'] .' Tg</div><div class="tovary__sizes">XS:'. $row['xs'] .' S:'. $row['s'] .' M:'. $row['m'] .' L:'. $row['l'] .' XL:'. $row['xl'] .'</div></div></div>';
                }
            }
            else{
                echo '<div class="tovary__item" onclick="viewProduct('. $row['id'] .',`'.$type.'`)"><div class="tovary__image"><img src='. $row['image'] .' alt=""></div><div class="tovary__title">'. $row['name'] .'</div><div class="tovary__content"><div class="tovary__cost">'. $row['price'] .' Tg</div></div></div>';
            }
        }
        $i++;
    }
    $result->free();
} 
else{
    echo "Ошибка: " . $link->error;
}


?>