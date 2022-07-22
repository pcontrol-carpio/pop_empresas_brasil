<?php

namespace PopEmpresasBrasil;

class Empresa extends PopEmpresasBrasil
{

    public $tabela = 'empresa';

    public $colunas = [
        'cnpj_basico',
        'razao_social',
        'natureza_juridica',
        'qualificacao_responsavel',
        'capital_social',
        'porte',
        'ente_federativo',
    ];

}