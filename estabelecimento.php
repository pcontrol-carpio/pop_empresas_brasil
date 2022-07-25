<?php

require "vendor/autoload.php";

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

?>