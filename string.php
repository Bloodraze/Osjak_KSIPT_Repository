<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <form action="">
            <label>Введите текст: <input type="text" name="task1"></label>
            <input type="submit">
        </form>
        <?php
        if(isset($_GET["task1"]) && !empty($_GET["task1"])) {
            $str = $_GET["task1"];
            $start = strpos($str, '(');
            $end = strpos($str, ')');
            if($start !== false && $end !== false && $start < $end) {
                $result = substr($str, $start + 1, $end - $start - 1);
                echo $result;
            } else {
                echo "В тексте не найдены скобки () или они расположены некорректно";
            }
        } else {
            echo "Пожалуйста, введите текст";
        }
        ?>
        <h1>Задание 2</h1>
        <form action="">
            <label>Введите текст: <input type="text" name="task2"></label>
            <input type="submit">
        </form>
        <?php
        if(isset($_GET["task2"]) && !empty(trim($_GET["task2"]))) {
            $str = $_GET["task2"];
            $words = explode(' ', rtrim($str, '.'));
            echo "Количество слов: ", count($words);
        } else {
            echo "Пожалуйста, введите текст";
        }
        ?>
        <h1>Задание 3</h1>
        <form action="">
            <label>Введите текст: <input type="text" name="task3"></label>
            <input type="submit">
        </form>
        <?php
        if(isset($_GET["task3"]) && !empty(trim($_GET["task3"]))) {
            $str = $_GET["task3"];
            $words = explode(' ', $str);
            $result_words = [];
            foreach ($words as $word) {
                if ($word !== "") {
                    $length = mb_strlen($word);
                    $firstChar = mb_substr($word, 0, 1);
                    $lastChar = mb_substr($word, $length - 1, 1);
                    if ($firstChar === $lastChar) {
                        $result_words[] = $word;
                    }
                }
            }
            if (!empty($result_words)) {
                echo implode(', ', $result_words);
            } else {
                echo "Слов, начинающихся и заканчивающихся на одну букву, не найдено";
            }
        } else {
            echo "Пожалуйста, введите текст";
        }
        ?>
        <h1>Задание 4</h1>
        <form action="">
            <label>Введите слово: <input type="text" name="task4"></label>
            <input type="submit">
        </form>
        <?php
        if(isset($_GET["task4"]) && !empty(trim($_GET["task4"]))) {
            $str = $_GET["task4"];
            $unique_chars = "";
            $count = 0;
            for ($i = 0; $i < mb_strlen($str); $i++) {
                $char = mb_substr($str, $i, 1);
                if (mb_strpos($unique_chars, $char) === false) {
                    $unique_chars .= $char;
                    $count++;
                }
            }
            echo "Различных символов: $count", '<br>';
            echo "Символы: $unique_chars";
        } else {
            echo "Пожалуйста, введите слово";
        }
        ?>
        <h1>Задание 5</h1>
        <form action="">
            <label>Введите слово: <input type="text" name="task5"></label>
            <input type="submit">
        </form>
        <?php
        if(isset($_GET["task5"]) && !empty(trim($_GET["task5"]))) {
            $str = $_GET["task5"];
            $count_r = substr_count($str, 'р');
            $count_k = substr_count($str, 'к');
            $count_t = substr_count($str, 'т');
            echo "р: $count_r, к: $count_k, т: $count_t";
        } else {
            echo "Пожалуйста, введите слово";
        }
        ?>
        <h1>Задание 6</h1>
        <form action="">
            <label>Введите текст: <input type="text" name="task6"></label>
            <input type="submit">
        </form>
        <?php
        if(isset($_GET["task6"]) && !empty(trim($_GET["task6"]))) {
            $text = $_GET["task6"];
            $words = explode(' ', $text);
            $min_length = null;
            $max_length = 0;
            foreach ($words as $word) {
                if (!empty(trim($word))) { // Пропускаем пустые слова
                    $length = strlen($word);
                    if ($min_length === null || $length < $min_length) {
                        $min_length = $length;
                    }
                    if ($length > $max_length) {
                        $max_length = $length;
                    }
                }
            }
            if ($min_length !== null) {
                echo "Самое короткое слово: $min_length символов", '<br>';
                echo "Самое длинное слово: $max_length символов";
            } else {
                echo "В тексте нет слов для анализа";
            }
        } else {
            echo "Пожалуйста, введите текст";
        }
        ?>
        <h1>Задание 7</h1>
        <?php
        $str = "баааааанааан";
        $max_sequence = 0;
        $current_sequence = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] === 'а') {
                $current_sequence++;
                if ($current_sequence > $max_sequence) {
                    $max_sequence = $current_sequence;
                }
            } else {
                $current_sequence = 0;
            }
        }
        echo "Самая длинная последовательность букв 'а': $max_sequence";
        ?>
        <h1>Задание 8</h1>
        <?php
        $str = "Текст до (удаляемая часть) текст после";
        $start = strpos($str, '(');
        $end = strpos($str, ')');
        $result = substr($str, 0, $start) . substr($str, $end + 1);
        echo $result;
        ?>
        <h1>Задание 9</h1>
        <?php
        function canFormWord($letters, $word) {
            $letters_str = implode('', $letters);
            for ($i = 0; $i < strlen($word); $i++) {
                $char = $word[$i];
                $pos = strpos($letters_str, $char);
                if ($pos === false) {
                    return false;
                }
                $letters_str = substr($letters_str, 0, $pos). substr($letters_str, $pos + 1);
            }
            return true;
        }
        $letters = ['п', 'р', 'о', 'г', 'р', 'а', 'м', 'м', 'а'];
        $word = "программа";
        if (canFormWord($letters, $word)) {
            echo "Слово '$word' можно составить из данных букв";
        } else {
            echo "Слово '$word' нельзя составить из данных букв";
        }
        ?>
    </body>
</html>