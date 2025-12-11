<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
    $goods = [
      [
        'title' => 'Compans',
        'price' => 13000,
        'quantity' => 5,
        'discount' => 5
      ],
      [
        'title' => 'Altair',
        'price' => 15000,
        'quantity' => 15,
        'discount' => 20
      ],
      [
        'title' => 'Zevs',
        'price' => 25000,
        'quantity' => 0,
        'discount' => 11
      ],
      [
        'title' => 'Oven',
        'price' => 18000,
        'quantity' => 3,
        'discount' => 0
      ],
    ];
    function sortFullPrice($arr) {
        $filteredArr = array_filter($arr, function($item) {
            return $item['quantity'] > 0;
        });
        usort($filteredArr, function($a, $b) {
            $priceA = $a['price'] * (1 - $a['discount'] / 100);
            $priceB = $b['price'] * (1 - $b['discount'] / 100);
            return $priceA <=> $priceB;
        });
        return $filteredArr;
    }
    $sortedGoods = sortFullPrice($goods);
    echo "Отсортированный массив товаров (без отсутствующих на складе):<br>";
    foreach ($sortedGoods as $product) {
        echo "Название: ", $product['title'], ", Цена: ", $product['price'], ", Количество: ", $product['quantity'], ", Скидка: ", $product['discount'], "%<br>";
    }
    $totalTitles = count($goods);
    $totalQuantity = 0;
    $totalCost = 0;
    $minPrice = $goods[0]['price'];
    $maxPrice = $goods[0]['price'];
    $cheapestProduct = $goods[0]['title'];
    $mostExpensiveProduct = $goods[0]['title'];
    foreach ($goods as $product) {
        $totalQuantity += $product['quantity'];
        $totalCost += $product['price'] * $product['quantity'];
        
        if ($product['price'] < $minPrice) {
            $minPrice = $product['price'];
            $cheapestProduct = $product['title'];
        }
        
        if ($product['price'] > $maxPrice) {
            $maxPrice = $product['price'];
            $mostExpensiveProduct = $product['title'];
        }
    }
    echo "<br>Сводная информация о товарах:<br>";
    echo "Количество наименований товара: $totalTitles<br>";
    echo "Самый дешевый товар: $cheapestProduct ($minPrice руб.)<br>";
    echo "Самый дорогой товар: $mostExpensiveProduct ($maxPrice руб.)<br>";
    echo "Общее количество всех товаров на складе: $totalQuantity<br>";
    echo "Общая стоимость всех товаров: $totalCost руб.<br>";
    ?>
  </body>
</html>
