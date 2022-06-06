<?php

require __DIR__.'/vendor/autoload.php';
use Spatie\Dropbox\Client as dropboxClient;

$token = "";
$drop_box = new DropboxClient($token);

//Lista os arquivos na raiz do projeto
$raiz_projeto = $drop_box->listFolder('/');

//captura itens
$pastas = $raiz_projeto['entries'];

//nome da nova pasta a ser criada
$name_nova_pasta = 'TimeF';

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
    $return = $drop_box->createFolder('/'.$name_nova_pasta);
    print_r("Pasta Criado! ");
} else {
    print_r("Pasta já existente! ");
}

//UPLOAD NA RAIZ DO DROPBOX
// $drop_box->upload('/README.txt', file_get_contents(__DIR__.'/upload/README.txt'), 'add');

//UPLOAD em subpastas
$metadata = $drop_box->upload('TimeF/timeF.txt', file_get_contents(__DIR__.'/upload/timeF.txt'), 'add');

//passar um nome de pasta/arquivo
$arquivo_busca = 'timeX.txt';
//Executa a pesquisa
$search = $drop_box->search($arquivo_busca);
//retorna true se o array e busca estiver vazio
if(empty($search["matches"])) {
  print_r('Nenhum arquivo encontrado!');
} else {
  var_dump($search);
}




//Move uma bastaqueesta dentro de outra pasta
// $drop_box->move('TimeB/timeInfra','/TimeA/timeInfra');

// $lista = $drop_box->listFolder('/TimeA/TimeTI');

// $timeTI = $lista['entries'][0];
// $path_display = $timeTI['path_display'];

// $linkTemp = $drop_box->getTemporaryLink($path_display);
// var_dump($linkTemp);
