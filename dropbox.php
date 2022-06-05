<?php

require __DIR__.'/vendor/autoload.php';
use Spatie\Dropbox\Client as dropboxClient;

$token = "insira seu token do dropbox";
$drop_box = new DropboxClient($token);

//Lista os arquivos na raiz do projeto
$raiz_projeto = $drop_box->listFolder('/');

//captura itens
$pastas = $raiz_projeto['entries'];

//nome da nova pasta a ser criada
$name_nova_pasta = 'TimeE';

//controle
$if_exist = false;

//percorre os itens
for ($i=0; $i < sizeof($pastas) ; $i++) {
  //verifica se existe alguma pasta com o nome da minha nova pasta
  if ($pastas[$i]['.tag'] == 'folder' && $pastas[$i]['name'] == $name_nova_pasta) {
    //se sim, sinaliza minha variavel de controle e fializa o for
    $if_exist = true;
    break;
  }
}

//confere minha variavel de controle e cria a pasta ou sinaliza que ela já existe
if ($if_exist == false) {
    $drop_box->createFolder('/'.$name_nova_pasta);
    print_r("Arquivo Criado!");
} else {
    print_r("Arquivo já existente!");
}



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
