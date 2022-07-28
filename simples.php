<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\LeitorArquivos;
use PopEmpresasBrasil\Simples;

$leitorArquivos = new LeitorArquivos('simples');
$arquivos = $leitorArquivos->lerArquivos();

if ($arquivos) {
    foreach ($arquivos as $arquivo) {
        $cnae = new Simples($arquivo);
        $cnae->popularTabela();
    }
}

?>