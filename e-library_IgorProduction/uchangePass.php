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
        <h3 id="heading">Смена пароля</h3>
        <div id="center">
            <?php
            if (isset($_POST["submit"])) {
                $sql = "SELECT * FROM user WHERE PASS='{$_POST["opass"]}' AND ID='{$_SESSION["ID"]}'";
                $res = $db->query($sql);
                if ($res->num_rows > 0) {
                    $new_password = $_POST["npass"];
                    $update_sql = "UPDATE user SET PASS='$new_password' WHERE ID='{$_SESSION["ID"]}'";
                    if ($db->query($update_sql)) {
                        echo "<p class='success'> Пароль успешно изменён!</p>";
                    } else {
                        echo "<p class='error'>Ошибка при изменении пароля: " . $db->error . "</p>";
                    }
                } else {
                    echo "<p class='error'> Неверный пароль!</p>";
                }
            }
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
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
        include $nav_bar_file; // Подключаем соответствующую навигационную панель
        ?>
    </div>
    <div id="footer">
        <p>Все права зарезервированы &copy; LLC IgorProduction </p>
    </div>
</div>
</body>
</html>