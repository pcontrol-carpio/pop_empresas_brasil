<?php

namespace PopEmpresasBrasil;


class Base
{

    public $tabela = 'base';
    /**
     * @var BancoDeDados
     */
    private $bd;
    private $estabelecimentoId;
    private $dadosEmpresa;
    /**
     * @var array
     */
    private $dadosEstabelecimento;

    public function __construct(BancoDeDados &$bd, $estabelecimentoId, $dadosEmpresa, array &$dadosEstabelecimento)
    {
        $this->bd = $bd;
        $this->estabelecimentoId = $estabelecimentoId;
        $this->dadosEmpresa = $dadosEmpresa;
        $this->dadosEstabelecimento = $dadosEstabelecimento;
    }

    public function popularTabela()
    {

        $capital_social = (float)$this->dadosEmpresa['capital_social'];
        $natureza_juridica = (int)$this->dadosEmpresa['natureza_juridica'];
        $porte = (int)$this->dadosEmpresa['porte'];
        $municipio = (int)$this->dadosEstabelecimento['municipio'];
        $matriz_filial = (int)$this->dadosEstabelecimento['matriz_filial'];
        $situacao_cadastral = (int)$this->dadosEstabelecimento['situacao_cadastral'];
        $motivo_situacao_cadastral = (int)$this->dadosEstabelecimento['motivo_situacao_cadastral'];

        $dados = [
            'estabelecimento_id' => $this->estabelecimentoId,
            //empresa
            'razao_social' => $this->dadosEmpresa['razao_social'], //ok
            'natureza_juridica' => $natureza_juridica,
            'capital_social' => $capital_social,
            'porte' => $porte,
            //estabelecimento
            'empresa_id' => $this->dadosEstabelecimento['empresa_id'], //ok
            'cnpj' => $this->dadosEstabelecimento['cnpj'], //ok
            'nome_fantasia' => $this->dadosEstabelecimento['nome_fantasia'], //ok
            'cnae_fiscal_principal' => $this->dadosEstabelecimento['cnae_fiscal_principal'], //ok
            'uf' => $this->dadosEstabelecimento['uf'], //ok
            'municipio' => $municipio,
            'bairro' => $this->dadosEstabelecimento['bairro'], //ok
            'data_inicio_atividade' => $this->formatarData($this->dadosEstabelecimento['data_inicio_atividade']), //ok
            'matriz' => $matriz_filial,
            //'simples' => $this->dadosEstabelecimento['simples'], //ok
            // 'mei' => $this->dadosEstabelecimento['mei'], //ok
            'situacao_cadastral' => $situacao_cadastral,
            'data_situacao_cadastral' => $this->formatarData($this->dadosEstabelecimento['data_situacao_cadastral']), //ok
            'motivo_situacao_cadastral' => $motivo_situacao_cadastral,
        ];
        $this->bd->insert($this->tabela, $dados);
    }

    private function formatarData($data)
    {
        if ($data == null || $data == '') {
            return null;
        }
        return (int)substr($data, 0, 4);
    }

}