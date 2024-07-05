<?php
session_start();
include "database.php";

if (!isset($_SESSION["ID"])) {
    header("location:ulogin.php");
    exit();
}

// Массив доступных статусов для сотрудников
$employee_statuses = array("Открытый", "Действующий", "Архивный");

// Массив доступных статусов для эксперта
$expert_statuses = array("Открытый", "Действующий", "Архивный", "ДСП", "Скрытый", "Закрытый", "На экспертизу");

// Определяем название файла для подключения соответствующей навигационной панели
if ($_SESSION["STATUS"] === "Сотрудник" || $_SESSION["STATUS"] === "Оператор" || $_SESSION["STATUS"] === "Модератор" || $_SESSION["STATUS"] === "Эксперт") {
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
        <h3 id="heading">Поиск документации</h3>
        <div id="center">
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <label>Введите название документа или ключевое слово</label>
                <textarea name="name"></textarea>
                <label>Выберите статус</label>
                <select name="status">
                    <?php
                    if ($_SESSION["STATUS"] === "Сотрудник" || $_SESSION["STATUS"] === "Оператор" || $_SESSION["STATUS"] === "Гость") {
                        foreach ($employee_statuses as $status) {
                            echo "<option value=\"$status\">$status</option>";
                        }
                    } elseif ($_SESSION["STATUS"] === "Модератор") {
                        $all_statuses = array_merge($employee_statuses, array("ДСП"));
                        foreach ($all_statuses as $status) {
                            echo "<option value=\"$status\">$status</option>";
                        }
                    } else {
                        foreach ($expert_statuses as $status) {
                            echo "<option value=\"$status\">$status</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit" name="submit">Поиск</button>
            </form>
        </div>
        
        <?php
        if (isset($_POST["submit"])) {
            $search_term = $_POST["name"];
            $status = $_POST["status"]; // Получаем выбранный статус из формы

            // Создаем запрос SQL с учетом поиска по названию, ключевым словам и статусу
            $sql = "SELECT * FROM book 
                    WHERE (BTITLE LIKE '%$search_term%' OR keywords LIKE '%$search_term%')
                    AND STATUS = '$status'";

            // Выполняем запрос
            $res = $db->query($sql);

            // Проверяем результат запроса
            if ($res) {
                if ($res->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>Название</th>
                                <th>Описание</th> <!-- Добавлен столбец с описанием -->
                                <th>Разработчик</th> <!-- Добавлен столбец с разработчиком -->
                                <th>Год выпуска</th> <!-- Добавлен столбец с годом выпуска -->
                                <th>Изготовитель</th> <!-- Добавлен столбец с изготовителем -->
                                <th>Просмотр</th>";
                    if ($_SESSION["STATUS"] === 'Модератор'|| $_SESSION["STATUS"] === "Эксперт") { ?>
                        <th>Редактировать</th>
                    <?php }
                    echo "</tr>";
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row["BTITLE"]}</td>";
                        echo "<td>{$row["DESCRIPTION"]}</td>"; // Выводим описание
                        echo "<td>{$row["DEVELOPER"]}</td>"; // Выводим разработчика
                        echo "<td>{$row["YEAR"]}</td>"; // Выводим год выпуска
                        echo "<td>{$row["PRODUCER"]}</td>"; // Выводим изготовителя
                        echo "<td><a href='{$row["FILE"]}' target='_blank'>Посмотреть</a></td>";
                        if ($_SESSION["STATUS"] === "Модератор"|| $_SESSION["STATUS"] === "Эксперт") {
                            echo "<td><a href='edit_book.php?id={$row["BID"]}'>Редактировать</a></td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='error'>Не найдено документации по Вашему запросу</p>";
                }
            } else {
                echo "<p class='error'>Ошибка выполнения запроса: " . $db->error . "</p>";
            }
        }
        ?>
    </div>
    <div id="navi">
        <?php
        include $nav_bar_file;
        ?>
    </div>
    <div id="footer">
        <p>Все права зарезервированы &copy; LLC IgorProduction </p>
    </div>
</div>
</body>
</html>