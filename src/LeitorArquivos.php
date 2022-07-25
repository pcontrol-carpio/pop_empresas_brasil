<?php

namespace PopEmpresasBrasil;

class LeitorArquivos
{

    /**
     * @var string
     */
    private $termo;
    /**
     * @var false|resource
     */
    private $dir;
    /**
     * @var string
     */
    private $caminho = 'arquivos/';

    public function __construct(string $termo)
    {
        $this->termo = $termo;
        $this->dir = opendir($this->caminho);
    }

    public function __destruct()
    {
        closedir($this->dir);
    }

    public function lerArquivos(): iterable
    {
        if ($this->dir) {
            while (($arquivo = readdir($this->dir)) !== false) {
                if (strpos(strtolower($arquivo), $this->termo) !== false) {
                    yield $this->caminho . $arquivo;
                }
            }
        }
    }

}