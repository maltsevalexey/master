<?php

if(!empty($_GET['delete_new'])) {
    $get_id = $_GET['delete_new'];
    $sql = mysql_query("DELETE FROM news_s WHERE news_id = '" . $get_id . "' ");
        if($sql == true){
            echo '<h2 style="color: green">Новость успешно удалена!</h2>';
        } else {
            echo '<h2 style="color: red">Новость не удалена! Возникла ошибка!</h2>';
        }
} else{
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
            <th>Удаление</th>
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
                <a href="<?= $_SERVER['PHP_SELF']; ?>?delete_new=<?= $id; ?>">Удалить</a>
            </td>
            <? } ?>
        </tr>

    </table>
<? } ?>