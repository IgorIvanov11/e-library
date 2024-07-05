<?php
session_start();
include "database.php";

function counRecord($sql,$db)
{
	$res=$db->query($sql);
	return $res->num_rows;
}
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
				<h3 id="heading"> Добро пожаловать, администратор!</h3>
				<div id="center">
					<ul class="record">
						<li>Всего Сотрудников :<?php echo counRecord("select * from user",$db); ?></li>
						<li>Всего Документации :<?php echo counRecord("select * from book",$db); ?></li>
						<li>Всего Запросов :<?php echo counRecord("select * from request",$db); ?></li>
					</ul>
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