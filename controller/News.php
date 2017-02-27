<?php


//выборка новости
//если существует $_GET['news'] то инклудю news.php и по гету выбираю строку в БД по id 

$get_news = trim($_GET['news']);
$sql_news = mysql_query("SELECT * FROM news_s WHERE news_id = '".$get_news."' ");

$row_res = mysql_fetch_array($sql_news);
		
			$news_id = $row_res['news_id'];
			$news_name = $row_res['news_name'];
			$news_description = $row_res['news_description'];
			$news = $row_res['news'];
			$news_image = $row_res['news_image'];
			$date_news = $row_res['date_news'];
			$date_news = date("d.m.Y", strtotime($date_news));
			$cat_id = $row_res['category_id'];
			
	// выборка названия категории в зависимости от выбранной ранее новости 	
	$sql_news_cat = mysql_query("SELECT category_description FROM categories WHERE category_id = '".$cat_id."' ");

	$row_news_cat = mysql_fetch_array($sql_news_cat);
	//var_dump($row_news_cat);
	$text_1 = 'Новость из категории: <b>'.$row_news_cat['category_description'].'</b>';
//echo '<pre>';
//var_dump($total_new);
//echo '</pre>';	
	$publicated = 'Опубликовано: '.$date_news;

		
require_once $_SERVER['DOCUMENT_ROOT']."/project/views/news.php";
