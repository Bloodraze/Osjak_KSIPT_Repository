<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1/6</h1>
        <?php
        $days = [
            "one" => "1",
            "two" => "2",
            "three" => "3",
            "four" => "4",
            "five" => "5",
            "six" => "6",
            "seven" => "7",
            "eight" => "8",
            "nine" => "9",
            "ten" => "10"
        ];
        $days = array_flip($days);
        foreach ($days as $eng => $rus) {
            echo "<b>$eng</b> - $rus", '<br>';
        }
        ?>
        <h1>Задание 2-3/4</h1>
        <form action="">
            <label>Введите слово: <input type="text" name = "task2"></label><br>
            <input type="submit" name="subtask2" value="Найти"><br><br>
        </form>
        <?php
        $dictionary = [
            "monday" => "понедельник",
            "tuesday" => "вторник",
            "wednesday" => "среда",
            "thursday" => "четверг",
            "friday" => "пятница",
            "saturday" => "суббота",
            "sunday" => "воскресенье",
            "hello" => "привет",
            "thank you" => "спасибо",
            "goodbye" => "до свидания"
        ];

        if (isset($_GET['task2'])) {
            $input = trim(mb_strtolower($_GET['task2']));
            $translation = null;
            foreach ($dictionary as $english => $russian) {
                if (mb_strtolower($english) === $input) {
                    $translation = $russian;
                    echo "<b>$input</b> - $translation";
                    break;
                }
            }
            if ($translation === null) {
                foreach ($dictionary as $english => $russian) {
                    if (mb_strtolower($russian) === $input) {
                        $translation = $english;
                        echo "<b>$input</b> - $translation";
                        break;
                    }
                }
            }
            if ($translation === null) {
                echo "<b>$input</b> - В словаре нет такого слова";
            }
        }
        ?>
        <h1>Задание 5</h1>
        <form action="">
            <label>Введите слово: <input type="text" name="task4"></label>
            <input type="submit" value="Подсчитать">
        </form>
        <?php
        if(isset($_GET['task5'])){
            $word = $_GET['task5'];
        }
        $counts = [];
        $i = 0;
        while (isset($word[$i])) {
            $char = $word[$i];
            if (isset($counts[$char])) {
                $counts[$char]++;
            } else {
                $counts[$char] = 1;
            }
            $i++;
        }
        foreach ($counts as $char => $count) {
            echo "<b>'$char'</b> => <b>$count</b>", '<br>';
        }
        ?>
    </body>
</html>