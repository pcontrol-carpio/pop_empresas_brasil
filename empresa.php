<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Empresa;

//$dir = '../data/output-extract/K3241.K03200Y0.D20709.EMPRECSV';
$dir = 'arquivos/K3241.K03200Y0.D20709.EMPRECSV';

$cnae = new Empresa($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Empresa finalizado.';

file_put_contents("{$dir}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>