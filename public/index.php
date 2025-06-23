<?php

use App\Search\DataSearch;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

require_once '../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env', __DIR__.'/../.env.local');

// récupération articles
/*$dataSearch = new DataSearch('SELECT * FROM article');
$articles = $dataSearch->search();


foreach ($articles as $article) {
    echo $article['name'].'<br>';

    echo '-----<br><br>';
}*/


$transport = Transport::fromDsn($_ENV['MAILER_DSN']);
$mailer = new Mailer($transport);


/*$email = new Email()
    ->from('hello@example.com')
    ->to('you@example.com')
    ->subject('Time for Symfony Mailer!')
    ->html('<p>See Twig integration for better HTML integration!</p>');

$mailer->send($email);*/

$email = new Email();
$email->to('pilloud.anthony@gmail.com');
$email->from('hello@example.com');

$email->subject('Mon sujet');
$email->text('test');

$mailer->send($email);

