<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Simples;

//$caminho = '../data/output-extract';
//$arquivo = 'K3241.K03200Y0.D20709.EMPRECSV';

$caminho = './arquivos/2024';
$arquivo = 'simples.txt';
$dir = "$caminho/$arquivo";

$cnae = new Simples($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Simples finalizado.';

$caminhoFim = "../data/fim/$arquivo";
file_put_contents("{$caminhoFim}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>