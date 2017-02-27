<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/project/images/';
$sql = mysql_query("SELECT * FROM categories");
while($res[] = mysql_fetch_array($sql)){
    $total = $res;
}
$sql_count = mysql_query("SELECT * FROM categories");
$result = mysql_num_rows($sql_count);
$sql_count_news = mysql_query("SELECT * FROM news_s");
$result_news = mysql_num_rows($sql_count_news);
$errors = array();
    if(empty($data['news_name'])){
        $errors[] = 'Поле "Название новости" не заполенено';
    }
    if(empty($data['news_disc'])){
        $errors[] = 'Поле "Описание новости" не заполенено';
    }
    if(empty($data['news'])){
        $errors[] = 'Поле "Новость" не заполенено';
    }
    if(empty($data['cat_id']) || !is_numeric($data['cat_id']) ){
        $errors[] = 'Поле "Категория новости" не заполенено или заполнено некорректно';
    }
    if(empty($_FILES['picture']['tmp_name'])){
        $errors[] = 'Не выбран файл для загрузки';
    }
    if(empty($data['date'])){
        $errors[] = 'Поле "Дата" не заполенено';
    }
   //var_dump($_FILES);



if(isset($data['addnew'])){
        if(empty($errors)){

            copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])
            or die('<h2 style= "color: red">Выбранный файл не загружается</h2>');
            $img_news = '/project/images/'. $_FILES['picture']['name'];//переменная дя БД
            $sql = mysql_query("INSERT INTO news_s SET  news_name = '".$data['news_name']."',
            news_description = '".$data['news_disc']."', news = '".$data['news']."', category_id = '".$data['cat_id']."',
             news_image = '".$img_news."', date_news = '".$data['date']."' ") or die
            ('<h2 style= "color: red">Ошибка! Новость не добавлена</h2>');
            //следующая запись равноценна текущей, и так  и так можно добавлять инфу в бд. ID автоматом проставится
            /*$sql = mysql_query("INSERT INTO news_s (news_name, news_description,  news,
            category_id,  news_image, date_news) VALUES('".$data['news_name']."',
    '".$data['news_disc']."', '".$data['news']."',  '".$data['cat_id']."', '".$img_news."',
            '".$data['date']."') ") or die('<h2 style= "color: red">Ошибка! Новость не добавлена</h2>');*/
            echo '<h2 style= "color: green">Новость успешно добавлена!</h2>';
            } else {
                 echo '<h2 style= "color: red">'.array_shift($errors).'</h2>';
             }
    } else{

    //var_dump($result);
?>
    <section>
<form method="POST" enctype="multipart/form-data">
            <div class="label">
                <label>Название новости: </label>
                <input type="text" name="news_name" placeholder="Название новости" size="71"><br>
            </div><p></p>
            <div class="label">
                <label>Краткое описание новости: </label>
                <textarea rows="10" cols="70" name="news_disc" placeholder="Описание новости"></textarea><br>
            </div><p></p>
            <div class="label">
            <label>Новость: </label>
            <textarea class="text_new" rows="20" cols="70" name="news" placeholder="Текст новости"></textarea><br>
            </div><p></p>
            <div class="label">
            <label>Категория новости: </label>
            <input class="inp_1" type="text" name="cat_id" placeholder="Введите номер категории" size="71"><br>
            *На данный момент в базе имеется <?= $result; ?> категории:<br>
            <? foreach($total as $v){
                    echo $v['category_id'].' - '.$v['category_description'].'<br>';
            }
            ?>
            </div><p></p>
            <div class="label">
            <label>Загрузить фото новости: </label>
            <input class="inp_file" type="file" name="picture">
            </div><p></p>
            <div class="label">
            <label>Дата публикации:</label>
            <input class="inp_date" type="date" name="date" ><p></p>
            <input type="reset" value="Сбросить значения"> &nbsp; &nbsp;
           <input type="submit" name="addnew" value="Добавить новость">
            </div>
</form>
    </section>
<? } ?>