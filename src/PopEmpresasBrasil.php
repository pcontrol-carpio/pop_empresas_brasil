<?php

namespace PopEmpresasBrasil;

use PopEmpresasBrasil\BancoDeDados;

class PopEmpresasBrasil implements PopEmpresasBrasilInterface
{

    public $arquivo;

    public function __construct(string $arquivo)
    {
        $this->arquivo = $arquivo;
    }

    public function popularTabela()
    {
        $limite = 10;
        $registros = [];
        $contador = 0;
        $linhas = $this->lerCSV();
        if ($linhas) {
            $bd = new BancoDeDados();
            $bd->conectar();
            foreach ($linhas as $linha) {
                $registros[] = $linha;
                $contador++;
                if ($contador == $limite) {
                    $query = $bd->prepararInsertEmMassa($registros);
                    $bd->insertMassa('empresa', $this->colunas, $query);
                    $registros = [];
                    $contador = 0;
                }
            }
        }
    }

    public function lerCSV()
    {
        $leitorCSV = new LeitorCSV($this->arquivo);
        return $leitorCSV->lerArquivo();
    }

}