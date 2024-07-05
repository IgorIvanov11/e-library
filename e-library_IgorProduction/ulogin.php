<?php
session_start();
include "database.php";
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
				<h3 id="heading"> Вход для пользователя</h3>
				<div id="center">
				<?php
					if (isset($_POST["submit"])) {
						$sql = "SELECT * FROM user WHERE NAME='{$_POST["name"]}' AND PASS='{$_POST["pass"]}'";
						$res = $db->query($sql);
						if ($res->num_rows > 0) {
							$row = $res->fetch_assoc();
							$_SESSION["ID"] = $row["ID"];
							$_SESSION["NAME"] = $row["NAME"];
							$_SESSION["STATUS"] = $row["STATUS"]; // Добавляем статус пользователя в сессию
							header("location: uhome.php");
						} else {
							echo "<p class='error'>Неверно указано имя или пароль!</p>";
						}
					}
				?>
				<form action="ulogin.php" method="post">
					<label> Имя </label>
					<input type="text" name="name" required>
					<label> Пароль </label>
					<input type="password" name="pass" required>
					<button type="submit" name="submit">Войти</button>
				</form>
				</div>
			</div>
			<div id="navi">
				<?php include "sideBar.php"; ?>
			</div>
			<div id="footer">
				<p>Все права зарезервированы &copy; LLC IgorProduction </p>
			</div>
		</div>
	</body>
</html>