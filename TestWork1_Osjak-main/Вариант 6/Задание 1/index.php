<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <form method="GET">
            <label>Введите строку с пробелами: <input type="text" name="task1"></label><br>
            <input type="submit" value="Удалить лишние пробелы"><br><br>
        </form>
        <?php
        function spaceRemove($str) {
            $str = trim($str);
            $str = preg_replace('/\s+/', ' ', $str);
            return $str;
        }
        if (isset($_GET['task1']) && !empty(trim($_GET['task1']))) {
            $inputString = $_GET['task1'];
            echo "<h3>Результат:</h3>";
            echo "Исходная строка: \"$inputString\"<br>";
            $result = spaceRemove($inputString);
            echo "Обработанная строка: \"$result\"<br>";
        } else {
            echo "<p>Введите строку в форму выше для обработки</p>";
        }
        ?>
    </body>
</html>