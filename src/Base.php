<?php

namespace PopEmpresasBrasil;


class Base
{

    public $tabela = 'base';

    /**
     * @var int
     */
    private $estabelecimentoId;
    /**
     * @var array
     */
    private $dados;


    private $razaoSocial;
    /**
     * @var BancoDeDados
     */
    private $bd;

    public function __construct(BancoDeDados &$bd, int $estabelecimentoId, $razaoSocial, array &$dados)
    {
        $this->estabelecimentoId = $estabelecimentoId;
        $this->dados = &$dados;
        $this->razaoSocial = $razaoSocial;
        $this->bd = $bd;
    }

    public function popularTabela()
    {
        $dados = [
            'estabelecimento_id' => $this->estabelecimentoId,
            'empresa_id' => $this->dados['empresa_id'],
            'cnpj' => $this->dados['cnpj'],
            'razao_social' => $this->razaoSocial,
            'nome_fantasia' => $this->dados['nome_fantasia'],
            'situacao_cadastral' => $this->dados['situacao_cadastral'],
            'data_situacao_cadastral' => $this->dados['data_situacao_cadastral'],
            'data_inicio_atividade' => $this->dados['data_inicio_atividade'],
            'cnae_fiscal_principal' => $this->dados['cnae_fiscal_principal'],
            'bairro' => $this->dados['bairro'],
            'uf' => $this->dados['uf'],
            'municipio' => $this->dados['municipio'],
        ];

//        echo '<pre>';
//        var_dump($dados);
//        echo '</pre>';

        $this->bd->insert($this->tabela, $dados);
    }

}