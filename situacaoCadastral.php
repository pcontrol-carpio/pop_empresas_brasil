<?php

require "vendor/autoload.php";
require "config.php";

$bd = new \PopEmpresasBrasil\BancoDeDados();
$bd->conectar();

for ($i = 1; $i <= 10; $i++) {
    $base = $bd->select('base', 'id, estabelecimento_id, situacao_cadastral', "situacao_cadastral IS NULL LIMIT 1");
    if ($base) {
        $estabelecimento = $bd->select('estabelecimento', 'situacao_cadastral', " id = {$base['estabelecimento_id']} ");
        if ($estabelecimento) {
            $situacao_cadastral = $estabelecimento['situacao_cadastral'];
            $query = "UPDATE base SET situacao_cadastral = '{$situacao_cadastral}' WHERE id = {$base['id']};";
            echo $query;
            echo PHP_EOL;
            $bd->query($query);
        }
    }
}
