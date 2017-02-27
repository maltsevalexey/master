<?php
 //Выборка категорий
$sql_cat = mysql_query("SELECT * FROM categories");
while($res_cat[] = mysql_fetch_array($sql_cat)){
	$total_category = $res_cat;
}

//выборка случайной новости дня
$sql_news_rand = mysql_query("SELECT * FROM news_s ORDER BY RAND() LIMIT 1 ");
	$res_news_rand = mysql_fetch_array($sql_news_rand);
	$news_rand_id = $res_news_rand['news_id'];



					



require_once $_SERVER['DOCUMENT_ROOT']."/project/views/header.php";
?>


