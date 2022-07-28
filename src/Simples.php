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
        $limite = 5;
        $registros = [];
        $contador = 0;
        $linhas = $this->lerCSV();
        if ($linhas) {
            $bd = new BancoDeDados();
            $bd->conectar();
            foreach ($linhas as $linha) {
                $linha[1] = $this->toInt($linha[1]);
                $linha[4] = $this->toInt($linha[4]);
                $linha[2] = $this->formatarData($linha[2]);
                $linha[3] = $this->formatarData($linha[3]);
                $linha[5] = $this->formatarData($linha[5]);
                $linha[6] = $this->formatarData($linha[6]);
                $registros[] = $linha;
                $contador++;
                if ($contador == $limite) {
                    $query = $bd->prepararInsertEmMassa($registros);
                    $bd->insertMassa($this->tabela, $this->colunas, $query);
                    $registros = [];
                    $contador = 0;
                }
            }
        }
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
        $ano = substr($data, 0, 4);
        $mes = substr($data, 4, 2);
        $dia = substr($data, -2);
        return "$ano-$mes-$dia";
    }

}