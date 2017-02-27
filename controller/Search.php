<?php
//создание писка по БД
// если существует $_GET['search_text']  
$result = '';
	
$get_search_text = trim($_GET['search_text']);

 	if(empty($get_search_text)){
        $result .= '<div>Введите клюевое слово для поиска</div>';
	} else{
	$sql_search = mysql_query("SELECT * FROM news_s WHERE news_name LIKE '%$get_search_text%' OR news_description LIKE '%$get_search_text%'  OR news LIKE '%$get_search_text%' ");

	$num_rows = mysql_num_rows($sql_search);//кол-во вытащенных строк из БД
	//var_dump($num_rows);
		if($num_rows == 0){
			$result .= 'Извините, но по вашему запросу <b>'.$get_search_text.'</b> ничего не найдено';

			}	else{
						while($array_search[] = mysql_fetch_array($sql_search)){
						$array_res = $array_search;
						}


	//echo '<pre>';
	//var_dump($array_res);
	//echo '</pre>';

            $result .= '<p align="center">Найдено: <b>'.$num_rows.'</b> новость(и)</p>';

//	$result = '';

            $result .= '<table class="table_main">';
				foreach ($array_res as $row_res) {
			$news_id = $row_res['news_id'];
			$date_news = $row_res['date_news'];
			$date_news = date("d.m.Y", strtotime($date_news));
			$news_id = $row_res['news_id'];
			$news_name = $row_res['news_name'];
			$news_description = $row_res['news_description'];
			$news = $row_res['news'];
			$news_image = $row_res['news_image'];
			$cat_id = $row_res['category_id'];

                    $publicated = 'Опубликовано: '.$date_news;

					$result .= '<tr>';
					$result .= '<td class="main_table_td"><img class="img" src="'.$news_image.'" alt = "фото из категории '.$cat_id.'" ></td>';
					$result .= '<td class="main_table_td"><h3><a href="'.$_SERVER['PHP_SELF'].'?news='.$news_id.'" >'.$news_name.'</a></h3>';
					$result .= $news_description.'<br>';
					$result .= '<div>'.$publicated.'</div>';
					$result .= '</td>';
					$result .= '</tr>';



				}
            $result .= '</table>';
        }
    }
require_once $_SERVER['DOCUMENT_ROOT']."/project/views/search.php";
