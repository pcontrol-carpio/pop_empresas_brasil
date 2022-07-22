<?php

namespace PopEmpresasBrasil;

class Socio extends PopEmpresasBrasil
{

    public $tabela = 'socio';

    public $colunas = [
        'cnpj_basico',
        'identificador_socio',
        'nome_socio',
        'cnpj_cpf_socio',
        'qualificacao_socio',
        'data_entrada_sociedade',
        'pais',
        'representante_legal',
        'nome_representante',
        'qualificacao_representante_legal',
        'faixa_etaria',
    ];

    public function popularTabela()
    {
        $linhas = $this->lerCSV();
        if ($linhas) {
            $bd = new BancoDeDados('localhost', 'root', '1234', 'base_empresas_br');
            foreach ($linhas as $linha) {
                $empresa = $this->selectEmpresa($bd, $linha[0]);
                $dados = array_combine($this->colunas, $linha);
                $dados['empresa_id'] = $empresa['id'];
                $bd->insert($this->tabela, $dados);
            }
        }
    }

    private function selectEmpresa(BancoDeDados $bd, string $cnpj_basico)
    {
        return $bd->select('empresa', "id, razao_social", "cnpj_basico = '" . $cnpj_basico . "'");
    }


}