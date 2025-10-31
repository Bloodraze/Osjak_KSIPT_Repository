<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>WATERDROP</title>
        <style>
            .product-image {
                max-width: 200px;
                max-height: 150px;
            }
            .product-card {
                border: 1px solid #000000ff;
                padding: 10px;
                margin: 10px;
                display: inline-block;
                width: 300px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 5px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            .form-container {
                margin: 20px 0;
                padding: 5px;
                border: 1px solid #ccc;
                background-color: #f9f9f9;
            }
            .message {
                padding: 5px;
                margin: 10px 0;
                border-radius: 5px;
            }
            .error {
                background-color: #ffebee;
                color: #c62828;
                border: 1px solid #ffcdd2;
            }
            .info {
                background-color: #e8f5e8;
                color: #2e7d32;
                border: 1px solid #c8e6c9;
            }
        </style>
    </head>
    <body>
        <h1 align="center">WATERDROP - Самые Универсальные Фильтры Для Воды!</h1>
        <?php
        $products = [
            [
                'name' => 'Фильтр настольный Аквафор Кристалл',
                'category' => 'Проточные фильтры',
                'price' => 2890,
                'brand' => 'Аквафор',
                'imageUrl' => 'img/aquaphor-crystal.jpg',
                'stock' => true,
                'offer' => 'Бесплатная установка'
            ],
            [
                'name' => 'Фильтр под мойку Барьер Эксперт Стандарт',
                'category' => 'Проточные фильтры',
                'price' => 3490,
                'brand' => 'Барьер',
                'imageUrl' => 'img/barrier-expert.jpg',
                'stock' => true,
                'offer' => 'Подарок: 3 картриджа'
            ],
            [
                'name' => 'Система обратного осмоса Гейзер Престиж',
                'category' => 'Системы обратного осмоса',
                'price' => 8990,
                'brand' => 'Гейзер',
                'imageUrl' => 'img/geizer-prestige.jpg',
                'stock' => false,
                'offer' => ''
            ],
            [
                'name' => 'Фильтр-кувшин Аквафор Прованс',
                'category' => 'Фильтры-кувшины',
                'price' => 790,
                'brand' => 'Аквафор',
                'imageUrl' => 'img/aquaphor-provance.jpg',
                'stock' => true,
                'offer' => 'Скидка 15%'
            ],
            [
                'name' => 'Система обратного осмоса Атолл A-550',
                'category' => 'Системы обратного осмоса',
                'price' => 12500,
                'brand' => 'Atoll',
                'imageUrl' => 'img/atoll-a550.jpg',
                'stock' => true,
                'offer' => 'Рассрочка 0%'
            ],
            [
                'name' => 'Фильтр-кувшин Барьер Гранд',
                'category' => 'Фильтры-кувшины',
                'price' => 650,
                'brand' => 'Барьер',
                'imageUrl' => 'img/barrier-grand.jpg',
                'stock' => true,
                'offer' => ''
            ],
            [
                'name' => 'Насадка на кран Барьер Компакт',
                'category' => 'Насадки на кран',
                'price' => 890,
                'brand' => 'Барьер',
                'imageUrl' => 'img/barrier-compact.jpg',
                'stock' => true,
                'offer' => 'Хит продаж'
            ],
            [
                'name' => 'Система обратного осмоса Новая Вода Praktic',
                'category' => 'Системы обратного осмоса',
                'price' => 7590,
                'brand' => 'Новая Вода',
                'imageUrl' => 'img/new-water-praktic.jpg',
                'stock' => true,
                'offer' => 'Установка в подарок'
            ],
            [
                'name' => 'Фильтр-кувшин Гейзер Грифон',
                'category' => 'Фильтры-кувшины',
                'price' => 550,
                'brand' => 'Гейзер',
                'imageUrl' => 'img/geizer-grifon.jpg',
                'stock' => false,
                'offer' => ''
            ],
            [
                'name' => 'Насадка на кран Аквафор Топаз',
                'category' => 'Насадки на кран',
                'price' => 1200,
                'brand' => 'Аквафор',
                'imageUrl' => 'img/aquaphor-topaz.jpg',
                'stock' => true,
                'offer' => 'Акция: 2 по цене 1'
            ]
        ];
        // Получаем уникальные категории для формы
        $categories = array_column($products, 'category');
        $uniqueCategories = array_unique($categories);
        // Форма для выбора категории
        echo "<div class='form-container'>";
        echo "<h3>Поиск товаров по категории</h3>";
        echo "<form method='POST'>";
        echo "<label for='category'>Выберите категорию:</label>";
        echo "<select name='category' id='category'>";
        echo "<option value=''>-- Выберите категорию --</option>";
        foreach ($uniqueCategories as $category) {
            $selected = (isset($_POST['category']) && $_POST['category'] == $category) ? 'selected' : '';
            echo "<option value='$category' $selected>$category</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Показать товары'>";
        echo "</form>";
        echo "</div>";
        // Форма для поиска карточки по наименованию
        echo "<div class='form-container'>";
        echo "<h3>Поиск карточки товара</h3>";
        echo "<form method='POST'>";
        echo "<label for='product_name'>Введите наименование товара:</label> ";
        echo "<input type='text' name='product_name' id='product_name'>";
        echo "<input type='submit' value='Показать карточку'>";
        echo "</form>";
        echo "</div>";
        //Просмотр товаров выбранной категории
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category']) && !empty($_POST['category'])) {
            $selectedCategory = $_POST['category'];
            if (!in_array($selectedCategory, $uniqueCategories)) {
                echo "<div class='message error'>Ничего не найдено</div>";
            } else {
                $filteredProducts = array_filter($products, function($p) use ($selectedCategory) {
                    return $p['category'] == $selectedCategory;
                });
                if (empty($filteredProducts)) {
                    echo "<div class='message info'>В категории '$selectedCategory' пока нет товаров</div>";
                } else {
                    echo "<h2>Товары в категории: $selectedCategory</h2>";
                    echo "<div style='display: flex; flex-wrap: wrap;'>";
                    foreach ($filteredProducts as $product) {
                        $availability = $product['stock'] ? 'В наличии' : 'Нет в наличии';
                        $offer = !empty($product['offer']) ? " ({$product['offer']})" : '';
                        echo "<div class='product-card'>";
                        echo "<img src='{$product['imageUrl']}' alt='{$product['name']}' class='product-image'><br>";
                        echo "<b>{$product['name']}</b><br>";
                        echo "Цена: {$product['price']} руб.<br>";
                        echo "Категория: {$product['category']}<br>";
                        echo "Бренд: {$product['brand']}<br>";
                        echo "Статус: $availability$offer<br>";
                        echo "</div>";
                    }
                    echo "</div>";
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
                echo "<div class='message error'>Ничего не найдено</div>";
            } else {
                $product = array_values($productCards)[0];
                echo "<div class='product-card'>";
                echo "<h2>{$product['name']}</h2>";
                echo "<img src='{$product['imageUrl']}' style='max-width:100px;' alt='{$product['name']}'>";
                if ($product['offer']) {
                    echo "<div class='info'>Акция: {$product['offer']}</div>";
                }
                if (!$product['stock']) {
                    echo "<div class='error'>Нет на складе</div>";
                }
                echo "<div>Цена: {$product['price']} руб.</div>";
                echo "</div>";
            }
        }
        //Таблица товаров
        echo "<h2>Таблица товаров</h2>";
        echo "<table>";
        echo "<tr><th>Наименование</th><th>Категория</th><th>Бренд</th><th>Цена</th></tr>";
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['category']}</td>";
            echo "<td>{$product['brand']}</td>";
            echo "<td>{$product['price']} руб.</td>";
            echo "</tr>";
        }
        echo "</table>";
        //Таблица, сортированная по цене
        $sortedByPrice = $products;
        usort($sortedByPrice, fn($a, $b) => $a['price'] <=> $b['price']);
        echo "<h2>Товары отсортированные по цене (по возрастанию)</h2>";
        echo "<table>";
        echo "<tr><th>Наименование</th><th>Категория</th><th>Бренд</th><th>Цена</th></tr>";
        foreach ($sortedByPrice as $product) {
            echo "<tr>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['category']}</td>";
            echo "<td>{$product['brand']}</td>";
            echo "<td>{$product['price']} руб.</td>";
            echo "</tr>";
        }
        echo "</table>";
        //аблица, сортированная по категории
        $sortedByCategory = $products;
        usort($sortedByCategory, fn($a, $b) => strcmp($a['category'], $b['category']));
        echo "<h2>Товары отсортированные по категории</h2>";
        echo "<table>";
        echo "<tr><th>Наименование</th><th>Категория</th><th>Бренд</th><th>Цена</th></tr>";
        foreach ($sortedByCategory as $product) {
            echo "<tr>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['category']}</td>";
            echo "<td>{$product['brand']}</td>";
            echo "<td>{$product['price']} руб.</td>";
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
        ?>
    </body>
</html>