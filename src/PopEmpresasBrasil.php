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
            $bd = new BancoDeDados('localhost', 'root', '1234', 'base_empresas_br');
            foreach ($linhas as $linha) {
                $dados = array_combine($this->colunas, $linha);
                echo $bd->insert($this->tabela, $dados);
                echo PHP_EOL;
            }
        }
    }

    public function lerCSV()
    {
        $leitorCSV = new LeitorCSV($this->arquivo);
        return $leitorCSV->lerArquivo();
    }

}