<?php
//выборка контактов
$sql_inf = mysql_query("SELECT * FROM information");
while($res_inf[] = mysql_fetch_array($sql_inf)){
$total_inf = $res_inf;
}

/*echo '<pre>';
var_dump($total_inf);
echo '</pre>';*/
require_once $_SERVER['DOCUMENT_ROOT']."/project/views/inform.php";