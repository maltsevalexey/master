<?php



$result = mysql_query("SELECT COUNT(*) FROM news_s");
$row = mysql_fetch_array($result);
//var_dump($row[0]);

$max_posts_page = 4;//сколько показывать на странице
$total_posts = $row[0]; //Кол-во записей
$total_pages = ceil($total_posts/$max_posts_page); //кол-во страниц
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



$sql=mysql_query("SELECT * FROM news_s ORDER BY date_news DESC LIMIT ".$formula.", ".$max_posts_page." ");

while($res[]= mysql_fetch_array($sql)){
		$total_home = $res;
	}
	//var_dump($total_home);
$publicated = 'Опубликовано: ';

$text_1 = 'Суммарное кол-во новостей на сайте: <b>'.$total_posts.'</b>';

$text_2 = "Страница: <b>$page</b> из <b>$total_pages</b> страниц";

$pagctrl = ''; //$paginationcontrols переменная для вывода пагинации

if($total_pages != 1){
	//Если мы на первой странице то нам не нужна ссылка на педыдующую станицу и страницу №1. Если имеет место быть обратное делаем ссылки
	if($page > 1){
		$previous = $page - 1;
		$pagctrl .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$previous.'">Предыдущая</a>  &nbsp;';//&nbsp символ неразрывного пробела в html. Php self показывает путь от 				  //корневой папки до файла, из которого он был вызван
			for($i = $page - 2; $i < $page; $i++){ /*линки для отображения страниц слева*/
				if($i > 0){
						$pagctrl .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'
						</a> &nbsp;';
				}
			}
		}
		$pagctrl .= '<b>'.$page.'</b> &nbsp;';//убираем по сути линк с выбранной страницы
		/*Теперь следует сделать линки справа от выбранной страницы*/
		for($i = $page + 1; $i <= $total_pages; $i++){
			$pagctrl .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a> &nbsp;';
			if($i >= $page + 2){
					break;
			}
		}
		if($page != $total_pages){ //делаем ссылку 'следующая'
			if($page < $total_pages-2){
			$last = $total_pages;
			$pagctrl .= '&#46;&#46;&#46; <a href="'.$_SERVER['PHP_SELF'].'?page='.$last.'">'.$total_pages.'</a>&nbsp;';
			}
			$next = $page + 1;
			$pagctrl .= ' &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Следующая</a>';

		}
	}else{
		$pagctrl .= '<b>'.$page.'</b> &nbsp;';
	}

require_once $_SERVER['DOCUMENT_ROOT']."/project/views/home.php";

