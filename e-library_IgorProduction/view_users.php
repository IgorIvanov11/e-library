<?php
session_start();
include "database.php";

if (!isset($_SESSION["AID"])) {
    header("location:alogin.php");
    exit();
}

if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $user_id = $_GET["id"];
    // В данном месте можете добавить дополнительные проверки безопасности, например, проверку роли пользователя.
    $delete_sql = "DELETE FROM USER WHERE ID = $user_id";
    $db->query($delete_sql);
    header("location:view_users.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>АИС</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        function confirmDelete() {
            return confirm("Вы уверены, что хотите удалить этого пользователя?");
        }
    </script>
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Электронная библиотека</h1>
    </div>
    <div id="wrapper">
        <h3 id="heading"> Просмотр пользователей</h3>
        <?php
        $sql = "SELECT ID, NAME, MAIL, STATUS FROM USER";
        $res = $db->query($sql);
        if ($res->num_rows > 0) {
            echo "<table>
							<tr>
								<th>Имя пользователя</th>
								<th>Почта</th>
								<th>Статус</th>
								<th>Действия</th>
								<th>Удалить</th> <!-- Добавлен столбец для кнопки удаления -->
							</tr>";
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row["NAME"]}</td>";
                echo "<td>{$row["MAIL"]}</td>";
                echo "<td>{$row["STATUS"]}</td>";
                echo "<td><a href='edit_user.php?id={$row["ID"]}'>Редактировать</a></td>";
                // Добавляем кнопку "Удалить" с подтверждением
                echo "<td><a href='view_users.php?action=delete&id={$row["ID"]}' onclick='return confirmDelete();'>Удалить</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='error'>Не найдено пользователей</p>";
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
