<?php

/**
 * 1 - Cadastrar as empresas
 * 2 - Cadastrar estabelecimentos
 *
 */

require "vendor/autoload.php";

use PopEmpresasBrasil\Estabelecimento;
use PopEmpresasBrasil\Socio;

//$cnae = new Estabelecimento('arquivos/estabelecimento.csv');
//$cnae->popularTabela();

$cnae = new Socio('arquivos/socio.csv');
$cnae->popularTabela();

?>