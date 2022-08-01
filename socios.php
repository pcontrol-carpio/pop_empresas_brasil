<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\Socio;

$dir = 'arquivos/K3241.K03200Y9.D20709.SOCIOCSV';

$cnae = new Socio($dir);
$cnae->popularTabela();

echo PHP_EOL;
echo 'Sócio finalizado.';

?>