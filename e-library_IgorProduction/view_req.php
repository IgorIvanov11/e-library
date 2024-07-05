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
				<h3 id="heading"> Просмотр запросов</h3>
				<?php
					$sql = "SELECT USER.NAME, request.MES, request.LOGS from USER inner join request on USER.ID=request.ID";
					$res = $db->query($sql);
					if ($res->num_rows > 0) {
						echo "<table>
							<tr>
								<th>Номер обращения</th>
								<th>Имя пользователя</th>
								<th>Запрос</th>
								<th>Время запроса</th>
							</tr>";
							$i=0;
						while ($row = $res->fetch_assoc()) {
							$i++;
							echo "<tr>";
							echo "<td>{$i}</td>";
							echo "<td>{$row["NAME"]}</td>";
							echo "<td>{$row["MES"]}</td>";
							echo "<td>{$row["LOGS"]}</td>";
							echo "</tr>";
						}
						echo "</table>";
					} else {
						echo "<p class='error'>Не найдено запросов</p>";
					}
				?>
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