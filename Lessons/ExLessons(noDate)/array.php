<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <?php
        $num = [1, 2, 5, 15, 8];
        $max = $num[0];
        $min = $num[0];
        $maxIndex = 0;
        $minIndex = 0;
        foreach ($num as $index => $n) {
            if ($n > $max) {
                $max = $n;
                $maxIndex = $index;
            }
            if ($n < $min) {
                $min = $n;
                $minIndex = $index;
            }
        }
        echo "Максимум: $max (Индекс: $maxIndex)", '<br>';
        echo "Минимум: $min (Индекс: $minIndex)";
        ?>
        <h1>Задание 2</h1>
        <?php
        $n = [1, 2, 3, 4, 5];
        $sum = 0;
        foreach ($n as $num) {
            $sum += $num;
        }
        $product = 1;
        foreach ($n as $num) {
            $product *= $num;
        }
        echo '<b>',"Сумма: ", $sum,'</b>', '<br>';
        echo '<b>',"Произведение элементов: ",'</b>', $product, '<br>';
        ?>
        <h1>Задание 3</h1>
        <?php
        $n = [1, 2, 3, 4, 5];
        $sum = 0;
        $len = 0;
        foreach ($n as $num) {
            $sum += $num;
            $len++;
        }
        if ($len > 0) {
            $average = $sum / $len;
            echo '<b>',"Среднее арифметическое: ",'</b>', $average, '<br>';
        }
        ?>
        <h1>Задание 4</h1>
        <?php
        $og = [3.5, -2.1, 0, 4.0, -7.7, 1.2];
        $trans = [];
        foreach ($og as $n) {
            if ($n > 0) {
                $trans[] = $n * $n;
            } elseif ($n < 0) {
                $trans[] = -$n;
            } else {
                $trans[] = $n;
            }
        }
        echo '<b>Исходный массив: </b>';
        $lastIndex = count($og) - 1;
        foreach ($og as $index => $value) {
            echo $value;
            if ($index !== $lastIndex) {
                echo ', ';
            }
        }
        echo '<br><b>Преобразованный массив: </b>';
        $lastIndexTrans = count($trans) - 1;
        foreach ($trans as $index => $value) {
            echo $value;
            if ($index !== $lastIndexTrans) {
                echo ', ';
            }
        }
        ?>
        <h1>Задание 5</h1>
        <?php
        $n= [10, 15, 20, 25, 30, 35];
        $i = 0;
        foreach ($n as $value) {
            if ($i % 2 == 0) {
                echo '<b>',"Элемент с индексом $i: ",'</b>', $value, '<br>';
            }
            $i++;
        }
        ?>
        <h1>Задание 6</h1>
        <?php
        $n = [3, 5, 2, 7, 6, 8, 8, 10];
        for ($i = 1; ; $i++) {
            if (!isset($n[$i])) {
                break; 
            }
            if ($n[$i] > $n[$i - 1]) {
                echo '<b>',"Элемент с индексом $i: ",'</b>', $n[$i], '<br>';
            }
        }
        ?>
        <h1>Задание 7</h1>
        <?php
        $n = [1, 2, 3, 4, 5, 6, 7];
        $len = 0;
        foreach ($n as $value) {
            $len++;
        }
        for ($i = 0; $i < $len - 1; $i += 2) {
            $temp = $n[$i];
            $n[$i] = $n[$i + 1];
            $n[$i + 1] = $temp;
        }
        $lastIndex = count($n) - 1;
        foreach ($n as $index => $value) {
            echo $value;
            if ($index !== $lastIndex) {
                echo ', ';
            }
        }
        ?>
        <h1>Задание 8</h1>
        <?php
        $n = [1, 2, 3, 4, 5];
        $len = 0;
        foreach ($n as $item) {
            $len++;
        }
        $last = $n[$len - 1];
        for ($i = $len - 1; $i > 0; $i--) {
            $n[$i] = $n[$i - 1];
        }
        $n[0] = $last;
        for ($i = 0; $i < $len; $i++) {
            echo $n[$i];
            if ($i != $len - 1) {
                echo ', ';
            }
        }
        ?>
        <h1>Задание 9</h1>
        <?php
        $n = [1, 2, 3, 2, 1, 2, 1];
        $countElements = [];
        foreach ($n as $value) {
            if (isset($countElements[$value])) {
                $countElements[$value]++;
            } else {
                $countElements[$value] = 1;
            }
        }
        $pairsCount = 0;
        foreach ($countElements as $count) {
            if ($count > 1) {
                $pairsCount += ($count * ($count - 1)) / 2;
            }
        }
        echo '<b>',"Количество пар: ",'</b>', $pairsCount;
        ?>
    </body>
</html>