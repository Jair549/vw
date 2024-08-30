<?php

// Exibir erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo 'Iniciando a criação do link simbólico...<br>';

// Define os caminhos para o link simbólico
$target = realpath(__DIR__ . '/../vilavolks/storage/app/public');
$link = __DIR__ . '/storage';

// Verifica se o diretório de destino existe
if ($target === false) {
    echo 'O diretório de destino não existe!<br>';
    exit;
} else {
    echo 'Diretório de destino encontrado: ' . $target . '<br>';
}

// Verifica se o link simbólico já existe
if (file_exists($link)) {
    echo 'O link simbólico já existe!<br>';
    exit;
}

// Cria o link simbólico
if (symlink($target, $link)) {
    echo 'Link simbólico criado com sucesso!';
} else {
    echo 'Erro ao criar link simbólico!';
}