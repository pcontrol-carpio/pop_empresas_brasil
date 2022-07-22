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
    /**
     * @var string
     */
    private $razaoSocial;


    public function __construct(int $estabelecimentoId, string $razaoSocial, array &$dados)
    {
        $this->estabelecimentoId = $estabelecimentoId;
        $this->dados = &$dados;
        $this->razaoSocial = $razaoSocial;
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
        $bd = new BancoDeDados('localhost', 'root', '1234', 'base_empresas_br');
        $bd->insert($this->tabela, $dados);
    }

}