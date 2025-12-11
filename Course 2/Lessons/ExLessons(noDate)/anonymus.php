<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <?php
        $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $is_even = fn($n) => $n % 2 === 0;
        $even_numbers = array_filter($numbers, $is_even);
        if (!empty($even_numbers)) {
            echo "Массив четных чисел: \n";
            print_r(array_values($even_numbers));
        } else {
            echo "В последовательности нет четных чисел.", '<br>';
        }
        ?>
        <h1>Задание 2</h1>
        <?php
        $integers = [-2, 1, 0, 3, 5];
        $cube = fn($n) => $n * $n * $n;
        $cubed_numbers = array_map($cube, $integers);
        echo "Массив кубов чисел:", '<br>';
        print_r($cubed_numbers);
        ?>
        <h1>Задание 3</h1>
        <?php
        $data = [2, 4, 8, 10];
        $count = count($data);
        if ($count === 0) {
            echo "Массив пуст, невозможно вычислить средние.", '<br>';
        } else {
            $sum = array_reduce($data, fn($carry, $item) => $carry + $item, 0);
            $arithmetic_mean = $sum / $count;
            $product = array_reduce($data, fn($carry, $item) => $carry * $item, 1);
            if (in_array(0, $data, true)) {
                $geometric_mean_str = "0 (т.к. в массиве есть 0)";
            } elseif ($product < 0 && $count % 2 === 0) {
                $geometric_mean_str = "Не определено (произведение отрицательное, количество элементов четное)";
            } elseif ($product < 0 && $count % 2 !== 0) {
                $geometric_mean = -pow(abs($product), 1 / $count);
                $geometric_mean_str = $geometric_mean;
            } else {
                $geometric_mean = pow($product, 1 / $count);
                $geometric_mean_str = $geometric_mean;
            }
            echo "Массив чисел: ", implode(', ', $data), '<br>';
            echo "Среднее арифметическое: $arithmetic_mean", '<br>';
            echo "Среднее геометрическое: $geometric_mean_str", '<br>';
        }
        ?>
        <h1>Задание 4</h1>
        <?php
        $students = [
            [ 'name' => 'Вася', 'birth' => 2005, 'height'=> 175 ],
            [ 'name' => 'Петя', 'birth' => 2004, 'height'=> 168 ],
            [ 'name' => 'Маша', 'birth' => 2006, 'height'=> 171 ],
            [ 'name' => 'Оля', 'birth' => 2003, 'height'=> 165 ],
            [ 'name' => 'Дима', 'birth' => 2005, 'height'=> 180 ],
            [ 'name' => 'Аня', 'birth' => 2007, 'height'=> 170 ],
        ];
        $tall_students_data = array_filter(
            $students,
            fn($student) => $student['height'] > 170
        );
        $count_tall_students = count($tall_students_data);
        $tall_students_names = array_map(
            fn($student) => $student['name'],
            $tall_students_data
        );
        echo "Число студентов выше 170 см: **$count_tall_students**", '<br>';
        if ($count_tall_students > 0) {
            echo "Список их имен: **", implode(', ', $tall_students_names),"**<br>";
        } else {
            echo "Студентов выше 170 см не найдено.", '<br>';
        }
        ?>
        <h1>Задание 5</h1>
        <?php
        $numbers = [-2.5, 0, 3.7, -1.2, 0, 8.9, -4];
        $negativeCount = count(array_filter($numbers, fn($n) => $n < 0));
        $zeroCount = count(array_filter($numbers, fn($n) => $n == 0));
        $positiveCount = count(array_filter($numbers, fn($n) => $n > 0));
        echo "Отрицательных: $negativeCount", '<br>';
        echo "Нулевых: $zeroCount", '<br>';
        echo "Положительных: $positiveCount", '<br>';
        ?>
        <h1>Задание 6</h1>
        <?php
        $numbers = [1.5, 3.0, 2.0, 2.0, 4.5, 2.0, 3.5];
        $K = 2.0;
        $lessCount = count(array_filter($numbers, fn($n) => $n < $K));
        $equalCount = count(array_filter($numbers, fn($n) => $n == $K));
        $greaterCount = count(array_filter($numbers, fn($n) => $n > $K));
        echo "Меньше $K: $lessCount", '<br>';
        echo "Равно $K: $equalCount", '<br>';
        echo "Больше $K: $greaterCount", '<br>';
        ?>
        <h1>Задание 7</h1>
        <?php
        $numbers = [10, 15, 20, 25, 30, 35, 40, 45, 50];
        $M = 10;
        $L = 20;
        $N = 45;
        $count = count(array_filter($numbers, fn($num) => 
            $num % $M == 0 && $num >= $L && $num <= $N
        ));
        echo "Количество чисел, кратных $M в промежутке [$L, $N]: $count", '<br>';
        ?>
        <h1>Задание 8</h1>
        <?php
        $numbers = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
        $filtered = array_filter($numbers, fn($value, $key) => 
            $key > 0 && ($key & ($key - 1)) == 0, ARRAY_FILTER_USE_BOTH
        );
        echo "Элементы с индексами-степенями двойки: ", implode(', ', $filtered);
        ?>
        <h1>Задание 9</h1>
        <?php
        function isPrime($n) {
            if ($n < 2) return false;
            if ($n == 2) return true;
            if ($n % 2 == 0) return false;
            for ($i = 3; $i * $i <= $n; $i += 2) {
                if ($n % $i == 0) return false;
            }
            return true;
        }
        $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
        $primeCount = count(array_filter($numbers, 'isPrime'));
        echo "Количество простых чисел: $primeCount", '<br>';
        ?>
    </body>
</html>