<?php
try {
    $filename = 'animals.json';
    $jsonData = @file_get_contents($filename);
    if ($jsonData === false) {
        throw new Exception("Файл с данными '$filename' не найден(( (ToT)");
    }
    $data = json_decode($jsonData);
    if ($data === null) {
        throw new Exception("Файл с данными '$filename' повреждён((( (X-X)");
    }
    echo 'Всё в порядке!))) (^w^)';
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>