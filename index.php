<?php

require "vendor/autoload.php";

use PopEmpresasBrasil\Cnae;

$cnae = new Cnae('arquivos/cnaes_rf.csv');
$cnae->popularTabela();

?>