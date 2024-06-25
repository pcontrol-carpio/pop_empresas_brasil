<?php

require "vendor/autoload.php";
require "config.php";

use PopEmpresasBrasil\BancoDeDados;

$bd = new BancoDeDados();
$bd->conectar();

update($bd);

function emMassa($bd)
{
    while (true) {
        update($bd);
    }
}

function update($bd)
{
    $base = $bd->select('base', 'id, cnpj, mei, simples', 'mei is null');

    var_dump($base);
    exit;

    if (is_null($base)) {
        echo 'FIM';
        exit;
    }

    $cnpj_base = substr($base['cnpj'], 0, 8);

    $simpleMei = $bd->select('simples', 'opcao_pelo_simples, opcao_pelo_mei', "cnpj_basico = '$cnpj_base' ");

    $simples = 0;
    $mei = 0;
    if (!is_null($simpleMei)) {
        $simples = $simpleMei['opcao_pelo_simples'];
        $mei = $simpleMei['opcao_pelo_mei'];
    }

    $query = "UPDATE base SET mei = '{$mei}', simples = '{$simples}' WHERE id = {$base['id']};";
    echo $query;
    echo PHP_EOL;
    $bd->query($query);
}

