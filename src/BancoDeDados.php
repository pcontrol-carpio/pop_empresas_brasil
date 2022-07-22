<?php

namespace PopEmpresasBrasil;

class BancoDeDados
{

    private $conexao;

    public function __construct(string $servidor, string $usuario, string $senha, string $bancoDeDados)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->conexao = mysqli_connect($servidor, $usuario, $senha, $bancoDeDados);
            mysqli_set_charset($this->conexao, 'utf8mb4');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function __destruct()
    {
        $this->conexao->close();
    }

    public function insert(string $tabela, array &$dados)
    {
        if (!$dados) {
            return false;
        }
        $colunas = implode(',', array_keys($dados));
        foreach (array_values($dados) as $valor) {
            isset($valores) ? $valores .= ',' : $valores = '';
            $valores .= '\'' . $this->conexao->real_escape_string($valor) . '\'';
        }
        $query = "INSERT INTO $tabela ({$colunas}) VALUES ({$valores});";
        try {
            $this->conexao->real_query($query);
            return $this->conexao->insert_id;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}