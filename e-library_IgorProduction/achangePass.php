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
				<h3 id="heading">Смена пароля</h3>
				<div id="center">
				<?php
					if (isset($_POST["submit"]))
					{
						$sql="SELECT * from admin WHERE APASS='{$_POST["opass"]}' and AID='{$_SESSION["AID"]}'";
						$res=$db->query($sql);
						if ($res->num_rows>0)
						{
							$s = "UPDATE admin SET APASS='{$_POST["npass"]}' WHERE AID='{$_SESSION["AID"]}'";
							$db->query($s);
							echo "<p class='success'> Пароль изменён!</p>";
						}
						else
						{
							echo "<p class='error'> Неверный пароль!</p>";
						}
					}
				
				?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
					<label>Старый пароль</label>
					<input type="password" name="opass" required>
					<label>Новый пароль</label>
					<input type="password" name="npass" required>
					<button type="submit" name="submit">Обновить пароль</button>
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