<?php

namespace PopEmpresasBrasil;

class Estabelecimento extends PopEmpresasBrasil
{

    public $tabela = 'estabelecimento';

    public $colunas = [
        'cnpj_basico',
        'cnpj_ordem',
        'cnpj_dv',
        'matriz_filial',
        'nome_fantasia',
        'situacao_cadastral',
        'data_situacao_cadastral',
        'motivo_situacao_cadastral',
        'nome_cidade_exterior',
        'pais',
        'data_inicio_atividade',
        'cnae_fiscal_principal',
        'cnae_fiscal_secundaria',
        'tipo_logradouro',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'uf',
        'municipio',
        'ddd_1',
        'telefone1',
        'ddd_2',
        'telefone2',
        'ddd_fax',
        'fax',
        'correio_eletronico',
        'situacao_especial',
        'data_situacao_especial',
    ];

    public function popularTabela()
    {
        $linhas = $this->lerCSV();
        if ($linhas) {
            $bd = new BancoDeDados();
            $bd->conectar();
            foreach ($linhas as $linha) {
                if (!is_null($linha[0]) && !empty($linha[0])) {
                    $empresa = $this->selectEmpresa($bd, $linha[0]);
                    if (!is_null($empresa) && !empty($empresa) && count($linha) == 30) {

                        $dadosEstabelecimento = array_combine($this->colunas, $linha);
                        $dadosEstabelecimento['cnpj'] = $linha[0] . $linha[1] . $linha[2];
                        $dadosEstabelecimento['empresa_id'] = !is_null($empresa) ? $empresa['id'] : null;

                        $razaoSocial = !is_null($empresa) ? $empresa['razao_social'] : null;
                        if (empty($linha[4]) || is_null($linha[4])) {
                            $dadosEstabelecimento['nome_fantasia'] = $razaoSocial;
                        }

                        $estabelecimentoId = $bd->insert($this->tabela, $dadosEstabelecimento);
                        $this->popularTabelaBase($bd, $estabelecimentoId, $empresa, $dadosEstabelecimento);
                    }
                }
            }
        }
    }

    private function selectEmpresa(BancoDeDados $bd, string $cnpjBasico)
    {
        $colunas = "id, razao_social, natureza_juridica, capital_social, porte ";
        return $bd->select('empresa', $colunas, "cnpj_basico = '" . $cnpjBasico . "'");
    }

    private function popularTabelaBase(BancoDeDados $bd, $estabelecimentoId, $empresa, array &$dadosEstabelecimento)
    {
        $base = new Base($bd, $estabelecimentoId, $empresa, $dadosEstabelecimento);
        $base->popularTabela();
    }

}