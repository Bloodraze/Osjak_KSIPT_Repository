<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <?php
        $numbers = [3.5, 2.1, 0, 4.7, 1.8];
        $zeroIndex = array_search(0, $numbers);
        $result = array_slice($numbers, 0, $zeroIndex + 1);
        echo "Числа до нуля включительно: ", implode(', ', $result);
        ?>
        <h1>Задание 2</h1>
        <?php
        $numbers = [5, 2, 8, 1, 9, 3];
        $minIndex = array_search(min($numbers), $numbers);
        $maxIndex = array_search(max($numbers), $numbers);

        [$numbers[$minIndex], $numbers[$maxIndex]] = [$numbers[$maxIndex], $numbers[$minIndex]];
        echo "Массив после замены: ", implode(', ', $numbers);
        ?>
        <h1>Задание 3</h1>
        <?php
        $numbers = [1, 0, 5, 0, 3, 0, 8];
        $zeroIndexes = array_keys(array_filter($numbers, function($value) {
            return $value === 0;
        }));
        echo "Номера нулевых элементов: ", implode(', ', $zeroIndexes);
        ?>
        <h1>Задание 4</h1>
        <?php
        $numbers = [1, 0, 5, 0, 3, 0, 8];
        $filteredArray = array_filter($numbers, function($value) {
            return $value !== 0;
        });
        echo "Массив после удаления нулей: ", implode(', ', $filteredArray);
        ?>
        <h1>Задание 5</h1>
        <?php
        $reindexedArray = array_values($filteredArray);
        echo "Переиндексированный массив: ", implode(', ', $reindexedArray);
        ?>
        <h1>Задание 6</h1>
        <?php
        $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $oddCount = count(array_filter($numbers, function($value) {
            return $value % 2 !== 0;
        }));
        $percentage = ($oddCount / count($numbers)) * 100;
        echo "Нечетные числа составляют: ", round($percentage, 2), "%";
        ?>
        <h1>Задание 7</h1>
        <?php
        function isPrime($n) {
            if ($n < 2) return false;
            for ($i = 2; $i * $i <= $n; $i++) {
                if ($n % $i === 0) return false;
            }
            return true;
        }
        $numbers = [1.5, 2.3, 3.7, 4.1, 5.9, 6.2, 7.8, 8.4, 9.6, 10.1];
        $sum = array_reduce(array_keys($numbers), function($carry, $index) use ($numbers) {
            return isPrime($index) ? $carry + $numbers[$index] : $carry;
        }, 0);
        echo "Сумма чисел с простыми индексами: ", $sum;
        ?>
    </body>
</html>