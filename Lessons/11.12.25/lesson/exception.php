<?php
try {
    $a = 5;
    $b = 0;
    $result = $a / $b;
    if (!$b) {
        throw new TypeError("На 0 незя");
    }
    if (!is_numeric($a) or !is_numeric($b)) {
        throw new TypeError("Нет чисел 😛");
    }
    echo $result;
    echo '<br>', 'SYBAU💔';   
} catch (DivisionByZeroError $ex) {
    echo "Йо, Дивизия 0: {$ex->getMessage()}";
} catch (TypeError $ex) {
    echo "Тип ошибки: {$ex->getMessage()}";
}
?>