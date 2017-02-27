<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новостной сайт</title>
    <!--Подгружаю свой  css -->
    <link rel="stylesheet" href="/project/views/style/style.css">

    <!--Подгружаю  bootstrap css -->
    <link rel="stylesheet" href="/project/bootstrap3_3_7_js_jquery/css/bootstrap.css">
      <!--Подгружаю  theme css -->
    <link rel="stylesheet" href="/project/bootstrap3_3_7_js_jquery/css/bootstrap-theme.css">
   

</head>
<body>
		<!--Подгружаю библиотеку jquery-migrate -->
	<script src="/project/bootstrap3_3_7_js_jquery/jquery-migrate-1.4.1.min.js"></script>
		<!--Подгружаю сам jquery-3.1.1  -->
	<script src="/project/bootstrap3_3_7_js_jquery/jquery-3.1.1.min.js"></script>
	<!--Подгружаю js -->
	<script src="/project/bootstrap3_3_7_js_jquery/js/bootstrap.js"></script>

<header class="header">

		<ul class="top_menu">
			<li><a  href="<?= $_SERVER['PHP_SELF']; ?>">Главная</a></li>
			<? foreach ($total_category as $v_cat) {
				$category_id = $v_cat['category_id'];
				$category_name = $v_cat['category_name'];
				$category_description = $v_cat['category_description'];
			?>
			<li><a  href="<?= $_SERVER['PHP_SELF']; ?>?catalog=<?= $category_id; ?> "><?= $category_description; ?></a></li>

			<? } ?>
			<li><a href="<?= $_SERVER['PHP_SELF']; ?>?news=<?= $news_rand_id; ?>">Новость дня</a></li>
			<li><a  href="<?= $_SERVER['PHP_SELF']; ?>?inform=about_us">О нас</a></li>
			</ul>

<div class="down">
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="GET">
					<input type="textarea" name="search_text" placeholder="поиск" >
					<input type="submit" name="search" value="Поиск" >
			</form>

				<button name="log" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal_auth">
				<span class = "glyphicon glyphicon-log-in">

				</span>&nbsp;Войти
				</button>
	<? if(!empty($_SESSION['db_login']) && !empty($_SESSION['db_password']) ){?>
		<form action="<?= $_SERVER['PHP_SELF']; ?>?auth=<?= $_SESSION['db_login']; ?>"
			  method = "POST">
			<button type="submit" name="dan" class="btn btn-primary" >
				<span class = "	glyphicon glyphicon-briefcase"></span>&nbsp;Личный кабинет
			</button>
		</form>
		<form action="<?= $_SERVER['PHP_SELF']; ?>?auth=out" method = "POST">
			<button type="submit" name="logout" class="btn btn-primary" >
				<span class = "	glyphicon glyphicon-log-out"></span>&nbsp;Выйти
			</button>
			</form>



	<? } ?>




</div>

	<div class = "modal fade" id = "modal_auth"  role="dialog">
		<div class = "modal-dialog modal-sm" role="document">
			<div class = "modal-content " >
				<div class = "modal-header">
					<button class="close" type="button" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					</button>
					<h3 align="center" class = "modal-title">Авторизация</h3>
					<div class = "modal-body">
					<form action="<?= $_SERVER['PHP_SELF']; ?>?auth=in"  method = "POST">
						<label>Ваш логин:</label>
						<input type="text" class="form-control" name="login" placeholder="логин" ><br>
						<label>Ваш пароль:</label>
						<input type="password" class="form-control" name="password" placeholder="пароль"><br>

						<button type="submit" name="auth" class="btn btn-success btn-md btn-block" >
							<span class = "glyphicon glyphicon-log-in"></span>&nbsp;Войти
						</button>

						

					</form> 
					<br>
						<button  type="button"  class="btn btn-primary btn-block" data-dismiss="modal" data-toggle="modal" data-target="#modal_register" >
						<span class = "glyphicon glyphicon-user"></span>&nbsp;Регистрация</button>
						<br>

							<div align="right" class="modal-footer">
										
								<label>
								<button  class="btn btn-danger" type="button" data-dismiss="modal">Закрыть</button>
								</label>
							</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class = "modal fade " id = "modal_register">
		<div class = "modal-dialog modal-sm">
			<div class = "modal-content " >
				<div class = "modal-header">
					<button class="close" type="button" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					</button>
					<h3 align="center" class="modal-title">Регистрация</h3>
					<div class = "modal-body">
						<form action="<?= $_SERVER['PHP_SELF']; ?>?auth=reg"   method ="POST">
						<label>Ваш логин:</label>
						<input type="text" class="form-control" name="login" placeholder="логин">
						<label>Ваш E-mail:</label>
						<input type="text" class="form-control" name="email" placeholder="E-mail">
						<label>Ваш мобильный телефон:</label>
						<input type="text" class="form-control" name="mobile" placeholder="мобильный телефон">
						<label>Ваш пароль:</label>
						<input type="password" class="form-control" name="password" placeholder="пароль">
						<label>Ваш пароль еще раз:</label>
						<input type="password" class="form-control" name="password_again" placeholder="пароль еще раз">
                            <label>Введите капчу:</label><br>

                                <img  src='/project/controller/Captcha.php' id = 'captcha' cursor: pointer; onclick="document.getElementById('captcha').src = '/project/controller/Captcha.php?' "  ><br>
							<input  type="text" name="captcha">
							<p></p>

						<input  type="reset" class="btn btn-default btn-block" value="Очистить поля"><br>


                            <button type="submit" name="reg" class="btn btn-success btn-md btn-block" >
                                <span>Зарегистрироваться</span>
                            </button>

						</form>
						<br>
	
						<div align="right" class="modal-footer">
							<label>
								<button  class="btn btn-danger" type="button" data-dismiss="modal">Закрыть</button>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
		<div class="wrapper">