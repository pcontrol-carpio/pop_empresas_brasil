<?php

namespace PopEmpresasBrasil;

class LeitorCSV
{

    private $arquivo;
    private $separador;

    public function __construct(string $arquivo, $separador = ';')
    {
        if (!file_exists($arquivo)) {
            echo('Arquivo não encontrado.');
            exit;
        }
        $extension = explode('.', $arquivo);
        if (end($extension) !== 'csv') {
            echo('Arquivo não possui a extensção CSV.');
            exit;
        }
        $this->arquivo = fopen($arquivo, 'r');
        $this->separador = $separador;
    }

    public function lerArquivo(): iterable
    {
        while (!feof($this->arquivo)) {
            yield fgetcsv($this->arquivo, null, $this->separador);
        }
    }

    public function __destruct()
    {
        if (is_resource($this->arquivo)) {
            fclose($this->arquivo);
        }
    }

}