<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задания со стрелочными функциями</title>
</head>
<body>
    <h1>Задание 1 - Длина окружности</h1>
    <form method="post">
        Радиус: <input type="number" name="radius1" step="any" required>
        <button type="submit" name="submit1">Вычислить</button>
    </form>
    <?php
    $pi = 3.141592653589793;
    $circleCircumference = fn($r) => 2 * $pi * $r;
    if (isset($_POST['submit1'])) {
        $r = (float)$_POST['radius1'];
        echo "Длина окружности при радиусе <b>$r</b>: <b>", $circleCircumference($r), "</b><br>";
    }
    ?>
    <h1>Задание 2 - Площадь круга</h1>
    <form method="post">
        Радиус: <input type="number" name="radius2" step="any" required>
        <button type="submit" name="submit2">Вычислить</button>
    </form>
    <?php
    $circleArea = fn($r) => $pi * $r ** 2;
    if (isset($_POST['submit2'])) {
        $r = (float)$_POST['radius2'];
        echo "Площадь круга при радиусе <b>$r</b>: <b>", $circleArea($r), "</b><br>";
    }
    ?>
    <h1>Задание 3-4 - Площадь треугольника</h1>
    <form method="post">
        Сторона a: <input type="number" name="a" step="any" required>
        Сторона b: <input type="number" name="b" step="any" required>
        Сторона c: <input type="number" name="c" step="any" required>
        <button type="submit" name="submit3">Вычислить</button>
    </form>
    <?php
    $triangleArea = fn($a, $b, $c) =>
        ($a + $b > $c && $a + $c > $b && $b + $c > $a) ?
            sqrt(($a + $b + $c) / 2 * (($a + $b + $c) / 2 - $a) * (($a + $b + $c) / 2 - $b) * (($a + $b + $c) / 2 - $c))
            : 0;
    if (isset($_POST['submit3'])) {
        $a = (float)$_POST['a'];
        $b = (float)$_POST['b'];
        $c = (float)$_POST['c'];
        $area = $triangleArea($a, $b, $c);
        if ($area == 0) {
            echo "Треугольник с такими сторонами не существует.<br>";
        } else {
            echo "Площадь треугольника со сторонами <b>$a, $b, $c</b>: <b>$area</b><br>";
        }
    }
    ?>
    <h1>Задание 5 - Сравнение чисел</h1>
    <form method="post">
        Число 1: <input type="number" name="num1" step="any" required>
        Число 2: <input type="number" name="num2" step="any" required>
        <button type="submit" name="submit5">Сравнить</button>
    </form>
    <?php
    $compareNumbers = fn($x, $y) => $x > $y ? "$x больше чем $y" : ($x < $y ? "$x меньше чем $y" : "$x равно $y");
    if (isset($_POST['submit5'])) {
        $x = (float)$_POST['num1'];
        $y = (float)$_POST['num2'];
        echo "Результат сравнения: <b>", $compareNumbers($x, $y), "</b><br>";
    }
    ?>
    <h1>Задание 6 - Проверка длины строки</h1>
    <form method="post">
        Введите строку: <input type="text" name="text" required>
        <button type="submit" name="submit6">Проверить</button>
    </form>
    <?php
    $stringLengthCheck = fn($str) => strlen($str) > 79 ? "Строка - длинная" : (strlen($str) < 32 ? "Строка - короткая" : "Строка - нормальная");
    if (isset($_POST['submit6'])) {
        $str = $_POST['text'];
        echo "Результат проверки строки: <b>", $stringLengthCheck($str), "</b><br>";
    }
    ?>
    <h1>Задание 7 - Хватит ли денег на хлеб</h1>
    <form method="post">
        Введите сумму денег: <input type="number" name="money" step="any" required>
        <button type="submit" name="submit7">Проверить</button>
    </form>
    <?php
    $checkMoney = fn($money) =>
        $money == 50 ? "Денег ровно на хлеб" :
            ($money > 50 ? "Денег хватает, остаток ". ($money - 50) : "Не хватает денег, не хватает ". (50 - $money));
    if (isset($_POST['submit7'])) {
        $money = (float)$_POST['money'];
        echo "Результат проверки: <b>", $checkMoney($money), "</b><br>";
    }
    ?>
</body>
</html>
