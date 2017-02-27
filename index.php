<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT']."/project/db.php";

require_once $_SERVER['DOCUMENT_ROOT']."/project/controller/Functions.php";

require_once $_SERVER['DOCUMENT_ROOT']."/project/controller/Header.php";
;
if($_SERVER['REQUEST_URI'] == '/project/' || $_SERVER['REQUEST_URI'] == $_SERVER['PHP_SELF'] ||
	isset($_GET['page']) && $_GET['page'] !=''){
    require_once $_SERVER['DOCUMENT_ROOT']."/project/controller/Home.php";
    }   elseif(isset($_GET['auth'])&& $_GET['auth'] !='' ){
    require_once $_SERVER['DOCUMENT_ROOT']."/project/controller/Auth.php";
    }   elseif(isset($_GET['inform'])&& $_GET['inform'] !='') {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/project/controller/Inform.php";
    } elseif( isset($_GET['catalog'])&& $_GET['catalog'] !='' || isset($_GET['page']) && $_GET['page']) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/project/controller/Catalog.php";
    } elseif( isset($_GET['news'])&& $_GET['news'] !='') {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/project/controller/News.php";
    } elseif( isset($_GET['search'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/project/controller/Search.php";
    } else{   
        require_once $_SERVER['DOCUMENT_ROOT'] . "/project/controller/404.php";
    	} 

    require_once $_SERVER['DOCUMENT_ROOT'] . "/project/controller/Footer.php";


?>