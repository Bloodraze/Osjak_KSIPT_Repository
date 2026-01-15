<?php
session_start(); // Запускаем сессию для хранения данных пользователя между запросами
?>
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
$usersFile = 'users.json';
$users = []; // Массив для хранения пользователей (по умолчанию пустой)
if (file_exists($usersFile)) {  // Проверяем, существует ли файл с пользователями
    $usersData = file_get_contents($usersFile);
    $users = json_decode($usersData, true);
    if (!is_array($users)) {  // Если декодирование не дало массив (файл поврежден или пустой)
        $users = []; // Сбрасываем в пустой массив для безопасности
    } else {
        // Проверяем и создаем массив favourites для каждого пользователя, если его нет
        foreach ($users as &$u) { // &u - ссылка, чтобы изменять элементы массива напрямую
            if (!isset($u['favourites']) or !is_array($u['favourites'])) {
                $u['favourites'] = []; // Создаем пустой массив избранного, если отсутствует
            }
        }
        unset($u); // Удаляем ссылку $u после цикла
    }
}
/* === ТЕКУЩИЙ ПОЛЬЗОВАТЕЛЬ / РОЛЬ === */
$currentUser = null; // Переменная для текущего авторизованного пользователя
$isAdmin = false; // Флаг администратора (false = обычный пользователь)
/* === ВЫХОД ИЗ АККАУНТА === */
if (isset($_GET['logout'])) {   // Если в URL передан параметр logout=1
    unset($_SESSION['user']); // Удаляем данные пользователя из сессии (выход)
}
/* === ОБРАБОТКА ФОРМЫ АВТОРИЗАЦИИ === */
$loginError = ''; // Переменная для хранения сообщения об ошибке входа
// Проверяем POST-запрос с отправкой формы авторизации
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['auth_submit'])) {
    $login = trim($_POST['login'] ?? ''); // Получаем логин из формы, убираем пробелы (??='' если поля нет)
    $password = trim($_POST['password'] ?? ''); // Получаем пароль из формы, убираем пробелы
    $foundUser = null;  // Переменная для найденного пользователя
    // Ищем пользователя с совпадающим логином и паролем
    foreach ($users as $u) {
        if ($u['login'] === $login && $u['password'] === $password) { // Точное совпадение логина И пароля
            $foundUser = $u;  // Сохраняем найденного пользователя
            break; // Прерываем поиск, пользователь найден
        }
    }
    if ($foundUser) { // Если пользователь найден
        $_SESSION['user'] = $foundUser;   // Сохраняем данные в сессию (успешная авторизация)
    } else { // Если логин/пароль неверные
        $loginError = 'Неправильный логин или пароль'; // Устанавливаем сообщение об ошибке
    }
}
/* === ПОЛУЧЕНИЕ ТЕКУЩЕГО ПОЛЬЗОВАТЕЛЯ ИЗ СЕССИИ === */
if (isset($_SESSION['user'])) { // Если в сессии есть данные пользователя
    $currentUser = $_SESSION['user']; // Загружаем текущего пользователя
    // Проверяем роль администратора
    $isAdmin = isset($currentUser['role']) && $currentUser['role'] === 'admin';
}
/* === БЛОК ПОЛЬЗОВАТЕЛЯ / ФОРМА АВТОРИЗАЦИИ === */
if ($currentUser) {  // Если пользователь авторизован
    // Показываем информацию о текущем пользователе и ссылки
    echo "<p>Вы вошли как: <b>{$currentUser['name']}</b> ({$currentUser['role']}) ";
    echo "<a href='?logout=1'>Выйти</a> | "; // Ссылка для выхода
    echo "<a href='favorite.php'>Избранные товары</a></p>"; // Ссылка на страницу избранного
} else {   // Если пользователь НЕ авторизован
    echo "<h3>Авторизация</h3>";  // Заголовок блока авторизации
    if ($loginError !== '') {  // Если есть ошибка авторизации
        echo "<p>$loginError</p>"; // Выводим сообщение об ошибке
    }
    // Форма входа в систему
    echo "<form method='POST'>";
    echo "Логин*: <input type='text' name='login' required><br>"; // Поле логина (обязательное)
    echo "Пароль*: <input type='password' name='password' required><br>"; // Поле пароля (скрытое, обязательное)
    echo "<input type='submit' name='auth_submit' value='Войти'>"; // Кнопка отправки формы
    echo "</form>";
    echo "<p><a href='register.php'>Регистрация</a></p>";  // Ссылка на регистрацию
}
/* === ЗАГРУЗКА ТОВАРОВ ИЗ ФАЙЛА goods.json === */
$filename = 'goods.json'; // Имя файла с данными товаров
try {  // Блок обработки исключений для безопасной загрузки данных
    $jsonData = @file_get_contents($filename); // Читаем файл (@ подавляет предупреждения)
    if ($jsonData === false) { // Если файл не удалось прочитать
        throw new Exception("<b>Отладка:</b> Файл с данными '$filename' не найден"); // Создаем исключение
    }
    $products = json_decode($jsonData, true); // Парсим JSON в ассоциативный массив
    if ($products === null) { // Если JSON некорректный
        throw new Exception("<b>Отладка:</b> Файл с данными '$filename' повреждён"); // Создаем исключение
    }
    echo '<b>Отладка:</b> Всё в порядке!<br>'; // Успешная загрузка данных
} catch (Exception $ex) { // Ловим любые исключения
    echo "<p>", $ex->getMessage(), "</p>"; // Выводим сообщение об ошибке
    $products = []; // Сбрасываем массив товаров в пустой
}
/* === ОБРАБОТКА ДОБАВЛЕНИЯ НОВОГО ТОВАРА (ТОЛЬКО ДЛЯ АДМИНА) === */
if ($isAdmin && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    // Получаем данные новой формы товара
    $name = trim($_POST['name'] ?? ''); // Название товара (обрезаем пробелы)
    $description = trim($_POST['description'] ?? ''); // Описание товара
    $price = trim($_POST['price'] ?? ''); // Цена (строка)
    $stock = trim($_POST['stock'] ?? ''); // Количество на складе
    $imageUrl = trim($_POST['imageUrl'] ?? ''); // URL изображения
    $offer = trim($_POST['offer'] ?? ''); // Текст акции
    // Определяем категорию: новая (текст) или из списка
    $categoryText = trim($_POST['category_text'] ?? '');   // Пользовательская категория
    $categorySelect = trim($_POST['category_select'] ?? ''); // Выбранная из списка
    $category = $categoryText !== '' ? $categoryText : $categorySelect; // Приоритет тексту
    $errors = []; // Массив для ошибок валидации
    // Валидация обязательных полей
    if ($name === '') $errors[] = "Не заполнено поле 'Наименование'";
    if ($description === '') $errors[] = "Не заполнено поле 'Описание'";
    if ($category === '') $errors[] = "Не выбрана категория";
    // Валидация цены (должна быть числом)
    if ($price === '' or !is_numeric($price)) {
        $errors[] = "Поле 'Цена' должно быть числом";
    }
    // Валидация остатка (целое неотрицательное число)
    if ($stock === '' or !ctype_digit($stock)) {
        $errors[] = "Поле 'Остаток' должно быть целым числом";
    }
    if (empty($errors)) { // Если ошибок нет - добавляем товар
        // Находим максимальный ID для нового товара
        $maxId = 0;
        foreach ($products as $p) {
            if (isset($p['id']) && $p['id'] > $maxId) {
                $maxId = $p['id'];
            }
        }
        $newId = $maxId + 1; // Новый уникальный ID
        // Создаем структуру нового товара
        $newProduct = [
            'id' => $newId, // Уникальный идентификатор
            'name' => $name, // Название
            'description' => $description, // Описание
            'category' => $category, // Категория
            'price' => (float)$price, // Цена как число с плавающей точкой
            'imageUrl' => $imageUrl, // Ссылка на изображение
            'stock' => (int)$stock, // Остаток как целое число
            'offer' => $offer // Акция (может быть пустой)
        ];
        $products[] = $newProduct; // Добавляем в конец массива
        // Сохраняем обновленный список в файл
        file_put_contents(
            $filename,
            json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) // Красивый JSON с кириллицей
        );
        echo "<p>Товар успешно добавлен.</p>"; // Подтверждение успеха
    } else {
        // Выводим все ошибки в виде списка
        echo "<p>Ошибки при добавлении товара:</p><ul>";
        foreach ($errors as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul>";
    }
}
/* === ОБРАБОТКА УДАЛЕНИЯ ТОВАРА (ТОЛЬКО АДМИН) === */
if ($isAdmin && isset($_REQUEST['delete_index'])) { // Админ и передан индекс для удаления
    $deleteIndex = (int)$_REQUEST['delete_index'];  // Преобразуем в целое число
    if (isset($products[$deleteIndex])) {  // Проверяем существование товара
        unset($products[$deleteIndex]);  // Удаляем элемент по индексу
        $products = array_values($products); // Переиндексируем массив (убираем "дырки")
        // Сохраняем обновленный список
        file_put_contents(
            $filename,
            json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
        echo "<p>Товар удалён.</p>";  // Успешное удаление
    } else {
        echo "<p>Товар с таким индексом не найден.</p>"; // Ошибка: товар не существует
    }
}
/* === ДОБАВЛЕНИЕ ТОВАРА В ИЗБРАННОЕ (ТОЛЬКО АВТОРИЗОВАННЫЕ) === */
if ($currentUser && isset($_GET['favorite'])) {
    $favIndex = (int)$_GET['favorite']; // Индекс товара из GET-параметра
    if (isset($products[$favIndex]) && isset($products[$favIndex]['id'])) {
        $productId = $products[$favIndex]['id']; // Берем ID товара (не индекс!)
        // Находим и обновляем текущего пользователя в общем списке
        foreach ($users as &$u) {
            if ($u['login'] === $currentUser['login']) {
                // Добавляем ID товара в избранное, только если его там нет
                if (!in_array($productId, $u['favourites'])) {
                    $u['favourites'][] = $productId;
                }
                $currentUser = $u; // Обновляем локальную переменную
                $_SESSION['user'] = $u; // Обновляем сессию
                break;
            }
        }
        unset($u); // Удаляем ссылку
        // Сохраняем обновленный список пользователей
        file_put_contents(
            $usersFile,
            json_encode($users, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
        echo "<p>Товар добавлен в избранное.</p>";
    } else {
        echo "<p>Товар не найден.</p>";
    }
}
/* === ПОЛУЧЕНИЕ УНИКАЛЬНЫХ КАТЕГОРИЙ === */
$categories = array_column($products, 'category');  // Извлекаем все категории в отдельный массив
$uniqueCategories = array_unique($categories); // Оставляем только уникальные значения
/* === ФОРМА ПОИСКА ТОВАРОВ ПО КАТЕГОРИИ === */
echo "<h3>Поиск товаров по категории</h3>";
echo "<form method='POST'>";
echo "<label for='category'>Выберите категорию:</label> ";
echo "<select name='category' id='category'>";      // Выпадающий список
echo "<option value=''>-- Выберите категорию --</option>"; // Пункт по умолчанию
foreach ($uniqueCategories as $category) { // Генерируем опции для каждой категории
    // Подсвечиваем выбранную категорию при повторной отправке формы
    $selected = (isset($_POST['category']) && $_POST['category'] == $category) ? 'selected' : '';
    echo "<option value='$category' $selected>$category</option>";
}
echo "</select> ";
echo "<input type='submit' value='Показать товары'>"; // Кнопка поиска
echo "</form>";
/* === ФОРМА ПОИСКА ТОВАРА ПО НАИМЕНОВАНИЮ === */
echo "<h3>Поиск карточки товара</h3>";
echo "<form method='POST'>"; // Отдельная форма поиска по имени
echo "<label for='product_name'>Введите наименование товара:</label> ";
// Поле с сохранением введенного значения (htmlspecialchars защищает от XSS)
echo "<input type='text' name='product_name' id='product_name' value='" .
     (isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '') . "'> "; 
echo "<input type='submit' value='Показать карточку'>"; // Кнопка поиска
echo "</form>";
/* === ФОРМА ДОБАВЛЕНИЯ ТОВАРА (ДОСТУПНА ТОЛЬКО АДМИНУ) === */
if ($isAdmin) { // Показываем форму только администратору
    echo "<h3>Добавление товара</h3>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='add_product' value='1'>"; // Флаг-идентификатор формы
    echo "Наименование*: <input type='text' name='name' required><br>"; // Обязательное поле
    echo "Описание*: <br><textarea name='description' rows='4' cols='40' required></textarea><br>"; // Многострочное поле
    echo "Категория (новая)*: <input type='text' name='category_text'><br>"; // Пользовательская категория
    echo "Или выберите категорию: <select name='category_select'>"; // Альтернатива - выбор из списка
    echo "<option value=''>-- Выберите категорию --</option>";
    foreach ($uniqueCategories as $category) {  // Все существующие категории
        echo "<option value='$category'>$category</option>";
    }
    echo "</select><br>";
    echo "Цена* (число): <input type='number' name='price' required><br>";
    echo "Остаток* (целое): <input type='number' name='stock' required><br>";
    echo "Адрес изображения: <input type='text' name='imageUrl'><br>";
    echo "Акция: <input type='text' name='offer'><br>";
    echo "<input type='submit' value='Добавить товар'>";
    echo "</form>";
}
/* === ВЫВОД ТОВАРОВ ВЫБРАННОЙ КАТЕГОРИИ (КАРТОЧКИ) === */
// Показываем товары только при отправке формы категории
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category']) && !empty($_POST['category'])) {
    $selectedCategory = $_POST['category']; // Получаем выбранную категорию
    if (!in_array($selectedCategory, $uniqueCategories)) { // Проверяем существование категории
        echo "<p>Ничего не найдено</p>";
    } else {
        // Фильтруем товары по выбранной категории (closure с use)
        $filteredProducts = array_filter($products, function($p) use ($selectedCategory) {
            return $p['category'] == $selectedCategory;
        });
        if (empty($filteredProducts)) { // Если товаров нет
            echo "<p>В категории '$selectedCategory' пока нет товаров</p>";
        } else {
            echo "<h2>Товары в категории: $selectedCategory</h2>";
            // Выводим карточки товаров
            foreach ($filteredProducts as $index => $product) {
                $availability = $product['stock'] ? 'В наличии' : 'Нет в наличии'; // Статус по остатку
                $offer = !empty($product['offer']) ? " ({$product['offer']})" : ''; // Акция в скобках
                echo "<div>"; // Контейнер карточки
                if (!empty($product['imageUrl'])) { // Показываем изображение, если есть
                    echo "<img src='{$product['imageUrl']}' alt='{$product['name']}' style='max-width: 200px; max-height: 150px;'><br>";
                }
                echo "<b>{$product['name']}</b><br>"; // Название жирным
                echo "Цена: {$product['price']} руб.<br>";
                echo "Категория: {$product['category']}<br>";
                echo "Статус: $availability$offer<br>"; // Статус + акция
                // Действия в зависимости от роли
                if ($isAdmin) {  // Админ может удалять
                    echo "<a href='?delete_index=$index'>Удалить товар</a><br>";
                } elseif ($currentUser) { // Пользователь может добавлять в избранное
                    echo "<a href='?favorite=$index'>Добавить в избранное</a><br>";
                }
                echo "</div><br>";
            }
        }
    }
}
/* === ПОДРОБНАЯ КАРТОЧКА ТОВАРА ПО НАИМЕНОВАНИЮ === */
// Показываем карточку при поиске по точному имени
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name']) && !empty($_POST['product_name'])) {
    $productName = trim($_POST['product_name']); // Обрезаем пробелы
    // Ищем товары с точным совпадением имени
    $productCards = array_filter($products, function($p) use ($productName) {
        return $p['name'] === $productName;
    });
    if (!$productCards) {  // Если ничего не найдено
        echo "<p>Ничего не найдено</p>";
    } else {
        // Берем первый найденный товар
        $product = array_values($productCards)[0];
        echo "<h2>{$product['name']}</h2>"; // Название как заголовок
        if (!empty($product['imageUrl'])) { // Маленькая картинка
            echo "<img src='{$product['imageUrl']}' style='max-width:100px;' alt='{$product['name']}'><br>";
        }
        if (!empty($product['offer'])) { // Отдельный блок акции
            echo "<div>Акция: {$product['offer']}</div>";
        }
        if (!$product['stock']) { // Отдельное уведомление об отсутствии
            echo "<div>Нет на складе</div>";
        }
        echo "Цена: {$product['price']} руб.<br>";  
        echo "Категория: {$product['category']}<br>";
    }
}
/* === СПИСОК ВСЕХ ТОВАРОВ, ГРУППИРОВАННЫХ ПО КАТЕГОРИЯМ === */
if (!empty($products)) { // Если есть товары для вывода
    $grouped = []; // Массив для группировки
    // Группируем товары по категориям
    foreach ($products as $product) {
        $grouped[$product['category']][] = $product; // Добавляем в соответствующую группу
    }
    echo "<h2>Товары по категориям</h2>";
    // Выводим каждую группу
    foreach ($grouped as $cat => $items) {
        echo "<b>$cat</b><br>"; // Название категории жирным
        foreach ($items as $index => $item) { // Товары категории
            echo "{$item['name']} {$item['price']} р. "; // Краткая информация
            // Ссылки действий по ролям
            if ($isAdmin) { // Админ: удаление
                echo "<a href='?delete_index=$index'>Удалить</a>";
            } elseif ($currentUser) { // Пользователь: избранное
                echo "<a href='?favorite=$index'>Добавить в избранное</a>";
            }
            echo "<br>";
        }
        echo "<br>"; // Разделитель между категориями
    }
}
?>
</body>
</html>