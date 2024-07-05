<?php
session_start();
include "database.php";

if (!isset($_SESSION["AID"]))
{
	header("location:alogin.php");
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>АИС</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"> </head>
	<body>
		<div id="container">
			<div id="header">
				<h1>Электронная библиотека</h1>
			</div>
			<div id="wrapper">
				<h3 id="heading">Регистрация нового пользователя</h3>
				<div id="center">
				<?php
					if (isset($_POST["submit"]))
					{
						
							$sql = "INSERT INTO user (NAME, PASS, MAIL, STATUS) VALUES ('{$_POST["name"]}', '{$_POST["pass"]}', '{$_POST["mail"]}', '{$_POST["status"]}')";
							$db->query($sql);
							echo "<p class='success'>Пользователь успешно добавлен!</p>";
						
					}
				
				?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
					<label>Имя</label>
					<input type="text" name="name" required>
					<label>Пароль</label>
					<input type="password" name="pass" required>
					<label>Почта</label>
					<input type="email" name="mail" required>
					<label>Статус</label>
					<select name="status" required>
						<option value="Гость">Гость</option>
						<option value="Сотрудник">Сотрудник</option>
						<option value="Оператор">Оператор</option>
						<option value="Модератор">Модератор</option>
						<option value="Эксперт">Эксперт</option>
						<option value="Администратор">Администратор</option>
					</select>
					<button type="submit" name="submit">Добавить пользователя</button>
					</form>
				</div>
			</div>
			<div id="navi">
				<?php
					include "AdminSideBar.php"
				?>
			</div>
			<div id="footer">
				<p>Все права зарезервированы &copy; LLC IgorProduction </p>
			</div>
		</div>
	</body>
</html>