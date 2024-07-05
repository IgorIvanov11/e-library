<?php
session_start();
include "database.php";

if (!isset($_SESSION["AID"])) {
    header("location:alogin.php");
    exit();
}

if (isset($_POST["submit"])) {
    $bname = $_POST["bname"];
    $keys = $_POST["keys"];
    $status = $_POST["status"];
    $description = $_POST["description"];
    $year = $_POST["year"]; // Добавлено получение года выпуска из формы
    $developer = $_POST["developer"]; // Добавлено получение разработчика из формы
    $producer = $_POST["producer"]; // Добавлено получение изготовителя из формы

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["efile"]["name"]);
    if (move_uploaded_file($_FILES["efile"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO book (BTITLE, KEYWORDS, FILE, STATUS, DESCRIPTION, YEAR, DEVELOPER, PRODUCER) 
                VALUES ('$bname', '$keys', '$target_file', '$status', '$description', '$year', '$developer', '$producer')";
        if ($db->query($sql)) {
            echo "<p class='success'>Загрузка выполнена успешно!</p>";
        } else {
            echo "<p class='error'>Ошибка при загрузке</p>";
        }
    } else {
        echo "<p class='error'>Ошибка при загрузке</p>";
    }
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
        <h3 id="heading">Загрузка документации</h3>
        <div id="center">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                <label>Название</label>
                <input type="text" name="bname" required>
                <label>Ключевые слова для поиска</label>
                <textarea name="keys" required></textarea>
                <label>Статус</label>
                <select name="status">
                    <option value="Открытый">Открытый</option>
                    <option value="Действующий">Действующий</option>
                    <option value="Архивный">Архивный</option>
                    <option value="Скрытый">Скрытый</option>
                    <option value="Закрытый">Закрытый</option>
                    <option value="На экспертизу">На экспертизу</option>
                </select>
                <label>Описание</label>
                <textarea name="description"></textarea>
                <label>Год выпуска</label> <!-- Добавлено поле для указания года выпуска -->
                <input type="text" name="year" required>
                <label>Разработчик</label> <!-- Добавлено поле для указания разработчика -->
                <input type="text" name="developer" required>
                <label>Изготовитель</label> <!-- Добавлено поле для указания изготовителя -->
                <input type="text" name="producer" required>
                <label>Загрузить файл</label>
                <input type="file" name="efile" required>
                <button type="submit" name="submit">Добавить документ</button>
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