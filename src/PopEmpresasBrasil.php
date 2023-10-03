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
                $linha[1] = $this->trataTexto($linha[1]);
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

    private function trataTexto($txt)
    {
        $linha = substr($txt, 0, 255);

        /** Bloco do A **/
        $msg = str_replace('á', 'a', $linha);
        $msg = str_replace('Á', 'A', $msg);
        $msg = str_replace('à', 'a', $msg);
        $msg = str_replace('À', 'A', $msg);
        $msg = str_replace('â', 'a', $msg);
        $msg = str_replace('Â', 'A', $msg);
        $msg = str_replace('ã', 'a', $msg);
        $msg = str_replace('Ã', 'A', $msg);
        $msg = str_replace('ä', 'a', $msg);
        $msg = str_replace('Ä', 'A', $msg);

        /** Bloco do E **/
        $msg = str_replace('é', 'e', $msg);
        $msg = str_replace('É', 'E', $msg);
        $msg = str_replace('è', 'e', $msg);
        $msg = str_replace('È', 'E', $msg);
        $msg = str_replace('ê', 'e', $msg);
        $msg = str_replace('Ê', 'E', $msg);
        $msg = str_replace('ë', 'e', $msg);
        $msg = str_replace('Ë', 'E', $msg);

        /** Bloco do I **/
        $msg = str_replace('i', 'i', $msg);
        $msg = str_replace('í', 'i', $msg);
        $msg = str_replace('Í', 'I', $msg);
        $msg = str_replace('ì', 'i', $msg);
        $msg = str_replace('Ì', 'I', $msg);
        $msg = str_replace('î', 'i', $msg);
        $msg = str_replace('Î', 'I', $msg);
        $msg = str_replace('ĩ', 'i', $msg);
        $msg = str_replace('Ĩ', 'I', $msg);
        $msg = str_replace('ï', 'a', $msg);
        $msg = str_replace('Ï', 'I', $msg);

        /** Bloco do O **/
        $msg = str_replace('ó', 'o', $msg);
        $msg = str_replace('Ó', 'O', $msg);
        $msg = str_replace('ò', 'o', $msg);
        $msg = str_replace('Ò', 'O', $msg);
        $msg = str_replace('ô', 'o', $msg);
        $msg = str_replace('Ô', 'O', $msg);
        $msg = str_replace('õ', 'o', $msg);
        $msg = str_replace('Õ', 'O', $msg);
        $msg = str_replace('ö', 'o', $msg);
        $msg = str_replace('Ö', 'O', $msg);

        /** Bloco do U **/
        $msg = str_replace('ú', 'u', $msg);
        $msg = str_replace('Ú', 'U', $msg);
        $msg = str_replace('ù', 'u', $msg);
        $msg = str_replace('Ù', 'U', $msg);
        $msg = str_replace('û', 'u', $msg);
        $msg = str_replace('Û', 'U', $msg);
        $msg = str_replace('ũ', 'u', $msg);
        $msg = str_replace('Ũ', 'U', $msg);
        $msg = str_replace('ü', 'u', $msg);
        $msg = str_replace('Ü', 'U', $msg);

        /** Bloco do Ç **/
        $msg = str_replace('ç', 'c', $msg);
        $msg = str_replace('Ç', 'C', $msg);

        /** CARACTERES ESPECIAIS */
        $msg = str_replace('!', '', $msg);
        $msg = str_replace('@', '', $msg);
        $msg = str_replace('#', '', $msg);
        $msg = str_replace('&', '', $msg);
        $msg = str_replace('$', '', $msg);
        $msg = str_replace('%', '', $msg);
        $msg = str_replace('*', '', $msg);
        $msg = str_replace('+', '', $msg);
        $msg = str_replace('-', '', $msg);

        $msg = str_replace('<', '', $msg);
        $msg = str_replace('>', '', $msg);
        $msg = str_replace('/', '', $msg);
        $msg = str_replace(';', '', $msg);
        $msg = str_replace(',', '', $msg);
        $msg = str_replace('\\', '', $msg);

        $msg = str_replace('.', '', $msg);
        $msg = str_replace('-', '', $msg);
        $msg = str_replace('_', '', $msg);
        $msg = str_replace('(', '', $msg);
        $msg = str_replace(')', '', $msg);
        $msg = str_replace('/', '', $msg);
        $msg = str_replace('+', '', $msg);

        return trim($msg);

    }

}