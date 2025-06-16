<?php

use App\Search\DataSearch;
use Symfony\Component\Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env', __DIR__.'/.env.local');

$dataSearch = new DataSearch('SELECT * FROM article');
$articles = $dataSearch->search();


\App\Debug\DebugTool::dump($articles);
\App\Debug\DebugTool::dump('dgffdg');


foreach ($articles as $article) {
    echo $article['name'].'<br>';

    echo '-----<br><br>';
}