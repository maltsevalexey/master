<?php
	
	$get_catalog = trim($_GET['catalog']);
	$sql_count=mysql_query("SELECT COUNT(*) FROM news_s WHERE category_id = {$get_catalog} ");
	$row = mysql_fetch_array($sql_count);
	
	$max_posts_page = 4;//сколько показывать на странице $page_rows
	$total_posts = $row[0]; //Кол-во записей $rows
	$total_pages = ceil($total_posts/$max_posts_page); //кол-во страниц $last
	if($total_pages<1){
		$total_pages = 1; // простая проверка, для подстраховки
	}

	$page= (empty($_GET['page']) ? 1 : intval($_GET['page']));

	if($page < 1){
			$page = 1;
			}elseif ($page > $total_pages) {  // проверка номера страницы, если клиент вводит через урл в ручную
				$page = $total_pages;
			}

	$formula = ($page - 1) * $max_posts_page; //формула для вывода постов



	$sql=mysql_query("SELECT * FROM news_s WHERE category_id = {$get_catalog} ORDER BY date_news DESC LIMIT ".$formula.", ".$max_posts_page." ");

	while($res[]= mysql_fetch_array($sql)){
		$total_cat_news=$res;
	}
	//var_dump($total_cat_news);


	$text_1 = 'Кол-во новостей на сайте по данной категории: <b>'.$total_posts.'</b>';

	$text_2 = "Страница: <b>$page</b> из <b>$total_pages</b> страниц";

	$publicated = 'Опубликовано: ';
	
	
		$pagctrl = ''; //$paginationcontrols переменная для вывода пагинации

	if($total_pages != 1){
	//Если мы на первой странице то нам не нужна ссылка на педыдующую станицу и страницу №1. Если имеет место быть обратное делаем ссылки
	if($page > 1){
		$previous = $page - 1;
		$pagctrl .= '<a href="'.$_SERVER['PHP_SELF'].'?catalog='.$get_catalog.'&page='.$previous.'">Предыдущая</a> &nbsp; &nbsp;';//&nbsp символ неразрывного пробела в html. Php self показывает путь от 				  //корневой папки до файла, из которого он был вызван
			for($i = $page - 2; $i < $page; $i++){ /*линки для отображения страниц слева*/
				if($i > 0){
						$pagctrl .= '<a href="'.$_SERVER['PHP_SELF'].'?catalog='.$get_catalog.'&page='.$i.'">'.$i.'
						</a> &nbsp;';
				}
			}
		}
		$pagctrl .= '<b>'.$page.'</b> &nbsp;';//убираем по сути линк с выбранной страницы
		/*Теперь следует сделать линки справа от выбранной страницы*/
		for($i = $page + 1; $i <= $total_pages; $i++){
			$pagctrl .= '<a href="'.$_SERVER['PHP_SELF'].'?catalog='.$get_catalog.'&page='.$i.'">'.$i.'</a> &nbsp;';
			if($i >= $page + 2){
					break;
			}
		}
		if($page != $total_pages){ //делаем ссылку 'следующая'
			$next = $page + 1;
			$pagctrl .= '&nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?catalog='.$get_catalog.'&page='.$next.'">Следующая</a>';
		}
	}
	
	


 
require_once $_SERVER['DOCUMENT_ROOT']."/project/views/catalog.php";
