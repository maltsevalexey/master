<?php
$errors = array();

if (isset($data['addCat'])){
    if (empty($data['cat_name'])) {
        $errors[] = 'Укажите название категории';
    }
    if (empty($data['cat_disc'])) {
        $errors[] = 'Укажите описание категории';
    }



    if (empty($errors)) {
        $sql_cat = mysql_query("SELECT category_id FROM categories WHERE category_name = '" . $data['cat_name'] . "' 
        AND category_description = '" . $data['cat_disc'] . "'  ");
        $res = mysql_fetch_array($sql_cat);
        if ($res == false) {
            $sql_cat_add = mysql_query("INSERT INTO categories (category_name, category_description)
            VALUES('" . $data['cat_name'] . "', '" . $data['cat_disc'] . "' ) ") or die ("<h2 align='center' style='color:red'>Категория не добавлена</h2>");
            if ($sql_cat_add == true) {
                echo '<h2 align="center"  style="color:green">Категория успешно добавлена</h2>';
            }
        } else{
            echo '<h2 align="center" style="color:red">Такая категория уже существует';
        }
    }  else{
        echo '<span style="color:red" >' .$errors[0] . '</span><br>';
    }
}else{
        ?>
        <section>
        <form method="POST">
            <div class="label">
            <label>Название категории: </label>
            <input type="text" name="cat_name" placeholder="Название категории" size="70">
            <p></p>
                </div>
                <div class="label">
            <label>Описание категории: </label>
            <textarea class="text_cat" rows="10" cols="68" name="cat_disc" placeholder="Описание категории"></textarea>

            <p></p>
            <input class="sub_cat" type="submit" name="addCat" value="Добавить категорию">
                </div>
        </form>
        </section>
    <?php }







