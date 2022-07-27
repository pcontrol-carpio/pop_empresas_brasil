<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Empresa;
use PopEmpresasBrasil\LeitorArquivos;

$leitorArquivos = new LeitorArquivos('empre');

$arquivos = $leitorArquivos->lerArquivos();
if ($arquivos) {
    foreach ($arquivos as $arquivo) {
        $cnae = new Empresa($arquivo);
        $cnae->popularTabela();
    }
}

echo PHP_EOL;
echo 'Empresa finalizado.';

?>