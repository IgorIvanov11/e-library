<?php
session_start();
include "database.php";

if (!isset($_SESSION["ID"])) {
    header("location: ulogin.php");
    exit();
}

// Проверяем, был ли передан идентификатор книги в URL
if (!isset($_GET["id"])) {
    echo "<p class='error'>Идентификатор книги не был передан.</p>";
    exit();
}

// Получаем идентификатор книги из URL
$book_id = $_GET["id"];

// Проверяем, существует ли книга с переданным идентификатором
$sql = "SELECT * FROM book WHERE BID = $book_id";
$res = $db->query($sql);

if (!$res || $res->num_rows === 0) {
    echo "<p class='error'>Книга с таким идентификатором не найдена.</p>";
    exit();
}

// Извлекаем данные о книге из результата запроса
$book_data = $res->fetch_assoc();

// Определяем доступные статусы для сотрудников
$employee_statuses = array("Открытый", "Действующий", "Архивный");

// Определяем доступные статусы для экспертов
$expert_statuses = array("Открытый", "Действующий", "Архивный", "ДСП", "Скрытый", "Закрытый", "На экспертизу");

// Определяем массив статусов в зависимости от статуса пользователя
$statuses = ($_SESSION["STATUS"] === "Эксперт") ? $expert_statuses : $employee_statuses;

if (isset($_POST["submit"])) {
    // Получаем данные из формы
    $title = $_POST["title"];
    $description = $_POST["description"];
    $developer = $_POST["developer"];
    $year = $_POST["year"];
    $producer = $_POST["producer"];
    $status = $_POST["status"];

    // Создаем запрос на обновление данных о книге
    $update_sql = "UPDATE book SET BTITLE = '$title', DESCRIPTION = '$description', DEVELOPER = '$developer', YEAR = '$year', PRODUCER = '$producer', STATUS = '$status' WHERE BID = $book_id";

    // Выполняем запрос на обновление данных
    if ($db->query($update_sql) === TRUE) {
        echo "<p class='success'>Информация успешно обновлена.</p>";
    } else {
        echo "<p class='error'>Ошибка при обновлении информации: " . $db->error . "</p>";
    }
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Редактирование книги</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Электронная библиотека</h1>
    </div>
    <div id="wrapper">
        <h3 id="heading">Редактирование информации о книге</h3>
        <div id="center">
            <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $book_id; ?>" method="post">
                <label>Название</label>
                <input type="text" name="title" value="<?php echo $book_data["BTITLE"]; ?>" required>
                <label>Описание</label>
                <textarea name="description" required><?php echo $book_data["DESCRIPTION"]; ?></textarea>
                <label>Разработчик</label>
                <input type="text" name="developer" value="<?php echo $book_data["DEVELOPER"]; ?>" required>
                <label>Год выпуска</label>
                <input type="text" name="year" value="<?php echo $book_data["YEAR"]; ?>" required>
                <label>Изготовитель</label>
                <input type="text" name="producer" value="<?php echo $book_data["PRODUCER"]; ?>" required>
                <label>Статус</label>
                <select name="status" required>
                    <?php
                    // Выводим доступные статусы в зависимости от статуса пользователя
                    foreach ($statuses as $status) {
                        echo "<option value=\"$status\" ";
                        if ($book_data["STATUS"] === $status) echo "selected";
                        echo ">$status</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="submit">Сохранить изменения</button>
            </form>
        </div>
    </div>
    <div id="navi">
        <?php include "UserSideBarC.php"; ?>
    </div>
    <div id="footer">
        <p>Все права защищены &copy; LLC IgorProduction </p>
    </div>
</div>
</body>
</html>