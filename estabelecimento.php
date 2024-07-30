<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Estabelecimento;

$caminho = '../data/output-extract';
$arquivo = '';

$dir = "$caminho/$arquivo";

$cnae = new Estabelecimento($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'ESTABELECIMENTO finalizado.';

$caminhoFim = "../data/fim/$arquivo";
file_put_contents("{$caminhoFim}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>