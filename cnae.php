<?php

require "vendor/autoload.php";

use PopEmpresasBrasil\Cnae;
use PopEmpresasBrasil\LeitorArquivos;

$leitorArquivos = new LeitorArquivos('cnae');

$arquivos = $leitorArquivos->lerArquivos();
if ($arquivos) {
    foreach ($arquivos as $arquivo) {
        $cnae = new Cnae($arquivo);
        $cnae->popularTabela();
    }
}

echo PHP_EOL;
echo 'CNAE finalizado.';

?>