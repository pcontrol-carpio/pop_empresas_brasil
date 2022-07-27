<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Estabelecimento;
use PopEmpresasBrasil\LeitorArquivos;

$leitorArquivos = new LeitorArquivos('estabele');

$arquivos = $leitorArquivos->lerArquivos();
if ($arquivos) {
    foreach ($arquivos as $arquivo) {
        $cnae = new Estabelecimento($arquivo);
        $cnae->popularTabela();
    }
}

echo PHP_EOL;
echo 'Estabelecimento finalizado.';

?>