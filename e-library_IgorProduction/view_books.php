<?php
session_start();
include "database.php";

if (!isset($_SESSION["AID"])) {
    header("location:alogin.php");
    exit();
}

if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $book_id = $_GET["id"];
    // В данном месте можете добавить дополнительные проверки безопасности.
    $delete_sql = "DELETE FROM book WHERE BID = $book_id";
    $db->query($delete_sql);
    header("location:view_books.php");
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
            return confirm("Вы уверены, что хотите удалить эту книгу?");
        }
    </script>
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Электронная библиотека</h1>
    </div>
    <div id="wrapper">
        <h3 id="heading"> Просмотр документации</h3>
        <?php
        $sql = "SELECT BID, BTITLE, FILE, STATUS, DESCRIPTION, YEAR, DEVELOPER, PRODUCER FROM book"; // Добавлены новые столбцы
        $res = $db->query($sql);
        if ($res->num_rows > 0) {
            echo "<table>
							<tr>
								<th>Название</th>
								<th>Просмотр</th>
								<th>Статус</th>
								<th>Описание</th>
                                <th>Год выпуска</th> <!-- Добавлен столбец для года выпуска -->
                                <th>Разработчик</th> <!-- Добавлен столбец для разработчика -->
                                <th>Изготовитель</th> <!-- Добавлен столбец для изготовителя -->
								<th>Удалить</th> <!-- Добавлен столбец для кнопки удаления -->
							</tr>";
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row["BTITLE"]}</td>";
                echo "<td><a href='{$row["FILE"]}' target='_blank'>Посмотреть</a></td>";
                echo "<td>{$row["STATUS"]}</td>"; // Отображение статуса
                echo "<td>{$row["DESCRIPTION"]}</td>"; // Отображение описания
                echo "<td>{$row["YEAR"]}</td>"; // Отображение года выпуска
                echo "<td>{$row["DEVELOPER"]}</td>"; // Отображение разработчика
                echo "<td>{$row["PRODUCER"]}</td>"; // Отображение изготовителя
                // Добавляем кнопку "Удалить" с подтверждением
                echo "<td><a href='view_books.php?action=delete&id={$row["BID"]}' onclick='return confirmDelete();'>Удалить</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='error'>Не найдено документации</p>";
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