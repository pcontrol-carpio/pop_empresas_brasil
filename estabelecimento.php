<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Estabelecimento;

$dir = 'arquivos/K3241.K03200Y4.D20709.ESTABELE';

$cnae = new Estabelecimento($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Estabelecimento finalizado.';

file_put_contents("{$dir}.txt", "{$dir} - Finalizado em: " . date('d/m/Y H:i:s'), FILE_APPEND);

?>