<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>WATERDROP</title>
</head>
<body>
<h1 align="center">WATERDROP - Самые Универсальные Фильтры Для Воды!</h1>
<?php
$filename = 'goods.json';
try {
    $jsonData = @file_get_contents($filename);
    if ($jsonData === false) {
        throw new Exception("<b>Отладка:</b> Файл с данными '$filename' не найден");
    }
    $products = json_decode($jsonData, true);
    if ($products === null) {
        throw new Exception("<b>Отладка:</b> Файл с данными '$filename' повреждён");
    }
    echo '<b>Отладка:</b> Всё в порядке!<br>';
} catch (Exception $ex) {
    echo "<p>" . $ex->getMessage() . "</p>";
    $products = [];
}
/* === Обработка добавления товара (POST add_product) === */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name        = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price       = trim($_POST['price'] ?? '');
    $stock       = trim($_POST['stock'] ?? '');
    $imageUrl    = trim($_POST['imageUrl'] ?? '');
    $offer       = trim($_POST['offer'] ?? '');
    // Категория: если текстовое поле не пустое – берём его, иначе select
    $categoryText   = trim($_POST['category_text'] ?? '');
    $categorySelect = trim($_POST['category_select'] ?? '');
    $category       = $categoryText !== '' ? $categoryText : $categorySelect;
    $errors = [];
    if ($name === '')        $errors[] = "Не заполнено поле 'Наименование'";
    if ($description === '') $errors[] = "Не заполнено поле 'Описание'";
    if ($category === '')    $errors[] = "Не выбрана категория";
    // Проверка числа для price и stock
    if ($price === '' || !is_numeric($price)) {
        $errors[] = "Поле 'Цена' должно быть числом";
    }
    if ($stock === '' || !ctype_digit($stock)) {
        $errors[] = "Поле 'Остаток' должно быть целым числом";
    }
    if (empty($errors)) {
        $newProduct = [
            'name'        => $name,
            'description' => $description,
            'category'    => $category,
            'price'       => (float)$price,
            'imageUrl'    => $imageUrl,
            'stock'       => (int)$stock,
            'offer'       => $offer
        ];
        $products[] = $newProduct;
        file_put_contents($filename, json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        echo "<p>Товар успешно добавлен.</p>";
    } else {
        echo "<p>Ошибки при добавлении товара:</p><ul>";
        foreach ($errors as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul>";
    }
}
/* === Обработка удаления товара (GET или POST delete) === */
if (isset($_REQUEST['delete_index'])) {
    $deleteIndex = (int)$_REQUEST['delete_index'];
    if (isset($products[$deleteIndex])) {
        unset($products[$deleteIndex]);
        $products = array_values($products);
        file_put_contents($filename, json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        echo "<p>Товар удалён.</p>";
    } else {
        echo "<p>Товар с таким индексом не найден.</p>";
    }
}
/* === Уникальные категории для select === */
$categories = array_column($products, 'category');
$uniqueCategories = array_unique($categories);
/* === Форма поиска по категории (вывод по категориям) === */
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
/* === Форма поиска карточки по наименованию === */
echo "<h3>Поиск карточки товара</h3>";
echo "<form method='POST'>";
echo "<label for='product_name'>Введите наименование товара:</label> ";
echo "<input type='text' name='product_name' id='product_name' value='" .
     (isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '') . "'> ";
echo "<input type='submit' value='Показать карточку'>";
echo "</form>";
/* === Форма добавления товара (textarea, required, числовые поля) === */
echo "<h3>Добавление товара</h3>";
echo "<form method='POST'>";
echo "<input type='hidden' name='add_product' value='1'>";
echo "Наименование*: <input type='text' name='name' required><br>";
echo "Описание*: <br><textarea name='description' rows='4' cols='40' required></textarea><br>";
echo "Категория (новая)*: <input type='text' name='category_text'><br>";
echo "Или выберите категорию: <select name='category_select'>";
echo "<option value=''>-- Выберите категорию --</option>";
foreach ($uniqueCategories as $category) {
    echo "<option value='$category'>$category</option>";
}
echo "</select><br>";
echo "Цена* (число): <input type='number' name='price' required><br>";
echo "Остаток* (целое): <input type='number' name='stock' required><br>";
echo "Адрес изображения: <input type='text' name='imageUrl'><br>";
echo "Акция: <input type='text' name='offer'><br>";
echo "<input type='submit' value='Добавить товар'>";
echo "</form>";
/* === Просмотр товаров выбранной категории (карточки) === */
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
            foreach ($filteredProducts as $index => $product) {
                $availability = $product['stock'] ? 'В наличии' : 'Нет в наличии';
                $offer = !empty($product['offer']) ? " ({$product['offer']})" : '';
                echo "<div>";
                if (!empty($product['imageUrl'])) {
                    echo "<img src='{$product['imageUrl']}' alt='{$product['name']}' style='max-width: 200px; max-height: 150px;'><br>";
                }
                echo "<b>{$product['name']}</b><br>";
                echo "Цена: {$product['price']} руб.<br>";
                echo "Категория: {$product['category']}<br>";
                echo "Статус: $availability$offer<br>";
                // Ссылка удаления через GET
                echo "<a href='?delete_index=$index'>Удалить товар</a><br>";
                echo "</div><br>";
            }
        }
    }
}
/* === Карточка товара по имени === */
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
        if (!empty($product['imageUrl'])) {
            echo "<img src='{$product['imageUrl']}' style='max-width:100px;' alt='{$product['name']}'><br>";
        }
        if (!empty($product['offer'])) {
            echo "<div>Акция: {$product['offer']}</div>";
        }
        if (!$product['stock']) {
            echo "<div>Нет на складе</div>";
        }
        echo "Цена: {$product['price']} руб.<br>";
        echo "Категория: {$product['category']}<br>";
    }
}
/* === Вывод товаров по категориям (списком) === */
if (!empty($products)) {
    $grouped = [];
    foreach ($products as $product) {
        $grouped[$product['category']][] = $product;
    }
    echo "<h2>Товары по категориям</h2>";
    foreach ($grouped as $cat => $items) {
        echo "<b>$cat</b><br>";
        foreach ($items as $index => $item) {
            echo "{$item['name']} {$item['price']} р. ";
            echo "<a href='?delete_index=$index'>Удалить</a><br>";
        }
        echo "<br>";
    }
}
?>
</body>
</html>