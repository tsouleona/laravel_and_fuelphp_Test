<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 9/14/16
 * Time: 3:56 PM
 */


$colors = ['red', 'green', 'yellow', 'pink', 'rainmax'];

foreach($colors as $color){
    if($color == 'red'){
        $color = 'blue';
    }

    echo $color;
}


$colors[0];

//==

for($i = 0; $i < sizeof($colors); $i++){
    $color = $colors[$i];
    $aaa = $color;
    $redColor = 'red';
    $blueColor = 'blue';
    if($color == $redColor){
        $color = $blueColor;
    }

    echo $color;
}

$color;
$colors[0];
$aaa;