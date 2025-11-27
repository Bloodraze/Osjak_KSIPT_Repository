<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>Задание 1</h1>
        <?php
        if (isset($_POST['fio_submit'])) {
            $fam = htmlspecialchars($_POST['familiya']);
            $im = htmlspecialchars($_POST['imya']);
            $ot = htmlspecialchars($_POST['otchestvo']);
            echo "<p>Фамилия: $fam</p>";
            echo "<p>Имя: $im</p>";
            echo "<p>Отчество: $ot</p>";
        }
        ?>
        <form method="POST">
            <p>Фамилия: <input type="text" name="familiya" required></p>
            <p>Имя: <input type="text" name="imya" required></p>
            <p>Отчество: <input type="text" name="otchestvo"></p>
            <button type="submit" name="fio_submit">Отправить</button>
        </form>
        <h1>Задание 2</h1>
        <?php
        if (isset($_POST['div_submit'])) {
            $n = (int)$_POST['number'];
            $divisors = [];
            for ($i = 1; $i <= $n; $i++) {
                if ($n % $i == 0) $divisors[] = $i;
            }
            echo "<p>Делители числа $n: " . implode(', ', $divisors) . "</p>";
        }
        ?>
        <form method="POST">
            <p>Число: <input type="number" name="number" required></p>
            <button type="submit" name="div_submit">Найти делители</button>
        </form>
        <h1>Задание 3</h1>
        <?php
        if (isset($_POST['triangle_submit'])) {
            $a = (float)$_POST['a'];
            $b = (float)$_POST['b'];
            $c = (float)$_POST['c'];
            
            if ($a + $b <= $c || $a + $c <= $b || $b + $c <= $a) {
                echo "<p style='color:red'>Треугольник не существует</p>";
            } else {
                $p = ($a + $b + $c) / 2;
                $s = sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
                echo "<p>Площадь треугольника: " . round($s, 2) . "</p>";
            }
        }
        ?>
        <form method="POST">
            <p>a: <input type="number" step="0.01" name="a" required></p>
            <p>b: <input type="number" step="0.01" name="b" required></p>
            <p>c: <input type="number" step="0.01" name="c" required></p>
            <button type="submit" name="triangle_submit">Вычислить площадь</button>
        </form>
        <h1>Задание 4</h1>
        <?php
        if (isset($_POST['quad_submit'])) {
            $a = (float)$_POST['a'];
            $b = (float)$_POST['b'];
            $c = (float)$_POST['c'];
            
            if ($a == 0) {
                echo "<p style='color:red'>a не должно быть равно 0</p>";
            } else {
                $d = $b*$b - 4*$a*$c;
                if ($d > 0) {
                    $x1 = (-$b + sqrt($d)) / (2*$a);
                    $x2 = (-$b - sqrt($d)) / (2*$a);
                    echo "<p>x₁ = " . round($x1, 3) . "</p>";
                    echo "<p>x₂ = " . round($x2, 3) . "</p>";
                } elseif ($d == 0) {
                    $x = -$b / (2*$a);
                    echo "<p>x = " . round($x, 3) . "</p>";
                } else {
                    echo "<p>Действительных корней нет</p>";
                }
            }
        }
        ?>
        <form method="POST">
            <p>a: <input type="number" step="0.01" name="a" required></p>
            <p>b: <input type="number" step="0.01" name="b" required></p>
            <p>c: <input type="number" step="0.01" name="c" required></p>
            <button type="submit" name="quad_submit">Найти корни</button>
        </form>
        <h1>Задание 5</h1>
        <?php
        if (isset($_POST['pyth_submit'])) {
            $a = (int)$_POST['a'];
            $b = (int)$_POST['b'];
            $c = (int)$_POST['c'];
            
            $sides = [$a, $b, $c];
            sort($sides);
            $max = $sides[2];
            
            if ($max*$max == $sides[0]*$sides[0] + $sides[1]*$sides[1]) {
                echo "<p style='color:green'>Это тройка Пифагора: {$sides[0]}, {$sides[1]}, $max</p>";
            } else {
                echo "<p style='color:red'>Не тройка Пифагора</p>";
            }
        }
        ?>
        <form method="POST">
            <p>a: <input type="number" name="a" required></p>
            <p>b: <input type="number" name="b" required></p>
            <p>c: <input type="number" name="c" required></p>
            <button type="submit" name="pyth_submit">Проверить</button>
        </form>
        <h1>Задание 6</h1>
        <?php
        if (isset($_POST['birthday_submit'])) {
            $birthday = DateTime::createFromFormat('d.m.Y', $_POST['birthday']);
            $today = new DateTime();
            $next_birthday = clone $birthday;
            
            if ($today > $next_birthday) {
                $next_birthday->modify('+1 year');
            }
            
            $interval = $today->diff($next_birthday);
            $days = $interval->days;
            echo "<p>До дня рождения осталось $days дней</p>";
        }
        ?>
        <form method="POST">
            <p>Дата рождения (дд.мм.гггг): <input type="text" name="birthday" pattern="\d{2}\.\d{2}\.\d{4}" placeholder="01.12.1990" required></p>
            <button type="submit" name="birthday_submit">Посчитать</button>
        </form>
    </body>
</html>
