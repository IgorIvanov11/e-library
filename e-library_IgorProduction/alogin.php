<?php
session_start();
	include "database.php";
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
				<h3 id="heading"> Вход для администратора</h3>
				<div id="center">
				<?php
					if (isset($_POST["submit"]))
					{
						$sql="SELECT * FROM admin where ANAME='{$_POST["aname"]}' and APASS='{$_POST["apass"]}'";
						$res=$db->query($sql);
						if($res->num_rows>0)
						{
							$row=$res->fetch_assoc();
							$_SESSION["AID"]=$row["AID"];
							$_SESSION["ANAME"]=$row["ANAME"];
							header("location:ahome.php");
						}
						else
						{
							echo "<p class='error'>Неверно указано имя или пароль!</p>";
						}
					}
				?>
				<form action="alogin.php" method="post">
					<label> Имя </label>
					<input type="text" name="aname" required>
					<label> Пароль </label>
					<input type="password" name="apass" required>
					<button type="submit" name="submit">Войти</button>
				</form>
				</div>
			</div>
			<div id="navi">
				<?php
					include "sideBar.php"
				?>
			</div>
			<div id="footer">
				<p>Все права зарезервированы &copy; LLC IgorProduction </p>
			</div>
		</div>
	</body>
</html>