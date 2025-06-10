<?php

require_once 'DataSearch.php';

$pdo = new PDO('mysql:host=localhost;dbname=symfony_avance_test;port=3307', 'root', 'test');

$dataSearch = new DataSearch('SELECT * FROM article');
$articles = $dataSearch->search();


foreach ($articles as $article) {
    echo $article['name'].'<br>';

    echo '-----<br><br>';
}