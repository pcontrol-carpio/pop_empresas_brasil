<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Socio;

//$caminho = '../data/output-extract';
//$arquivo = 'K3241.K03200Y0.D20709.EMPRECSV';

$caminho = 'arquivos/marco';
$arquivo = 'SOCIO.csv';
$dir = "$caminho/$arquivo";

$cnae = new Socio($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Socio finalizado.';

$caminhoFim = "../data/fim/$arquivo";
file_put_contents("{$caminhoFim}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>