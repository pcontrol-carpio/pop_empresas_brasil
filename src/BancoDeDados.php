<?php

namespace PopEmpresasBrasil;

class BancoDeDados
{

    private $conexao;

    public function conectar()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->conexao = mysqli_connect(
                $GLOBALS['config']['SERVIDOR'],
                $GLOBALS['config']['USUARIO'],
                $GLOBALS['config']['SENHA'],
                $GLOBALS['config']['BANCO'],
            );
            mysqli_set_charset($this->conexao, 'utf8mb4');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function __destruct()
    {
        $this->conexao->close();
    }

    public function query($query)
    {
        try {
            $this->conexao->query($query);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function select($tabela, $colunas = '*', $where)
    {
        $sql = "SELECT $colunas FROM $tabela WHERE $where";
        $result = $this->conexao->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function insert(string $tabela, array &$dados)
    {
        if (!$dados) {
            return false;
        }
        $colunas = implode(',', array_keys($dados));
        $valores = '';
        foreach (array_values($dados) as $valor) {
            $valor = trim($valor);
            if (!is_string($valor)) {
                $valores .= $valor;
            } else {
                $valores .= '\'' . $valor . '\'';
            }
            $valores .= ',';
        }
        $valores = substr($valores, 0, -1);
        $query = "INSERT INTO $tabela ({$colunas}) VALUES ({$valores});";
        echo $query;
        echo PHP_EOL;
        echo PHP_EOL;
        echo PHP_EOL;
        try {
            $this->conexao->real_query($query);
            return (int)$this->conexao->insert_id;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function prepararInsertEmMassa(array $registros)
    {
        $query = '';
        foreach ($registros as $registro) {
            $query .= '( ';
            foreach ($registro as $item) {
                $query .= '\'' . $item . '\',';
            }
            $query = substr($query, 0, -1);
            $query .= '),';
        }
        return substr($query, 0, -1);
    }

    public function insertMassa(string $tabela, array $colunas, string $query)
    {
        $colunas = implode(',', $colunas);
        $query = "INSERT INTO {$tabela} ({$colunas}) VALUES {$query};";
        echo $query;
        echo PHP_EOL;
        echo '<hr>';
        try {
            $this->conexao->real_query($query);
            return (int)$this->conexao->insert_id;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}