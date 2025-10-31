<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1</h1>
        <?php
        $array = [];
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $array[$i][$j] = rand(1, 100);
            }
        }
        echo "<table border='1'>";
        for ($i = 0; $i < 3; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 4; $j++) {
                echo "<td>" . $array[$i][$j], "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <h1>Задание 2</h1>
        <?php
        $start = 10;
        $end = 99;
        $sizeColumns = 10;

        $squares = [];
        $currentRow = [];
        for ($i = $start; $i <= $end; $i++) {
            $currentRow[] = $i * $i;
            if (isset($currentRow[$sizeColumns - 1])) {
                $squares[] = $currentRow;
                $currentRow = [];
            }
        }
        $hasElements = false;
        foreach ($currentRow as $value) {
            $hasElements = true;
            break;
        }
        if ($hasElements) {
            $squares[] = $currentRow;
        }
        echo "<table border='1'>";
        foreach ($squares as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <h1>Задание 3</h1>
        <?php
        $array = [];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $array[$i][$j] = rand(1, 100);
            }
        }
        $max = $array[0][0];
        $min = $array[0][0];
        $maxIndex = [0, 0];
        $minIndex = [0, 0];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 4; $j++) {
                if ($array[$i][$j] > $max) {
                    $max = $array[$i][$j];
                    $maxIndex = [$i, $j];
                }
                if ($array[$i][$j] < $min) {
                    $min = $array[$i][$j];
                    $minIndex = [$i, $j];
                }
            }
        }
        echo "<b>Массив</b>:", '<br>';
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 4; $j++) {
                echo $array[$i][$j]," ";
            }
            echo '<br>';
        }
        echo "<b>Максимальный элемент</b>: $max (Индекс [строка: {$maxIndex[0]}, столбец: {$maxIndex[1]}])", '<br>';
        echo "<b>Минимальный элемент</b>: $min (Индекс [строка: {$minIndex[0]}, столбец: {$minIndex[1]}])";
        ?>
        <h1>Задание 4</h1>
        <form action="">
            <label>Введите n: <input type="text", name="task4">
            <input type="submit" value="Создать"><br>
        </form>
        <?php
        if(isset($_GET['task4'])){
            $n=$_GET['task4'];
        }
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i >= $j) {
                    echo $i - $j;
                } else {
                    echo $j - $i;
                }
                if ($j != $n - 1) {
                    echo " ";
                }
            }
            echo '<br>';
        }
        ?>
        <h1>Задание 5</h1>
        <?php
        $categories = [
            0 => [
                "Nike" => "Кроссовки Air Max",
                "Adidas" => "Футбольный мяч",
                "Puma" => "Беговая дорожка"
            ],
            1 => [
                "Wilson" => "Теннисная ракетка",
                "Yonex" => "Бадминтонная ракетка"
            ],
            2 => [],
            3 => [
                "Asics" => "Кроссовки Gel",
                "Reebok" => "Шорты для бега",
                "Under Armour" => "Майка спортивная"
            ]
        ];
        foreach ($categories as $categoryIndex => $products) {
            echo "<b>Категория</b> $categoryIndex:", '<br>';
            $hasProducts = false;

            if (isset($categories[$categoryIndex])) {
                foreach ($products as $firm => $productName) {
                    $hasProducts = true;
                    echo "$productName (Фирма: $firm)", '<br>';
                }
            }
            if (!$hasProducts) {
                echo 'Здесь пока нет товаров.', '<br>';
            }
            echo '<br>';
        }
        ?>
        <h1>Задание 6</h1>
        <?php
            $categories = [
                0 => [
                    "Nike" => "Кроссовки Air Max",
                    "Adidas" => "Футбольный мяч",
                    "Puma" => "Беговая дорожка"
                ],
                1 => [
                    "Wilson" => "Теннисная ракетка",
                    "Yonex" => "Бадминтонная ракетка"
                ],
                2 => [],
                3 => [
                    "Asics" => "Кроссовки Gel",
                    "Reebok" => "Шорты для бега",
                    "Under Armour" => "Майка спортивная"
                ]
            ];
            $categories[] = [
                "Decathlon" => "Хоккейные клюшки",
                "Salomon" => "Горнолыжные ботинки"
            ];
            foreach ($categories as $categoryIndex => $products) {
                echo "<b>Категория</b> $categoryIndex:", '<br>';
                $hasProducts = false;
                if (isset($categories[$categoryIndex])) {
                    foreach ($products as $firm => $productName) {
                        $hasProducts = true;
                        echo "$productName (Фирма: $firm)", '<br>';
                    }
                }
                if (!$hasProducts) {
                    echo 'Здесь пока нет товаров.', '<br>';
                }
                echo '<br>';
            }
        ?>
        <h1>Задание 7</h1>
        <?php
            $categories = [
                0 => [
                    "Nike" => "Кроссовки Air Max",
                    "Adidas" => "Футбольный мяч",
                    "Puma" => "Беговая дорожка"
                ],
                1 => [
                    "Wilson" => "Теннисная ракетка",
                    "Yonex" => "Бадминтонная ракетка"
                ],
                2 => [],
                3 => [
                    "Asics" => "Кроссовки Gel",
                    "Reebok" => "Шорты для бега",
                    "Under Armour" => "Майка спортивная"
                ]
            ];
            $categories[] = [];
            $newProducts = [
                "Хоккейные клюшки",
                "Горнолыжные ботинки",
                "Сноуборд",
            ];
            foreach ($newProducts as $product) {
                $categories[4]["Decathlon"] = isset($categories[4]["Decathlon"])
                    ? $categories[4]["Decathlon"] . ", $product"
                    : $product;
            }
            foreach ($categories as $categoryIndex => $products) {
                echo "<b>Категория</b> $categoryIndex:", '<br>';
                $hasProducts = false;
                if (isset($categories[$categoryIndex])) {
                    foreach ($products as $firm => $productName) {
                        $hasProducts = true;
                        echo "$productName (Фирма: $firm)", '<br>';
                    }
                }
                if (!$hasProducts) {
                    echo 'Здесь пока нет товаров.', '<br>';
                }
                echo '<br>';
            }
        ?>
        <h1>Задание 8</h1>
        <?php
            $categories = [
                "Обувь" => [
                    "Nike" => "Кроссовки Air Max",
                    "Adidas" => "Футбольный мяч",
                    "Puma" => "Беговая дорожка"
                ],
                "Ракетки" => [
                    "Wilson" => "Теннисная ракетка",
                    "Yonex" => "Бадминтонная ракетка"
                ],
                "Пустая категория" => [],
                "Спорт одежда" => [
                    "Asics" => "Кроссовки Gel",
                    "Reebok" => "Шорты для бега",
                    "Under Armour" => "Майка спортивная"
                ]
            ];
            $newCategoryName = "Спорттовары";
            $newProducts = [
                "Decathlon" => "Хоккейные клюшки",
                "Salomon" => "Горнолыжные ботинки",
                "Burton" => "Сноуборд",
            ];
            if (!isset($categories[$newCategoryName])) {
                $categories[$newCategoryName] = [];
            }
            foreach ($newProducts as $firm => $product) {
                $categories[$newCategoryName][$firm] = $product;
            }
            foreach ($categories as $categoryName => $products) {
                echo "<b>Категория</b>: $categoryName", '<br>';
                if (count($products) === 0) {
                    echo "Здесь пока нет товаров.", '<br>';
                } else {
                    foreach ($products as $firm => $productName) {
                        echo "$productName (Фирма: $firm)", '<br>';
                    }
                }
                echo '<br>';
            }
        ?>
    </body>
</html>