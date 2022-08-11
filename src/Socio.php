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
            $bd = new BancoDeDados();
            $bd->conectar();
            foreach ($linhas as $linha) {
                $empresa = $this->selectEmpresa($bd, $linha[0]);
                if (!is_null($empresa) && !is_null($empresa)) {
                    $linha[1] = (int)$linha[1];
                    $linha[4] = (int)$linha[4];
                    $linha[5] = $this->formatarData($linha[5]);
                    $linha[9] = (int)$linha[9];
                    $linha[10] = (int)$linha[10];
                    $dados = array_combine($this->colunas, $linha);
                    $dados['empresa_id'] = $empresa['id'];
                    $bd->insert($this->tabela, $dados);
                }
            }
        }
    }

    private function formatarData($data)
    {
        return substr($data, 0, 4);
    }

    private function selectEmpresa(BancoDeDados $bd, string $cnpj_basico)
    {
        return $bd->select('empresa', "id, razao_social", "cnpj_basico = '" . $cnpj_basico . "'");
    }


}