<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>WATERDROP</title>
    </head>
    <body>
        <h1 align="center">WATERDROP - Самые Универсальные Фильтры Для Воды!</h1>
        <?php
        try {
            $filename = 'products.json';
            $jsonData = @file_get_contents($filename);
            if ($jsonData === false) {
                throw new Exception("<b>Откладка:</b> Файл с данными '$filename' не найден(( (ToT)");
            }
            $products = json_decode($jsonData, true);
            if ($products === null) {
                throw new Exception("<b>Откладка:</b> Файл с данными '$filename' повреждён((( (X-X)");
            }
            echo '<b>Отладка:</b> Всё в порядке!))) (^w^)<br>';
        } catch (Exception $ex) {
            echo "<p>" . $ex->getMessage() . "</p>";
            $products = [];
        }

        // Получаем уникальные категории для формы
        $categories = array_column($products, 'category');
        $uniqueCategories = array_unique($categories);

        // Форма для выбора категории
        echo "<h3>Поиск товаров по категории</h3>";
        echo "<form method='POST'>";
        echo "<label for='category'>Выберите категорию:</label> ";
        echo "<select name='category' id='category'>";
        echo "<option value=''>-- Выберите категорию --</option>";
        foreach ($uniqueCategories as $category) {
            $selected = (isset($_POST['category']) && $_POST['category'] == $category) ? 'selected' : '';
            echo "<option value='$category' $selected>$category</option>";
        }
        echo "</select> ";
        echo "<input type='submit' value='Показать товары'>";
        echo "</form>";

        // Форма для поиска карточки по наименованию
        echo "<h3>Поиск карточки товара</h3>";
        echo "<form method='POST'>";
        echo "<label for='product_name'>Введите наименование товара:</label> ";
        echo "<input type='text' name='product_name' id='product_name' value='" . (isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '') . "'> ";
        echo "<input type='submit' value='Показать карточку'>";
        echo "</form>";

        //Просмотр товаров выбранной категории
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category']) && !empty($_POST['category'])) {
            $selectedCategory = $_POST['category'];
            if (!in_array($selectedCategory, $uniqueCategories)) {
                echo "<p>Ничего не найдено</p>";
            } else {
                $filteredProducts = array_filter($products, function($p) use ($selectedCategory) {
                    return $p['category'] == $selectedCategory;
                });
                if (empty($filteredProducts)) {
                    echo "<p>В категории '$selectedCategory' пока нет товаров</p>";
                } else {
                    echo "<h2>Товары в категории: $selectedCategory</h2>";
                    foreach ($filteredProducts as $product) {
                        $availability = $product['stock'] ? 'В наличии' : 'Нет в наличии';
                        $offer = !empty($product['offer']) ? " ({$product['offer']})" : '';
                        echo "<div style='border: 1px solid #000000ff; padding: 10px; margin: 10px; display: inline-block; width: 300px;'>";
                        echo "<img src='{$product['imageUrl']}' alt='{$product['name']}' style='max-width: 200px; max-height: 150px;'><br>";
                        echo "<b>{$product['name']}</b><br>";
                        echo "Цена: {$product['price']} руб.<br>";
                        echo "Категория: {$product['category']}<br>";
                        echo "Бренд: {$product['brand']}<br>";
                        echo "Статус: $availability$offer<br>";
                        echo "</div>";
                    }
                }
            }
        }

        //Карточка товара
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name']) && !empty($_POST['product_name'])) {
            $productName = trim($_POST['product_name']);
            $productCards = array_filter($products, function($p) use ($productName) {
                return $p['name'] === $productName;
            });
            if (!$productCards) {
                echo "<p>Ничего не найдено</p>";
            } else {
                $product = array_values($productCards)[0];
                echo "<h2>{$product['name']}</h2>";
                echo "<img src='{$product['imageUrl']}' style='max-width:100px;' alt='{$product['name']}'>";
                if ($product['offer']) {
                    echo "<div>Акция: {$product['offer']}</div>";
                }
                if (!$product['stock']) {
                    echo "<div>Нет на складе</div>";
                }
                echo "Цена: {$product['price']} руб.<br>";
            }
        }

        if (!empty($products)) {
            //Таблица товаров
            echo "<h2>Таблица товаров</h2>";
            echo "<table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>";
            echo "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #ddd; padding: 5px;'>Наименование</th><th style='border: 1px solid #ddd; padding: 5px;'>Категория</th><th style='border: 1px solid #ddd; padding: 5px;'>Бренд</th><th style='border: 1px solid #ddd; padding: 5px;'>Цена</th></tr>";
            foreach ($products as $product) {
                echo "<tr style='background-color: " . (array_search($product, $products) % 2 == 0 ? '#f9f9f9' : 'white') . ";'>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['name']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['category']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['brand']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['price']} руб.</td>";
                echo "</tr>";
            }
            echo "</table>";

            //Таблица, сортированная по цене
            $sortedByPrice = $products;
            usort($sortedByPrice, fn($a, $b) => $a['price'] <=> $b['price']);
            echo "<h2>Товары отсортированные по цене (по возрастанию)</h2>";
            echo "<table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>";
            echo "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #ddd; padding: 5px;'>Наименование</th><th style='border: 1px solid #ddd; padding: 5px;'>Категория</th><th style='border: 1px solid #ddd; padding: 5px;'>Бренд</th><th style='border: 1px solid #ddd; padding: 5px;'>Цена</th></tr>";
            foreach ($sortedByPrice as $index => $product) {
                echo "<tr style='background-color: " . ($index % 2 == 0 ? '#f9f9f9' : 'white') . ";'>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['name']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['category']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['brand']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['price']} руб.</td>";
                echo "</tr>";
            }
            echo "</table>";

            //Таблица, сортированная по категории
            $sortedByCategory = $products;
            usort($sortedByCategory, fn($a, $b) => strcmp($a['category'], $b['category']));
            echo "<h2>Товары отсортированные по категории</h2>";
            echo "<table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>";
            echo "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #ddd; padding: 5px;'>Наименование</th><th style='border: 1px solid #ddd; padding: 5px;'>Категория</th><th style='border: 1px solid #ddd; padding: 5px;'>Бренд</th><th style='border: 1px solid #ddd; padding: 5px;'>Цена</th></tr>";
            foreach ($sortedByCategory as $index => $product) {
                echo "<tr style='background-color: " . ($index % 2 == 0 ? '#f9f9f9' : 'white') . ";'>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['name']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['category']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['brand']}</td>";
                echo "<td style='border: 1px solid #ddd; padding: 5px;'>{$product['price']} руб.</td>";
                echo "</tr>";
            }
            echo "</table>";

            //Товары по категориям списком
            $grouped = [];
            foreach ($products as $product) {
                $grouped[$product['category']][] = $product;
            }
            echo "<h2>Товары по категориям</h2>";
            foreach ($grouped as $cat => $items) {
                echo "<b>$cat</b><br>";
                foreach ($items as $item) {
                    echo "{$item['name']} - {$item['brand']} {$item['price']} р.<br>";
                }
                echo "<br>";
            }
        }
        ?>
    </body>
</html>