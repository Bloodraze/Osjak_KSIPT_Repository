<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Регистрация нового пользователя</h1>
<?php
$regErrors = [];
$success = false;
$regName = '';
$regEmail = '';
$regLogin = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $regName = trim($_POST['name'] ?? '');
    $regEmail = trim($_POST['email'] ?? '');
    $regLogin = trim($_POST['login'] ?? '');
    $regPass1 = $_POST['password'] ?? '';
    $regPass2 = $_POST['password_confirm'] ?? '';
    if ($regName === '')  $regErrors[] = "Не заполнено имя";
    if ($regEmail === '') $regErrors[] = "Не заполнен email";
    if ($regLogin === '') $regErrors[] = "Не заполнен логин";
    if ($regPass1 === '' || $regPass2 === '') $regErrors[] = "Не заполнены поля пароля";
    if ($regPass1 !== $regPass2) $regErrors[] = "введенные пароли не совпадают";
    $usersFile = 'users.json';
    $users = [];
    if (file_exists($usersFile)) {
        $data = file_get_contents($usersFile);
        $users = json_decode($data, true);
        if (!is_array($users)) {
            $users = [];
        }
    }
    foreach ($users as $u) {
        if ($u['login'] === $regLogin) {
            $regErrors[] = "Пользователь с таким логином уже существует";
            break;
        }
    }
    if (empty($regErrors)) {
        $newUser = [
            'name' => $regName,
            'login' => $regLogin,
            'password' => $regPass1,
            'email' => $regEmail,
            'role' => 'user'
        ];
        $users[] = $newUser;
        file_put_contents($usersFile, json_encode($users, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $success = true;
        echo "<p>регистрация успешна</p>";
        echo "<p><a href='shop.php'>Перейти на страницу товаров</a></p>";
    }
}
if (!$success) {
    if (!empty($regErrors)) {
        echo "<p>Ошибки регистрации:</p><ul>";
        foreach ($regErrors as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul>";
    }
    echo "<form method='POST'>";
    echo "Имя: <input type='text' name='name' value='", htmlspecialchars($regName), "' required><br>";
    echo "Email: <input type='email' name='email' value='", htmlspecialchars($regEmail), "' required><br>";
    echo "Логин: <input type='text' name='login' value='", htmlspecialchars($regLogin), "' required><br>";
    echo "Пароль: <input type='password' name='password' required><br>";
    echo "Подтверждение пароля: <input type='password' name='password_confirm' required><br>";
    echo "<input type='submit' value='Зарегистрироваться'>";
    echo "</form>";
}
?>
<p><a href="shop.php">Назад к товарам</a></p>
</body>
</html>