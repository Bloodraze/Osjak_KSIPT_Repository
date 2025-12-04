<?php
// Трейт для геттеров приватных свойств
trait AdGetters {
    private function getPropertyValue(string $propertyName) {
        $reflection = new ReflectionObject($this);
        while ($reflection) {
            if ($reflection->hasProperty($propertyName)) {
                $property = $reflection->getProperty($propertyName);
                $property->setAccessible(true);
                return $property->getValue($this);
            }
            $reflection = $reflection->getParentClass();
        }
        return null; // Если свойство не найдено
    }

    public function getHead() {
        return $this->getPropertyValue('head');
    }

    public function getText() {
        return $this->getPropertyValue('text');
    }

    public function getData() {
        return $this->getPropertyValue('data');
    }

    public function getViews() {
        return $this->getPropertyValue('views');
    }
}




// Класс Ad
class Ad {
    use AdGetters;

    private $head;
    private $text;
    private $data;
    private $views;

    public function __construct($head, $text, $data = null, $views = 0) {
        $this->head = $head;
        $this->text = $text;
        $this->data = $data ?: date('Y-m-d');
        $this->views = $views;
    }

    public function printAd() {
        echo "<h3>{$this->head}</h3>";
        echo "<p>{$this->text}</p>";
    }
}


// Класс ImgAd
class ImgAd extends Ad {
    use AdGetters;

    private $img;

    public function __construct($head, $text, $img, $data = null, $views = 0) {
        parent::__construct($head, $text, $data, $views);
        $this->img = $img;
    }

    public function printAd() {
        parent::printAd();
        if ($this->img) {
            echo "<img src='" . htmlspecialchars($this->img) . "' alt='Изображение' style='max-width: 300px; height: auto;'>";
        }
        echo "<br><small>Дата: " . htmlspecialchars($this->getData()) . " | Просмотры: " . $this->getViews() . "</small>";
    }

    public function getImg() {
        return $this->img;
    }
}



// Класс BoldAd
class BoldAd extends ImgAd {
    use AdGetters;

    public function printAd() {
        echo "<hr>";
        echo "<h3><strong>" . htmlspecialchars($this->getHead()) . "</strong></h3>";
        echo "<p><strong>" . htmlspecialchars($this->getText()) . "</strong></p>";
        if ($this->getImg()) {
            echo "<img src='" . htmlspecialchars($this->getImg()) . "' alt='Изображение' style='max-width: 300px; height: auto;'>";
        }
        echo "<br><small><strong>Дата: " . htmlspecialchars($this->getData()) . " | Просмотры: " . $this->getViews() . "</strong></small>";
    }
}


// Функция для загрузки объявлений из JSON
function loadAds() {
    if (file_exists('ads.json')) {
        $json = file_get_contents('ads.json');
        $adsArray = json_decode($json, true);
        return createObjectsFromArray($adsArray);
    }
    return [];
}


// Функция для создания объектов из массива
function createObjectsFromArray($adsArray) {
    $objAds = [];
    foreach ($adsArray as $adData) {
        $head = $adData['head'] ?? '';
        $text = $adData['text'] ?? '';
        $data = $adData['data'] ?? '';
        $views = $adData['views'] ?? 0;
        $img = $adData['img'] ?? '';
        $bold = $adData['bold'] ?? 0;

        if (empty($img)) {
            $objAds[] = new Ad($head, $text, $data, $views);
        } elseif ($bold) {
            $objAds[] = new BoldAd($head, $text, $img, $data, $views);
        } else {
            $objAds[] = new ImgAd($head, $text, $img, $data, $views);
        }
    }
    return $objAds;
}


// Функция для сохранения в JSON
function saveAds($objAds) {
    $adsArray = [];
    foreach ($objAds as $ad) {
        $adData = [
            'head' => $ad->getHead(),
            'text' => $ad->getText(),
            'data' => $ad->getData(),
            'views' => $ad->getViews()
        ];

        if ($ad instanceof ImgAd) {
            $adData['img'] = $ad->getImg();
        }
        if ($ad instanceof BoldAd) {
            $adData['bold'] = 1;
        }

        $adsArray[] = $adData;
    }
    file_put_contents('ads.json', json_encode($adsArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}


// Основная логика
$objAds = loadAds();

// Обработка удаления
if (isset($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    if (isset($objAds[$index])) {
        array_splice($objAds, $index, 1);
        saveAds($objAds);
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Обработка добавления
if ($_POST && isset($_POST['head']) && isset($_POST['text'])) {
    $head = trim($_POST['head']);
    $text = trim($_POST['text']);
    $img = trim($_POST['img'] ?? '');

    if (!empty($head) && !empty($text)) {
        if (!empty($img)) {
            $objAds[] = new ImgAd($head, $text, $img);
        } else {
            $objAds[] = new Ad($head, $text);
        }
        saveAds($objAds);
    }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Доска объявлений</title>
</head>
<body>
    <h1>Доска объявлений</h1>

    <!-- Форма добавления -->
    <div class="form">
        <h2>Добавить объявление</h2>
        <form method="POST">
            <input type="text" name="head" placeholder="Заголовок" maxlength="100" required>
            <textarea name="text" placeholder="Текст объявления" rows="3" required></textarea>
            <input type="text" name="img" placeholder="URL изображения (необязательно)">
            <button type="submit">Добавить</button>
        </form>
    </div>

    <!-- Список объявлений -->
    <?php foreach ($objAds as $index => $ad): ?>
        <div class="ad">
            <?php $ad->printAd(); ?>
            <br><a href="?delete=<?= $index ?>" class="delete" onclick="return confirm('Удалить объявление?')">Удалить</a>
        </div>
    <?php endforeach; ?>

    <?php if (empty($objAds)): ?>
        <p>Объявлений пока нет. Добавьте первое!</p>
    <?php endif; ?>
</body>
</html>
