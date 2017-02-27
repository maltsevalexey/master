<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/project/images/';
if(isset($data['accept'])){
    $data['category_id'] = get_cat_int($data['category_id']);
    $date = date("Y-m-d", strtotime($data['date_news']));
    //var_dump($data['picture']);
   if(empty($_FILES['picture']['name'])){
//обновляю инфу при условии, что изображения я не загружал
       $sql = mysql_query("UPDATE news_s SET news_name = '".$data['news_name']."', 
       news_description = '".$data['news_description']."',  news = '".$data['news']."', 
       category_id = '".$data['category_id']."', date_news= '".$date."' WHERE news_id = '". $data['id']."' ")
       or die("<h2 align='center' style='color: red'>Данные не обновлены!</h2>");

       echo '<h2 align="center" style="color: green">Данные успешно обновлены! Фото новости не менялось!</h2>';
   } else {
//обновляю инфу при условии, что изображение я  загружал
            //var_dump($_FILES);
            copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']) or die('Не загружается');//копирование изображения в папку на сервере
            $img_news = '/project/images/'. $_FILES['picture']['name'];//переменная дя БД
            $sql = mysql_query("UPDATE news_s SET news_name = '".$data['news_name']."', 
            news_description = '".$data['news_description']."',  news = '".$data['news']."', 
           category_id = '".$data['category_id']."', date_news= '".$date."', news_image = '".$img_news."'  WHERE news_id = '". $data['id']."' ")
           or die("<h2 align='center'  style='color: red'>Данные не обновлены!</h2>");// в запросе использовал $data['id'], хотя мог и GET, но зато Get не мелькает в запросе в БД - типа безопасность!!
           echo '<h2 align="center"  style="color: green">Данные успешно обновлены! Фото новости изменено!</h2>';
        }
} else{
if(!empty($_GET['edit_new'])){
    $get_id = $_GET['edit_new'];
    $sql = mysql_query("SELECT * FROM news_s WHERE news_id = '".$get_id."' ");
    $res = mysql_fetch_row($sql);
    //var_dump($res);

    ?>
    <section >
    <form method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $res[0]; ?>" >
        <div class="label">
        <label>Название новости:</label>
        <input type="text" name="news_name" value="<?= $res[1]; ?>" size="71" >
            </div>
        <p></p>
        <div class="label">
        <label>Краткое описание новости:</label>
            <textarea rows="10" cols="70" name="news_description" ><?= $res[2]; ?></textarea><br>
            </div>
        <p></p>
        <div class="label">
        <label>Новость:</label>

        <textarea class="text_new" rows="20" cols="70" name="news"><?= $res[3]; ?></textarea>
            </div>
        <p></p>
        <div class="label">
        <label>Категория новости:</label>

        <input class="inp_1" type="text" name="category_id" value="<?= get_cat($res[4]); ?>" size="71" >
        </div>
        <p></p>
        <div class="label">
        <label>Загрузить фото новости: </label>
        <input class="inp_file" type="file" name="picture"><p style="color: purple">**Если файл не выбран, фото новости меняться не будет</p>
            </div>
        <div class="label">
        <label>Дата публикации:</label>
        <input class="inp_date" type="text" name="date_news" value="<?= date("d.m.Y", strtotime($res[6])); ?>" >
        <p></p>
        </div>
        <input  class="res" type="reset" value="Сбросить значения">
        <input class="accept" type="submit" name="accept" value="Подтвердить изменения">

    </form>
    </section>
    <?
} else {



$sql = mysql_query("SELECT * FROM news_s");
while($res[]= mysql_fetch_array($sql)){
    $total = $res;
}
//var_dump($total);
?>

    <table border="1" cellpadding="5" align="center" >
    <tr>
        <th>ID</th>
        <th>Название новости</th>
        <th>Описание новости</th>
        <th>Новость</th>
        <th>Категория новости</th>
        <th>Фото новости</th>
        <th>Дата новости</th>
        <th>Редактирование</th>
    </tr>

            <? foreach($total as $v){
                $id = $v['news_id'];
                $news_name = $v['news_name'];
                $news_desc = $v['news_description'];
                $news = mb_substr($v['news'], 0, 100, "UTF-8").' <b>...</b>';
                $cat_id = $v['category_id'];

            $img = $v['news_image'];
                $date =  date("d.m.Y", strtotime($v['date_news']));
            ?>
         <tr>
                <td><?= $id; ?></td>
                <td><?= $news_name; ?></td>
                <td><?= $news_desc; ?></td>
                <td><?= $news; ?></td>
                <td><?= get_cat($cat_id); ?></td>
                <td><img width="100px" src="<?= $img; ?>"></td>
                <td><?= $date; ?></td>
                <td>
                        <a href="<?= $_SERVER['PHP_SELF']; ?>?edit_new=<?= $id; ?>">Редактировать</a>
                </td>
           <? } ?>
        </tr>

    </table>

<? }
}?>