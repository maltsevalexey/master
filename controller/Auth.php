<?php
//аутентификацтя и регистрация пользователей
$data = $_POST;
//var_dump($data);
$result = '';
if($_GET['auth'] == $_SESSION['db_login']) {

//    var_dump($_SESSION);
    $result .= 'Пользователь: <b>' . $_SESSION['db_login'] . '</b><br>';
    $result .= 'Почтовый ящик: <b>' . $_SESSION['email'] . '</b><br>';
    $result .= 'Мобильный телефон: <b>' . $_SESSION['mobile'] . '</b><p></p>';
    $result .= '<form action="' . $_SERVER['PHP_SELF'] . '?auth=change"  method="POST">
                        <input type="submit" name="change" value="Изменить данные">
                     </form>';
}
           elseif($_GET['auth'] == 'change'){  //&&
                $sql = mysql_query("SELECT * FROM users WHERE login_user = '".$_SESSION['db_login']."' AND 
		password_user = '".$_SESSION['db_password']."'" ) or die (mysql_error());
                $res = mysql_fetch_row($sql);
               //var_dump($res);
               $result .= '<form action="' . $_SERVER['PHP_SELF'] . '?auth=done"  method="POST">
                        <input type="hidden" name="id"value="'.$res[0].'">
                        <label>Введите новое имя пользователя: </label>
                        <input type="text" name="changeUserName" value="'.$res[1].'"><br>
                        <label>Введите новый почтовый ящик: </label>
                        <input type="text" name="changeUserEmail" value="'.$res[3].'"><br>
                        <label>Введите новый мобильный телефон: </label>
                        <input type="text" name="changeUsermobile" value="'.$res[4].'"><br>
                        <input type="submit" name="change" value="Подтвердить изменения">
                     </form>';
                 } elseif($_GET['auth'] == 'done'){
//    var_dump($data['changeUserName']);
                             $sql = mysql_query("UPDATE users SET login_user = '".$data['changeUserName']."', 
                            email_user = '".$data['changeUserEmail']."', mobile_user = '".$data['changeUsermobile']."'
                             WHERE id_user = '". $data['id']."' ")
                            or die ($result .= '<div class="body"><h3 style="color: red">Данные не обновлены! </h3></div>');
                            $result .= '<h3 style="color: green">Данные успешно обновлены!</h3>';
                            $_SESSION['db_login'] = $data['changeUserName'];
                            $_SESSION['email'] = $data['changeUserEmail'];
                            $_SESSION['mobile'] = $data['changeUsermobile'];
//                             var_dump($_SESSION);
                }
else{
   if(isset($data['logout'])){
        unset($_SESSION['login']);
        unset($_SESSION['password']);
        unset($_SESSION['id_user']);
        unset($_SESSION['db_login']);
        unset($_SESSION['db_password']);
        $result .='<h3>Перейти на <a href="/project/index.php">главную страницу</a></h3>';

}



//аутентификаиця
if(isset($data['auth'])){


	$errors = array();
	if(empty($data['login'])){
		$errors[] = 'Вы не ввели логин';
	}
	if(empty($data['password'])){
		$errors[] = 'Вы не ввели пароль';
	}

	if(empty($errors)){
        $_SESSION['login'] = trim($data['login']);
        $_SESSION['password'] = trim($data['password']);

		$sql = mysql_query("SELECT * FROM users WHERE login_user = '".$_SESSION['login']."' AND 
		password_user = '".$_SESSION['password']."'" ) or die (mysql_error());
		$res = mysql_fetch_array($sql);



		if($res == true){
		 $result .= '<h1>Добро пожаловать, '.strtoupper($_SESSION['login']).'!</h1>';
            $result .='<h4>Перейти на <a href="'.$_SERVER['PHP_SELF'].'">главную страницу</a></h4>';
            $result .='<h4>Перейти в <a href="'.$_SERVER['PHP_SELF'].'?auth='.$_SESSION['login'].'">личный кабинет</a></h4>';

            $_SESSION['id_user'] = $res[0];
            $_SESSION['email'] = $res[3];
            $_SESSION['mobile'] = $res[4];
            $_SESSION['db_login'] = $_SESSION['login'];
            $_SESSION['db_password'] = $_SESSION['password'];
			} else{
				 $result .= 'Такого логина не существует или не верно введен пароль!<br> Вам следует зарегистрироваться';
					}
	
	} else{
			 $result .= array_shift($errors);
			}
}
//echo $result;

//регистрация новых пользователей
if(isset($data['reg'])){
	unset($_SESSION['login']);
    unset($_SESSION['password']);

   	if(trim($data['login']) == ''){
		$errors[]='Введите логин';
	}
	if(trim($data['email']) == ''){
		$errors[]='Введите email';
	}
    if(trim($data['mobile']) == ''){
        $errors[]='Введите мобильный';
    }
	if($data['password'] == '' &&
        strlen($data['password']) < 4){
		$errors[]='Введите пароль более 4-х символов';
	}
	if($data['password_again'] != $data['password']){
		$errors[]='Повторный пароль введен не верно';
	}
    if(empty($data['captcha'])||
        $_SESSION['captcha'] != $data['captcha']){
        $errors[]='Правильно введите проверочный код';
    }

		

	if(empty($errors)){
		//проверяю есть ли такой в базе
        $_SESSION['login'] = trim(trans($data['login']));
		$_SESSION['password'] = $data['password_again'];
		$_SESSION['email'] = trim($data['email']);
		$_SESSION['mobile'] = trim($data['mobile']);

		$sql = mysql_query("SELECT id_user FROM users WHERE login_user='".$_SESSION['login']."' OR 
		email_user = '".$_SESSION['email']."'")or die(mysql_error());
		$res = mysql_fetch_row($sql);
		if($res == false){
			var_dump($res);
		//регистрирую
		$sql = mysql_query("INSERT INTO users SET login_user = '".$_SESSION['login']."',
		 password_user = '".$_SESSION['password']."', mobile_user = '".$_SESSION['mobile']."', 
		 email_user = '".$_SESSION['email']."'") or die (mysql_error());
			 $result .= 'Вы успешно зарегистрированы!';
	 	
	 	}	else{
		     $result .= 'Логин <b>'.$_SESSION['login'].'</b> уже существует';

				}
	}	else{
             $result .= array_shift($errors);
			}
//	echo $result;
	 
}
}
require_once $_SERVER['DOCUMENT_ROOT']."/project/views/auth.php";



