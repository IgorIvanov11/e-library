<?php
session_start();
include "database.php";

if (!isset($_SESSION["ID"])) {
    header("location:ulogin.php");
}

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
        <h3 id="heading">Создать обращение</h3>
        <div id="center">
            <?php
            if (isset($_POST["submit"])) {
                $sql = "INSERT INTO request (ID, MES, LOGS) VALUES ({$_SESSION["ID"]}, '{$_POST["mess"]}', NOW())";
                if ($db->query($sql)) {
                    echo "<p class='success'> Обращение отправлено!</p>";
                } else {
                    echo "<p class='error'>Ошибка при отправке обращения: " . $db->error . "</p>";
                }
            }
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <label>Сообщение</label>
                <textarea required name="mess"></textarea>
                <button type="submit" name="submit">Отправить обращение</button>
            </form>
        </div>
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