<?php

//заменяет русские символы на англ
function trans($string) {
$converter = array(
    'а' => 'a',   'б' => 'b',   'в' => 'v',
    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',
    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',
    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
    'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

    'А' => 'A',   'Б' => 'B',   'В' => 'V',
    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
    'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
    'Л' => 'L',   'М' => 'M',   'Н' => 'N',
    'О' => 'O',   'П' => 'P',   'Р' => 'R',
    'С' => 'S',   'Т' => 'T',   'У' => 'U',
    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
    'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
    'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
    'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
);
    return strtr($string, $converter);
}
// поиск и замена слов в string
function repl($search, $replace, $str){
    $str = explode(' ', $str);
    for($i = 0; $i < count($str); $i++){
        if($str[$i]==$search){
            $str[$i]=$replace;
        }
    }
    $mass_str = implode(' ', $str);
    return $mass_str;
}

//$total_news_rand = new RecursiveIteratorIterator(new RecursiveArrayIterator($total_news_id));
//$total_news_rand = iterator_to_array($total_news_id, false); создание одномерного массива их многомерного
//$total_news_rand = array_unique($total_news_id);    Создание одномерного масиива из многомерноговшитый класс
