<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 3</h1>
        <?php
        echo '<table border="1">';
        for ($i = 1; $i <= 10; $i++) {
            echo '<tr>';
            for ($j = 1; $j <= 10; $j++) {
                $n = $i * $j;
                echo "<td style='width: 20px; height: px;'>",$n,"</td>";
            }
            echo '</tr>';
        }
        echo '</table>';
        ?>
        <h1>Задание 4</h1>
        <?php
        echo '<table border="1">';
        $total = 90;
        $columns = 45;
        for ($i = 0; $i < 2; $i++) {
            echo '<tr>';
            for ($j = 0; $j < $columns; $j++) {
                $n = 10 + $i * $columns + $j;
                if ($n > 99) {
                    break;
                }
                $sq = $n * $n;
                echo "<td style='width: 5px; height: 5px;'>",$n,"<br>",$sq,"</td>";
            }
            echo '</tr>';
        }
        echo '</table>';
        ?>
        <h1>Задание 5</h1>
        <form action="" method="post">
    <label>a <input type="number" name="a" required></label><br><br>
    <label>b <input type="number" name="b" required></label><br><br>
    <input type="submit" name="sub" value="Построить">
        </form>
        <?php
        if (isset($_POST['sub'])) {
            $a = (int)($_POST['a']);
            $b = (int)($_POST['b']);
            if ($a < 1 || $b < 1) {
            } else {
                $c = '*';
                $f = '/';
                echo "<pre>";
                for ($i = 1; $i <= $b; $i++) {
                    for ($j = 1; $j <= $a; $j++) {
                        if ($i == 1 || $i == $b || $j == 1 || $j == $a) {
                            echo $c;
                        } else {
                            echo $f;
                        }
                    }
                    echo "\n";
                }
                echo "</pre>";
            }
        }
        ?>
        <h1>Задание 6</h1>
        <form method="post">
            <label>Число n: <input type="number" name="n"></label>
            <input type="submit" name="sub1" value="Вычислить">
        </form>
        <?php
        if (isset($_POST['sub1'])) {
            $n = (int)$_POST['n'];
            echo "Делители числа $n: ";
            for ($i = 1; $i <= $n; $i++) {
                if ($n % $i === 0) {
                    echo $i, " ";
                }
            }
        }
        ?>
        <h1>Задание 7</h1>
        <form method="post">
            <label>Число n: <input type="number" name="n1"></label>
            <input type="submit" name="sub2" value="Посчитать">
        </form>
        <?php
        if (isset($_POST['sub2'])) {
            $n = (int)$_POST['n1'];
            if ($n === 0) {
                $product = 0;
            } else {
                $product = 1;
                $temp = $n;
                while ($temp > 0) {
                    $digit = $temp % 10;
                    $product *= $digit;
                    $temp = intdiv($temp, 10);
                }
            }
            echo "Произведение цифр числа $n = $product";
        }
        ?>
    </body>
</html>