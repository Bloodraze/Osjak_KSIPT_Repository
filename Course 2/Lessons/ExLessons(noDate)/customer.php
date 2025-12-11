<?php
session_start();
$users = json_decode(file_get_contents('customer.json'), true);
$error = '';
$loggedInUser = null;
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    foreach ($users as $user) {
        if ($user['login'] === $login && $user['password'] === $password) {
            $loggedInUser = $user;
            $_SESSION['user'] = $user;
            break;
        }
    }
    if (!$loggedInUser) {
        $error = 'Неверный логин или пароль.';
    }
} elseif (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];
}
if ($loggedInUser): ?>
    <h2><?= htmlspecialchars($loggedInUser['name']) ?></h2>
    <p>e-mail: <a href="mailto:<?= htmlspecialchars($loggedInUser['email']) ?>"><?= htmlspecialchars($loggedInUser['email']) ?></a></p>
    <p>сумма на счете: <?= htmlspecialchars($loggedInUser['amount']) ?> руб</p>
    <a href="?logout=1"><button>Выйти</button></a>
<?php else: ?>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Логин: <input type="text" name="login" required></label><br>
        <label>Пароль: <input type="password" name="password" required></label><br>
        <button type="submit">Войти</button>
    </form>
<?php endif; ?>
