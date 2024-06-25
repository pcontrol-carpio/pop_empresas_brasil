<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Estabelecimento;

//$caminho = '../data/output-extract';
//$arquivo = 'K3241.K03200Y0.D20709.EMPRECSV';

$caminho = './arquivos/2024';
$arquivo = 'estab.txt';
$dir = "$caminho/$arquivo";

$cnae = new Estabelecimento($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'ESTABELECIMENTO finalizado.';

$caminhoFim = "../data/fim/$arquivo";
file_put_contents("{$caminhoFim}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>