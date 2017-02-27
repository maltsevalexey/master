<?php
/*function str($int, $str){ //substr
    $string = '';
    for($i = 0; $i < $int; $i++){
        if($str[$i]){
            $string .= $str[$i];
        }
    } return $string;
}*/
//var_dump(str(4, 'sdfgd'));
function get_cat($int){ //функция возвращает название категории

    $sql = mysql_query("SELECT * FROM categories WHERE category_id = {$int} ");
    $res = mysql_fetch_row($sql);
    return $res[2];
}

function get_cat_int($string){ //функция возвращает номеер ID категории

    $sql = mysql_query("SELECT * FROM categories WHERE category_description = '".$string."' ");
    $res = mysql_fetch_row($sql);
    return $res[0];

}