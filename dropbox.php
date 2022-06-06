<?php

require __DIR__.'/vendor/autoload.php';
use Spatie\Dropbox\Client as dropboxClient;

$token = "Utilize seu token de desenvolvedor";
$drop_box = new DropboxClient($token);

//Lista os arquivos na raiz do projeto
$root_project = $drop_box->listFolder('/');

//captura itens
$folders = $root_project['entries'];

//nome da nova pasta a ser criada
$name_new_folder = 'TimeF';

//controle
$if_exist = false;

//percorre os itens
for ($i=0; $i < sizeof($folders) ; $i++) {
    //verifica se existe alguma pasta com o nome da nova pasta
    if ($folders[$i]['.tag'] == 'folder' && $folders[$i]['name'] == $name_new_folder) {
        //se sim, sinaliza minha variavel de controle e finaliza o for
        $if_exist = true;
        break;
    }
}

//confere var de controle e cria a pasta ou sinaliza que ela já existe
if ($if_exist == false) {
    $return = $drop_box->createFolder('/'.$name_new_folder);
    print_r("Pasta Criada! ");
} else {
    print_r("Pasta já existente! ");
}

//UPLOAD NA RAIZ DO DROPBOX
// $drop_box->upload('/README.txt', file_get_contents(__DIR__.'/upload/README.txt'), 'add');

//UPLOAD em subpastas
$metadata = $drop_box->upload('TimeF/timeF.txt', file_get_contents(__DIR__.'/upload/timeF.txt'), 'add');


function buscar_arquivo()
{
    //passar um nome de pasta/arquivo
    $arquivo_busca = 'timeX.txt';
    //Executa a pesquisa
    $search = $drop_box->search($arquivo_busca);
    //retorna true se o array e busca estiver vazio
    if (empty($search["matches"])) {
        print_r('Nenhum arquivo encontrado!');
    } else {
        print_r($search);
    }
}





//Move uma bastaqueesta dentro de outra pasta
// $drop_box->move('TimeB/timeInfra','/TimeA/timeInfra');

// $lista = $drop_box->listFolder('/TimeA/TimeTI');

// $timeTI = $lista['entries'][0];
// $path_display = $timeTI['path_display'];

// $linkTemp = $drop_box->getTemporaryLink($path_display);
// var_dump($linkTemp);
