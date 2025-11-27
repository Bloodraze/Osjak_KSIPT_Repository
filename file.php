<?php
$text = file_get_contents("texts/text.txt");
if(!is_dir('texts1')){
    mkdir("texts1");
}
file_put_contents('texts1/test1.txt', $text .'word');
echo file_get_contents('texts1/test1.txt');
?>