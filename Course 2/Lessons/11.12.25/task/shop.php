<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"> 
    <title>WATERDROP</title>
</head>
<body>
<h1 align="center">WATERDROP - Самые Универсальные Фильтры Для Воды!</h1>
<?php
/* === ЗАГРУЗКА ПОЛЬЗОВАТЕЛЕЙ === */
$usersFile = 'users.json'; // Имя файла, в котором хранятся пользователи
$users = []; // Массив для пользователей по умолчанию (пустой)
if (file_exists($usersFile)) {  // Если файл с пользователями существует
    $usersData = file_get_contents($usersFile); // Читаем содержимое файла в строку
    $users = json_decode($usersData, true);     // Преобразуем JSON-строку в массив (ассоциативный, т.к. true)
    if (!is_array($users)) {  // Если декодирование не дало массив (например, файл поврежден)
        $users = []; // Сбрасываем в пустой массив
    }
}
/* === ТЕКУЩИЙ ПОЛЬЗОВАТЕЛЬ / РОЛЬ === */
$currentUser = null; // Переменная для текущего пользователя (по умолчанию никто не залогинен)
$isAdmin = false; // Флаг, является ли текущий пользователь администратором
/* === ВЫХОД === */
if (isset($_GET['logout'])) {   // Если в адресной строке есть параметр logout
    unset($_SESSION['user']); // Удаляем из сессии данные о пользователе (выход из аккаунта)
}
/* === АВТОРИЗАЦИЯ === */
$loginError = ''; // Строка для хранения текста ошибки авторизации
// Проверяем, была ли отправлена форма авторизации
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['auth_submit'])) {
    $login = trim($_POST['login'] ?? ''); // Берем логин из формы, обрезаем пробелы, если нет — пустая строка
    $password = trim($_POST['password'] ?? ''); // То же самое с паролем
    $foundUser = null;  // Переменная для найденного пользователя
    // Перебираем всех пользователей, чтобы найти совпадение логина и пароля
    foreach ($users as $u) {
        if ($u['login'] === $login && $u['password'] === $password) { // Сравнение логина и пароля
            $foundUser = $u;  // Сохраняем найденного пользователя
            break; // Прерываем цикл, пользователь найден
        }
    }
    if ($foundUser) { // Если пользователь найден
        $_SESSION['user'] = $foundUser;   // Сохраняем данные пользователя в сессию (авторизация)
    } else { // Если пользователь не найден
        $loginError = 'Неправильный логин или пароль'; // Текст ошибки
    }
}
/* === ПОЛЬЗОВАТЕЛЬ ИЗ СЕССИИ === */
if (isset($_SESSION['user'])) { // Если в сессии есть информация о пользователе
    $currentUser = $_SESSION['user']; // Загружаем текущего пользователя из сессии
    // Проверяем, есть ли у пользователя роль и равна ли она 'admin'
    $isAdmin = isset($currentUser['role']) && $currentUser['role'] === 'admin';
}
/* === БЛОК ПОЛЬЗОВАТЕЛЯ / ФОРМА ЛОГИНА === */
if ($currentUser) {  // Если пользователь авторизован
    // Выводим информацию о пользователе и ссылку для выхода
    echo "<p>Вы вошли как: <b>{$currentUser['name']}</b> ({$currentUser['role']}) ";
    echo "<a href='?logout=1'>Выйти</a></p>";
} else {   // Если пользователь НЕ авторизован
    echo "<h3>Авторизация</h3>";  // Заголовок блока авторизации
    if ($loginError !== '') {  // Если есть ошибка авторизации
        echo "<p>$loginError</p>"; // Показываем текст ошибки
    }
    // Форма авторизации
    echo "<form method='POST'>";
    echo "Логин*: <input type='text' name='login' required><br>";// Поле ввода логина
    echo "Пароль*: <input type='password' name='password' required><br>"; // Поле ввода пароля
    echo "<input type='submit' name='auth_submit' value='Войти'>"; // Кнопка отправки формы
    echo "</form>";
    echo "<p><a href='register.php'>Регистрация</a></p>";  // Ссылка на страницу регистрации
}
/* === ЗАГРУЗКА ТОВАРОВ ИЗ goods.json === */
$filename = 'goods.json'; // Имя файла с товарами
try {  // Блок try-catch для отлова ошибок
    $jsonData = @file_get_contents($filename); // Пытаемся прочитать файл (знак @ скрывает предупреждения)
    if ($jsonData === false) { // Если не удалось прочитать файл
        throw new Exception("<b>Отладка:</b> Файл с данными '$filename' не найден"); // Генерируем исключение
    }
    $products = json_decode($jsonData, true); // Преобразуем JSON в массив
    if ($products === null) { // Если JSON не распарсился (например, битый)
        throw new Exception("<b>Отладка:</b> Файл с данными '$filename' повреждён"); // Генерируем исключение
    }
    echo '<b>Отладка:</b> Всё в порядке!<br>'; // Сообщение, что загрузка прошла успешно
} catch (Exception $ex) { // Обработка исключений
    echo "<p>", $ex->getMessage(), "</p>"; // Выводим текст ошибки
    $products = []; // Обнуляем массив товаров
}
/* === ОБРАБОТКА ДОБАВЛЕНИЯ ТОВАРА (ТОЛЬКО АДМИН) === */
if ($isAdmin && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    // Забираем значения из формы добавления товара
    $name = trim($_POST['name'] ?? ''); // Наименование товара
    $description = trim($_POST['description'] ?? ''); // Описание товара
    $price = trim($_POST['price'] ?? ''); // Цена товара (строка, потом проверяем)
    $stock = trim($_POST['stock'] ?? ''); // Остаток (количество на складе)
    $imageUrl = trim($_POST['imageUrl'] ?? ''); // URL изображения товара
    $offer = trim($_POST['offer'] ?? ''); // Текст акции
    // Категория: если текстовое поле не пустое – берем его, иначе значение из select
    $categoryText = trim($_POST['category_text'] ?? '');   // Новая категория (текст)
    $categorySelect = trim($_POST['category_select'] ?? ''); // Выбранная категория из списка
    $category = $categoryText !== '' ? $categoryText : $categorySelect; // Итоговая категория
    $errors = []; // Массив для накопления ошибок валидации
    if ($name === '') $errors[] = "Не заполнено поле 'Наименование'"; // Проверка имени
    if ($description === '') $errors[] = "Не заполнено поле 'Описание'"; // Проверка описания
    if ($category === '') $errors[] = "Не выбрана категория"; // Проверка категории
    // Проверка цены: должна быть числом
    if ($price === '' or !is_numeric($price)) {
        $errors[] = "Поле 'Цена' должно быть числом";
    }
    // Проверка остатка: должно быть целым неотрицательным числом (ctype_digit)
    if ($stock === '' or !ctype_digit($stock)) {
        $errors[] = "Поле 'Остаток' должно быть целым числом";
    }
    if (empty($errors)) { // Если ошибок нет
        // Формируем массив нового товара
        $newProduct = [
            'name' => $name, // Наименование
            'description' => $description, // Описание
            'category' => $category, // Категория
            'price' => (float)$price, // Цена как число с плавающей точкой
            'imageUrl' => $imageUrl, // URL изображения
            'stock' => (int)$stock, // Остаток как целое число
            'offer' => $offer  // Акция
        ];
        $products[] = $newProduct; // Добавляем товар в массив товаров
        // Перезаписываем файл товаров с обновленным массивом
        file_put_contents(
            $filename,
            json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) // JSON без экранирования юникода, с отступами
        );
        echo "<p>Товар успешно добавлен.</p>"; // Сообщение об успехе
    } else {
        // Если есть ошибки, выводим их списком
        echo "<p>Ошибки при добавлении товара:</p><ul>";
        foreach ($errors as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul>";
    }
}
/* === ОБРАБОТКА УДАЛЕНИЯ ТОВАРА (ТОЛЬКО АДМИН) === */
if ($isAdmin && isset($_REQUEST['delete_index'])) { // Если админ и передан индекс товара для удаления
    $deleteIndex = (int)$_REQUEST['delete_index'];  // Приводим индекс к целому числу
    if (isset($products[$deleteIndex])) {  // Проверяем, существует ли товар с таким индексом
        unset($products[$deleteIndex]);  // Удаляем элемент из массива
        $products = array_values($products); // Переиндексируем массив с нуля
        file_put_contents(
            $filename,
            json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) // Сохраняем обновленный список в файл
        );
        echo "<p>Товар удалён.</p>";  // Сообщение об успешном удалении
    } else {
        echo "<p>Товар с таким индексом не найден.</p>"; // Сообщение, если индекс некорректный
    }
}
/* === УНИКАЛЬНЫЕ КАТЕГОРИИ === */
$categories = array_column($products, 'category');  // Извлекаем колонку 'category' из всех товаров
$uniqueCategories = array_unique($categories); // Оставляем только уникальные значения категорий
/* === ФОРМА ПОИСКА ПО КАТЕГОРИИ === */
echo "<h3>Поиск товаров по категории</h3>";
echo "<form method='POST'>"; // Форма поиска по категории (POST)
echo "<label for='category'>Выберите категорию:</label> ";
echo "<select name='category' id='category'>";      // Выпадающий список категорий
echo "<option value=''>-- Выберите категорию --</option>"; // Пустой вариант по умолчанию
foreach ($uniqueCategories as $category) { // Перебираем все уникальные категории
    // Если в POST выбрана категория, делаем соответствующую option выбранной
    $selected = (isset($_POST['category']) && $_POST['category'] == $category) ? 'selected' : '';
    echo "<option value='$category' $selected>$category</option>"; // Пункт списка
}
echo "</select> ";
echo "<input type='submit' value='Показать товары'>"; // Кнопка отправки формы
echo "</form>";
/* === ФОРМА ПОИСКА КАРТОЧКИ ПО ИМЕНИ === */
echo "<h3>Поиск карточки товара</h3>";
echo "<form method='POST'>"; // Форма поиска товара по имени
echo "<label for='product_name'>Введите наименование товара:</label> ";
// Поле ввода с сохранением введенного значения после отправки формы
echo "<input type='text' name='product_name' id='product_name' value='" .
     (isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '') . "'> "; 
// htmlspecialchars экранирует спецсимволы, чтобы защититься от XSS [web:7][web:10]
echo "<input type='submit' value='Показать карточку'>"; // Кнопка отправки формы
echo "</form>";
/* === ФОРМА ДОБАВЛЕНИЯ ТОВАРА (ТОЛЬКО АДМИН) === */
if ($isAdmin) { // Форма доступна только администратору
    echo "<h3>Добавление товара</h3>";
    echo "<form method='POST'>"; // Форму отправляем методом POST
    echo "<input type='hidden' name='add_product' value='1'>"; // Скрытое поле-флаг, что эта форма — добавление товара
    echo "Наименование*: <input type='text' name='name' required><br>"; // Обязательное поле имени
    echo "Описание*: <br><textarea name='description' rows='4' cols='40' required></textarea><br>"; // Описание
    echo "Категория (новая)*: <input type='text' name='category_text'><br>"; // Текстовое поле для новой категории
    echo "Или выберите категорию: <select name='category_select'>"; // Select для выбора существующей
    echo "<option value=''>-- Выберите категорию --</option>";       // Пустой пункт
    foreach ($uniqueCategories as $category) {  // Перебираем существующие категории
        echo "<option value='$category'>$category</option>";
    }
    echo "</select><br>";
    echo "Цена* (число): <input type='number' name='price' required><br>"; // Поле для цены
    echo "Остаток* (целое): <input type='number' name='stock' required><br>"; // Поле остатка
    echo "Адрес изображения: <input type='text' name='imageUrl'><br>"; // URL картинки товара
    echo "Акция: <input type='text' name='offer'><br>"; // Текст акции
    echo "<input type='submit' value='Добавить товар'>"; // Кнопка отправки формы
    echo "</form>";
}
/* === ВЫВОД ТОВАРОВ В ВЫБРАННОЙ КАТЕГОРИИ (КАРТОЧКИ) === */
// Если отправлена форма выбора категории и категория не пустая
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category']) && !empty($_POST['category'])) {
    $selectedCategory = $_POST['category']; // Сохраняем выбранную категорию
    if (!in_array($selectedCategory, $uniqueCategories)) { // Если такой категории нет в списке
        echo "<p>Ничего не найдено</p>"; // Сообщение, что ничего не найдено
    } else {
        // Фильтруем товары: оставляем только с выбранной категорией
        $filteredProducts = array_filter($products, function($p) use ($selectedCategory) {
            return $p['category'] == $selectedCategory;
        });
        if (empty($filteredProducts)) { // Если после фильтрации ничего не осталось
            echo "<p>В категории '$selectedCategory' пока нет товаров</p>";
        } else {
            echo "<h2>Товары в категории: $selectedCategory</h2>";
            // Перебираем отфильтрованные товары
            foreach ($filteredProducts as $index => $product) {
                // Статус наличия: если stock > 0, то "В наличии", иначе "Нет в наличии"
                $availability = $product['stock'] ? 'В наличии' : 'Нет в наличии';
                // Если есть акция, добавляем её в круглых скобках
                $offer = !empty($product['offer']) ? " ({$product['offer']})" : '';
                echo "<div>";
                if (!empty($product['imageUrl'])) { // Если указан URL изображения
                    // Выводим картинку с ограничениями по размеру
                    echo "<img src='{$product['imageUrl']}' alt='{$product['name']}' style='max-width: 200px; max-height: 150px;'><br>";
                }
                echo "<b>{$product['name']}</b><br>"; // Название товара
                echo "Цена: {$product['price']} руб.<br>"; // Цена
                echo "Категория: {$product['category']}<br>"; // Категория
                echo "Статус: $availability$offer<br>"; // Статус + акция
                if ($isAdmin) {  // Если админ
                    echo "<a href='?delete_index=$index'>Удалить товар</a><br>"; // Ссылка для удаления товара
                } elseif ($currentUser) { // Если обычный залогиненный пользователь
                    echo "<a href='?favorite=$index'>Добавить в избранное</a><br>"; // Ссылка добавить в избранное (логика не реализована)
                }
                echo "</div><br>";
            }
        }
    }
}
/* === КАРТОЧКА ТОВАРА ПО ИМЕНИ === */
// Если отправлена форма поиска по имени и поле не пустое
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name']) && !empty($_POST['product_name'])) {
    $productName = trim($_POST['product_name']); // Берем введенное имя товара и обрезаем пробелы
    // Фильтруем товары: выбираем те, у которых имя строго равно введенному
    $productCards = array_filter($products, function($p) use ($productName) {
        return $p['name'] === $productName;
    });
    if (!$productCards) {  // Если совпадений нет
        echo "<p>Ничего не найдено</p>";
    } else {
        // Берем первый найденный товар (array_values превращает в обычный массив с индексами)
        $product = array_values($productCards)[0];
        echo "<h2>{$product['name']}</h2>"; // Название товара как заголовок
        if (!empty($product['imageUrl'])) { // Если есть картинка
            echo "<img src='{$product['imageUrl']}' style='max-width:100px;' alt='{$product['name']}'><br>";
        }
        if (!empty($product['offer'])) { // Если есть акция
            echo "<div>Акция: {$product['offer']}</div>";
        }
        if (!$product['stock']) { // Если stock == 0 (нет на складе)
            echo "<div>Нет на складе</div>";
        }
        echo "Цена: {$product['price']} руб.<br>";  // Цена товара
        echo "Категория: {$product['category']}<br>"; // Категория товара
    }
}
/* === ВЫВОД ТОВАРОВ ПО КАТЕГОРИЯМ (СПИСКОМ) === */
if (!empty($products)) { // Если есть хотя бы один товар
    $grouped = []; // Массив для группировки по категориям
    // Группируем товары по категории
    foreach ($products as $product) {
        $grouped[$product['category']][] = $product; // В каждую категорию кладем соответствующие товары
    }
    echo "<h2>Товары по категориям</h2>";
    // Перебираем группы товаров по категориям
    foreach ($grouped as $cat => $items) {
        echo "<b>$cat</b><br>"; // Название категории
        foreach ($items as $index => $item) { // Перебираем товары в этой категории
            echo "{$item['name']} {$item['price']} р. "; // Краткая строка: имя + цена
            if ($isAdmin) { // Для админа показываем ссылку удаления
                echo "<a href='?delete_index=$index'>Удалить</a>";
            } elseif ($currentUser) { // Для обычного авторизованного пользователя
                echo "<a href='?favorite=$index'>Добавить в избранное</a>";
            }
            echo "<br>";
        }
        echo "<br>";
    }
}
?>
</body>
</html>