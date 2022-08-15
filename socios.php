<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Socio;

$dir = '../data/output-extract/';
//$dir = 'arquivos/K3241.K03200Y9.D20709.SOCIOCSV';

$cnae = new Socio($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Sócio finalizado.';
file_put_contents("{$dir}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>