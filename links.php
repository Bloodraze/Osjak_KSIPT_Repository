<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <?php
        echo 'array_walk(&$array, callback) — первый аргумент передаётся по ссылке: позволяет изменить элементы массива внутри функции-обработчика.', '<br>';
        echo 'array_walk_recursive(&$array, callback) — то же, но рекурсивно для вложенных массивов.', '<br>';
        echo 'array_pop(&$array) — изменяет исходный массив, возвращая последний элемент.', '<br>';
        echo 'array_push(&$array, ...) — добавляет элементы в конец исходного массива.', '<br>';
        echo 'array_shift(&$array) — извлекает первый элемент, изменяя исходный массив.', '<br>';
        echo 'array_splice(&$array, ...) — удаляет/заменяет часть элементов массива.', '<br>';
        echo 'array_unshift(&$array, ...) — добавляет элементы в начало массива.', '<br>';
        echo 'sort(&$array) — сортирует массив (по значению), изменяя его.', '<br>';
        echo 'rsort(&$array)', '<br>';
        echo 'asort(&$array)', '<br>';
        echo 'arsort(&$array)', '<br>';
        echo 'ksort(&$array)', '<br>';
        echo 'krsort(&$array)', '<br>';
        echo 'usort(&$array, ...)', '<br>';
        echo 'uasort(&$array, ...)', '<br>';
        echo 'uksort(&$array, ...)', '<br>';
        echo 'shuffle(&$array) — перемешивает элементы, изменяя исходный массив.', '<br>';
        echo 'array_multisort(&$array1, &$array2, ...)', '<br>';
        echo 'array_reverse($array, $preserve_keys = false) — возвращает новый массив, не изменяя оригинальный (по ссылке не принимает).', '<br>';
        echo 'extract($array) — извлекает переменные из массива в текущую область видимости (не принимает аргумент по ссылке).', '<br>';
        ?>
        <h1>Задание 2</h1>
        <?php
        function cubic(&$n) {
            $n = $n ** 3;
        }
        $x = 2;
        echo "До вызова функции: x = $x<br>";
        cubic($x);
        echo "После вызова функции: x = $x<br>";
        ?>
        <h1>Задание 3</h1>
        <?php
        function remove_commas(&$str) {
            $str = str_replace(',', '', $str);
        }
        $s = "Привет, как дела, друг?";
        echo "До вызова функции: s = '$s'<br>";
        remove_commas($s);
        echo "После вызова функции: s = '$s'<br>";
        ?>
        <h1>Задание 4</h1>
        <?php
        function reverse_words(&$str) {
            $words = explode(' ', $str);
            $reversed_words = [];
            foreach ($words as $word) {
                $reversed_words[] = iconv('utf-8', 'utf-8//IGNORE', strrev(iconv('utf-8', 'utf-8//IGNORE', $word)));
            }
            $str = implode(' ', $reversed_words);
        }
        $s = "Привет как дела";
        echo "До вызова функции: s = '$s'<br>";
        reverse_words($s);
        echo "После вызова функции: s = '$s'<br>";
        ?>
        <h1>Задание 5</h1>
        <?php
        function abs_array(&$arr) {
            foreach ($arr as &$v)
                $v = abs($v);
        }
        $a = [21, 3, 0, 5, -32];
        echo "До вызова функции: [" . implode(', ', $a) . "]<br>";
        abs_array($a);
        echo "После вызова функции: [" . implode(', ', $a) . "]<br>";
        ?>
        <h1>Задание 6</h1>
        <?php
        function rekey_by_value(&$arr) {
            $new = [];
            foreach ($arr as $v) {
                $new[(string)$v] = $v;
            }
            $arr = $new;
        }
        $a = [21, 3, 0, 5, -32];
        echo "До вызова функции: [" . implode(', ', $a) . "]<br>";
        rekey_by_value($a);
        echo "После вызова функции: ";
        $output = [];
        foreach ($a as $key => $value) {
            $output[] = "'$key' => $value";
        }
        echo "[" . implode(', ', $output) . "]<br>";
        ?>
    </body>
</html>