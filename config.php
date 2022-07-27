<?php

$dir = ".config";
if (file_exists($dir)) {
    $config = [];
    $lines = file($dir, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $explode = explode('=', $line);
        $config[$explode[0]] = $explode[1];
    }
    global $config;
} else {
    die('Arquivo de configuração não encontrado.');
}