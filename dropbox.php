<?php

  require __DIR__.'/vendor/autoload.php';

  use Spatie\Dropbox\Client as dropboxClient;

$token = "";

$drop_box = new DropboxClient($token);

//Cria uma nova pasta
$drop_box->createFolder("/TimeB/timeInfra");

/**
 * metodos de upload:
 * add: manda um arquivo novo
 * overwrite: sobrescrever um arquivo já existente
 */

//UPLOAD NA RAIZ DO DROPBOX
// $drop_box->upload('/README.txt', file_get_contents(__DIR__.'/upload/README.txt'), 'add');

//UPLOAD NA PASTA T.I
$drop_box->upload('TimeA/timeTI/membros-time-infra.txt', file_get_contents(__DIR__.'/upload/membros-time-infra.txt'), 'add');

//Move uma bastaqueesta dentro de outra pasta
$drop_box->move('TimeB/timeInfra','/TimeA/timeInfra');

$lista = $drop_box->listFolder('/TimeA/TimeTI');

$timeTI = $lista['entries'][0];
$path_display = $timeTI['path_display'];

$linkTemp = $drop_box->getTemporaryLink($path_display);
var_dump($linkTemp);