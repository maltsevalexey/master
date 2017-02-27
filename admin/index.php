<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>
<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ панель</title>
    <!--Подгружаю свой  css -->
    <link rel="stylesheet" href="/project/admin/style/style.css">
</head>
<body id="body_admin">
<?php
$data = $_POST;

require_once $_SERVER['DOCUMENT_ROOT']."/project/db.php";

require_once $_SERVER['DOCUMENT_ROOT']."/project/admin/functions.php";

if(!empty($_SESSION['login']) && !empty($_SESSION['password']) &&
$_SESSION['id_user'] == 1){

    require_once $_SERVER['DOCUMENT_ROOT'] . "/project/admin/control_panel.php";

if(isset($_GET['add_cat'])){
    require_once $_SERVER['DOCUMENT_ROOT']."/project/admin/add_cat.php";
} elseif (isset($_GET['edit_new'])){
    require_once $_SERVER['DOCUMENT_ROOT']."/project/admin/edit_new.php";
} elseif (isset($_GET['delete_new'])){
    require_once $_SERVER['DOCUMENT_ROOT']."/project/admin/delete_new.php";
} elseif (isset($_GET['add_new'])){
    require_once $_SERVER['DOCUMENT_ROOT']."/project/admin/add_new.php";
}
} else {
    echo '<h1 align="center">Вы не администратор. Эта страница предназначена только для администратора </h1>';
}

?>
</body>
</html>


