<?php
session_start();
include "database.php";

if (!isset($_SESSION["AID"])) {
    header("location:alogin.php");
    exit();
}

// Проверяем, был ли передан идентификатор пользователя в URL
if (!isset($_GET["id"])) {
    echo "<p class='error'>Идентификатор пользователя не был передан.</p>";
    exit();
}

// Получаем идентификатор пользователя из URL
$user_id = $_GET["id"];

// Проверяем, существует ли пользователь с переданным идентификатором
$sql = "SELECT * FROM USER WHERE ID = $user_id";
$res = $db->query($sql);

if (!$res || $res->num_rows === 0) {
    echo "<p class='error'>Пользователь с таким идентификатором не найден.</p>";
    exit();
}

// Извлекаем данные пользователя из результата запроса
$user_data = $res->fetch_assoc();

// Проверяем, была ли отправлена форма для редактирования данных пользователя
if (isset($_POST["submit"])) {
    // Получаем данные из формы
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $status = $_POST["status"];

    // Обновляем данные пользователя в базе данных
    $update_sql = "UPDATE USER SET NAME = '$name', MAIL = '$mail', STATUS = '$status' WHERE ID = $user_id";
    $db->query($update_sql);

    echo "<p class='success'>Данные пользователя успешно обновлены.</p>";
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
        <h3 id="heading"> Редактирование пользователя</h3>
        <div id="center">
            <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $user_id; ?>" method="post">
                <label>Имя</label>
                <input type="text" name="name" value="<?php echo $user_data["NAME"]; ?>" required>
                <label>Почта</label>
                <input type="email" name="mail" value="<?php echo $user_data["MAIL"]; ?>" required>
                <label>Статус</label>
                <select name="status" required>
                    <option value="Гость" <?php if ($user_data["STATUS"] == "Гость") echo "selected"; ?>>Гость</option>
                    <option value="Сотрудник" <?php if ($user_data["STATUS"] == "Сотрудник") echo "selected"; ?>>Сотрудник</option>
                    <option value="Оператор" <?php if ($user_data["STATUS"] == "Оператор") echo "selected"; ?>>Оператор</option>
                    <option value="Модератор" <?php if ($user_data["STATUS"] == "Модератор") echo "selected"; ?>>Модератор</option>
                    <option value="Эксперт" <?php if ($user_data["STATUS"] == "Эксперт") echo "selected"; ?>>Эксперт</option>
                    <option value="Администратор" <?php if ($user_data["STATUS"] == "Администратор") echo "selected"; ?>>Администратор</option>
                </select>
                <button type="submit" name="submit">Сохранить изменения</button>
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