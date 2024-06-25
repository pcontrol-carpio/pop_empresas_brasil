<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Socio;

//$caminho = '../data/output-extract';
//$arquivo = '';
//
//$dir = "$caminho/$arquivo";

$caminho = './arquivos/2024';
$arquivo = 'socio.txt';
$dir = "$caminho/$arquivo";

$cnae = new Socio($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Socio finalizado.';

$caminhoFim = "../data/fim/$arquivo";
file_put_contents("{$caminhoFim}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>