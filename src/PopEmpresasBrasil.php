<?php

namespace PopEmpresasBrasil;

class PopEmpresasBrasil implements PopEmpresasBrasilInterface
{

    public $arquivo;

    public function __construct(string $arquivo)
    {
        $this->arquivo = $arquivo;
    }

    public function popularTabela()
    {
        $linhas = $this->lerCSV();
        if ($linhas) {
            $bd = new BancoDeDados();
            $bd->conectar();
            foreach ($linhas as $linha) {
                $razao = substr($linha[1], 0, 255);
                $razao = str_replace(',', '', $razao);
                $linha[1] = $razao;
                $registros = array_combine($this->colunas, $linha);
                $bd->insert($this->tabela, $registros);
            }
        }
    }

    public function lerCSV()
    {
        $leitorCSV = new LeitorCSV($this->arquivo);
        return $leitorCSV->lerArquivo();
    }

}