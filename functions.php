<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <form action="">
            <label>Введите радиус: <input type="text" name="task1"></label><br>
            <input type="submit" value="Вычислить"><br><br>
        </form>
        <?php
        function calculateCircle($radius) {
            return 2 * 3.14 * $radius;
        }
        if(isset($_GET["task1"])){
            $radius = $_GET["task1"];
        }
        if (isset($radius) && $radius !== '') {
            $length = calculateCircle($radius);
            echo "Длина окружности с радиусом <b>$radius</b> равна <b>$length</b>";
        }
        ?>
        <h1>Задание 2</h1>
        <form action="">
            <label>Введите сторону a: <input type="text" name="ts2A"></label><br>
        <label>Введите сторону b: <input type="text" name="ts2B"></label><br>
        <label>Введите сторону c: <input type="text" name="ts2C"></label><br>
        <input type="submit" value="Вычислить"><br><br>
        </form>
        <?php
        function triangleArea($a, $b, $c) {
            if ($a <= 0 || $b <= 0 || $c <= 0) {
                return 0;
            }
            if (($a + $b <= $c) || ($a + $c <= $b) || ($b + $c <= $a)) {
                return 0;
            }
            $s = ($a + $b + $c) / 2;
            $area = sqrt($s * ($s - $a) * ($s - $b) * ($s - $c));
            return $area;
        }
        if(isset($_GET["ts2A"])){
            $a = $_GET["ts2A"];
        }
        if(isset($_GET["ts2B"])){
            $b = $_GET["ts2B"];
        }
        if(isset($_GET["ts2C"])){
            $c = $_GET["ts2C"];
        }
        if (isset($a) && isset($b) && isset($c)){
            echo '<b>', triangleArea($a, $b, $c), '</b>';
        }
        ?>
        <h1>Задание 3</h1>
        <form action="">
            <label>Введите число: <input type="text" name="task3"></label><br>
            <input type="submit" value="Вычислить"><br><br>
        </form>
        <?php
        function findBiggestDivider($num) {
            if ($num <= 1) {
                return "Нет";
            }
            for ($i = $num - 1; $i > 0; $i--) {
                if ($num % $i == 0) {
                    return $i;
                }
            }
            return 1;
        }
        if(isset($_GET["task3"]) && $_GET["task3"] != ""){
            $n = $_GET["task3"];
            $result = findBiggestDivider($n);
            echo "Наибольший делитель для ", $n,": ", '<b>',$result,'</b>';
        }
        ?>
        <h1>Задание 4</h1>
        <form action="">
            <label>Введите число: <input type="text" name="task4"></label><br>
            <input type="submit" value="Вычислить"><br><br>
        </form>
        <?php
        function findAllDividers($num) {
            $dividers = [];
            if ($num <= 0) {
                return [];
            }
            for ($i = 1; $i <= $num; $i++) {
                if ($num % $i == 0) {
                    $dividers[] = $i;
                }
            }
            return $dividers;
        }
        if(isset($_GET["task4"]) && $_GET["task4"] != ""){
            $x = $_GET["task4"];
            $result = findAllDividers($x);
            echo "Все делители для ", $x, ": ";
            foreach ($result as $divider) {
                echo '<b>', $divider,'</b>', ' ';
            }
        } else {}
        ?>
        <h1>Задание 5</h1>
        <?php
        function sumOfSquares($numbers) {
            $sum = 0;
            foreach ($numbers as $number) {
                $sum += $number * $number;
            }
            return $sum;
        }
        $numbers = [2, 4, 6, 8, 10];
        $result = sumOfSquares($numbers);
        echo "Сумма квадратов: ", '<b>', $result, '</b>';
        ?>
    </body>
</html>