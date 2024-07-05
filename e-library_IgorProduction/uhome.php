<?php
session_start();
include "database.php";

if (!isset($_SESSION["ID"])) {
	header("location:ulogin.php");
}

// Проверяем статус пользователя
$user_status = $_SESSION["STATUS"];

// Определяем название файла для подключения соответствующей навигационной панели
if ($user_status === "Сотрудник" || $user_status === "Оператор" || $user_status === "Модератор" || $user_status === "Эксперт") {
	$nav_bar_file = "UserSideBarC.php";
} else {
	$nav_bar_file = "UserSideBar.php";
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>АИС</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="container">
	<div id="header">
		<h1>Электронная библиотека</h1>
	</div>
	<div id="wrapper">
		<h3 id="heading"> Добро пожаловать, <?php echo $_SESSION["NAME"];?>!</h3>
	</div>
	<div id="navi">
		<?php
		include $nav_bar_file; // Подключаем соответствующую навигационную панель
		?>
	</div>
	<div id="footer">
		<p>Все права зарезервированы &copy; LLC IgorProduction </p>
	</div>
</div>
</body>
</html>
