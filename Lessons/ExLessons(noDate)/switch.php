<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <form action="">
            <label>Цифра(0-9): <input type="number" name="a"></label><br><br>
            <input type="submit" name="sub" value="Перевести"><br><br>
        </form>
        <?php
        if(isset($_GET['sub'])){
            $a = $_GET['a'];
            switch($a){
                case 0:
                    echo 'zero';
                    break;
                case 1:
                    echo 'one';
                    break;
                case 2:
                    echo 'two';
                    break;
                case 3:
                    echo 'three';
                    break;
                case 4:
                    echo 'four';
                    break;
                case 5:
                    echo 'five';
                    break;
                case 6:
                    echo 'six';
                    break;
                case 7:
                    echo 'seven';
                    break;
                case 8:
                    echo 'eight';
                    break;
                case 9:
                    echo 'nine';
                    break;
            }
        }
        ?>
        <h1>Задание 2</h1>
        <form action="">
            <label>Месяц(1-12): <input type="number" name="month"></label><br><br>
            <input type="submit" name="sub1" value="Перевести"><br><br>
        </form>
        <?php
        if(isset($_GET['sub1'])){
            $a = $_GET['month'];
            switch($a){
            case 1:
                echo '1 января - Новый год', '<br>';
                echo '7 января - Рождество';
                break;
            case 2:
                echo '27 февраля - День защитника отечества';
                break;
            case 3:
                echo '8 марта - Международынй женский день';
                break;
            case 4:
                echo '1 апреля - День дурака';
                break;
            case 5:
                echo '9 мая - День победы';
                break;
            case 6:
                echo '1 июня - День защиты детей';
                break;
            case 7:
                echo '28 июля - День крещения Руси';
                break;
            case 8:
                echo '22 августа - день флага России';
                break;
            case 9:
                echo '1 сентября - День знаний';
                break;
            case 10:
                echo '5 октября - День учителя';
                break;
            case 11:
                echo '4 ноября - День народного Единства';
                break;
            case 12:
                echo '12 декабря - День конституции РФ';
                break;
        }
        }
        ?>
        <h1>Задание 3</h1>
        <form action="">
            <label>Число: <input type="number" name="num"></label><br><br>
            <input type="submit" name="sub2" value="Вычислить"><br><br>
        </form>
        <?php
        if(isset($_GET['sub2'])){
            $a = $_GET['num'];
            $sq= $a*$a;
        $n=$sq%10;
        switch($n){
            case 0:
                echo "Последняя цифра квадрата: 0";
                break;
            case 1:
                echo "Последняя цифра квадрата: 1";
                break;
            case 2:
                echo "Последняя цифра квадрата: 2";
                break;
            case 3:
                echo "Последняя цифра квадрата: 3";
                break;
            case 4:
                echo "Последняя цифра квадрата: 4";
                break;
            case 5:
                echo "Последняя цифра квадрата: 5";
                break;
            case 6:
                echo "Последняя цифра квадрата: 6";
                break;
            case 7:
                echo "Последняя цифра квадрата: 7";
                break;
            case 8:
                echo "Последняя цифра квадрата: 8";
                break;
            case 9:
                echo "Последняя цифра квадрата: 9";
                break;
        }
        }
        ?>
        <h1>Задание 4</h1>
        <form action="">
            <label>Возраст: <input type="number" name="age"></label><br><br>
            <input type="submit" name="sub3" value="Вывести"><br><br>
        </form>
        <?php
        if(isset($_GET['sub3'])){
            $k = $_GET['age'];
            switch ($k) {
            case 11:
            case 12:
            case 13:
            case 14:
                $word = "лет";
                break;
            case 1:
            case 21:
            case 31:
            case 41:
            case 51:
            case 61:
            case 71:
            case 81:
            case 91:
                $word = "год";
                break;
            case 2:
            case 3:
            case 4:
            case 22:
            case 23:
            case 24:
            case 32:
            case 33:
            case 34:
            case 42:
            case 43:
            case 44:
            case 52:
            case 53:
            case 54:
            case 62:
            case 63:
            case 64:
            case 72:
            case 73:
            case 74:
            case 82:
            case 83:
            case 84:
            case 92:
            case 93:
            case 94:
                $word = "года";
                break;
            default:
                $word = "лет";
        }
        echo "Мне $k $word";
        }
        ?>
        <h1>Задание 5</h1>
        <form action="">
            <label><input type="radio" name="type" value="1"> кг</label>
            <label><input type="radio" name="type" value="2"> мг</label>
            <label><input type="radio" name="type" value="3"> гр</label>
            <label><input type="radio" name="type" value="4"> т</label>
            <label><input type="radio" name="type" value="5"> цт</label><br><br>
            <label>Масса: <input type="number" name="mass"></label><br><br>
            <input type="submit" name="sub4" value="Вывести"><br><br>
        </form>
        <?php
        if(isset($_GET['sub4'])){
            $a = $_GET['type'];
            $b = $_GET['mass'];
            switch ($a) {
            case 1: 
                $m = $b;
                break;
            case 2: 
                $m = $b/1000000; 
                break;
            case 3: 
                $m = $b/1000; 
                break;
            case 4: 
                $m = $b*1000; 
                break;
            case 5: 
                $m = $b*100; 
                break;
        }
        echo "Масса в кг: $m";
        }
        ?>
    </body>
</html>