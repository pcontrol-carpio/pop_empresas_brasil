<?php

namespace PopEmpresasBrasil;

class Simples extends PopEmpresasBrasil
{

    public $tabela = 'simples';

    public $colunas = [
        'cnpj_basico',
        'opcao_pelo_simples',
        'data_opcao_pelo_simples',
        'data_exclusao_simples',
        'opcao_pelo_mei',
        'data_opcao_mei',
        'data_exclusao_mei',
    ];

    public function popularTabela()
    {
        $linhas = $this->lerCSV();
        if ($linhas) {
            $bd = new BancoDeDados();
            $bd->conectar();
            foreach ($linhas as $linha) {
                $empresa = $this->selectEmpresa($bd, $linha[0]);
                if ($empresa) {
                    $linha[1] = $this->toInt($linha[1]);
                    $linha[4] = $this->toInt($linha[4]);
                    $linha[2] = $this->formatarData($linha[2]);
                    $linha[3] = $this->formatarData($linha[3]);
                    $linha[5] = $this->formatarData($linha[5]);
                    $linha[6] = $this->formatarData($linha[6]);
                    $dados = array_combine($this->colunas, $linha);
                    $bd->insert($this->tabela, $dados);
                    $this->updateBase($bd, $empresa['id'], $dados);
                }
            }
        }
    }

    private function updateBase($bd, $empresaId, array &$data)
    {
        $query = "UPDATE base SET simples = {$data['opcao_pelo_simples']}, mei = {$data['opcao_pelo_mei']} WHERE empresa_id = {$empresaId};";
        echo $query;
        echo PHP_EOL;
        echo PHP_EOL;
        echo PHP_EOL;
        return $bd->query($query);
    }

    private function selectEmpresa(BancoDeDados $bd, string $cnpj_basico)
    {
        return $bd->select('empresa', "id, razao_social", "cnpj_basico = '" . $cnpj_basico . "'");
    }

    private function toInt($val)
    {
        if ($val == 'S' || $val == 'N') {
            if ($val == 'S') {
                return 1;
            }
            return 0;
        }
        return $val;
    }

    private function formatarData($data)
    {
        return substr($data, 0, 4);
    }
}