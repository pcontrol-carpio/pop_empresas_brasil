<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Empresa;

//$caminho = '../data/output-extract';
//$arquivo = '';

$caminho = './arquivos/2024';
$arquivo = 'emp.txt';

$dir = "$caminho/$arquivo";

$cnae = new Empresa($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Empresa finalizado.';

/*
$caminhoFim = "../data/fim/$arquivo";
file_put_contents("{$caminhoFim}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);
*/
?>