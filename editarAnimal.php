<?php

$nome = $_POST['nomeEquipe'];
$cargo = $_POST['cargoEquipe'];
$atividade = $_POST['atividadeEquipe'];
$titulacao = $_POST['titulacaoEquipe'];
$id = $_POST['id'];





if (isset($_POST["editar"])) {
    $editar = "editar";
    include 'conexao.php';
    $etec = new Etec();
    $etec->excluirEditarAnimal($editar, $id, $nome, $cargo, $atividade, $titulacao);
} else if (isset($_POST["excluir"])) {
    $excluir = "excluir";
    include 'conexao.php';
    $etec = new Etec();
    $etec->excluirEditarAnimal($excluir, $id, $nome, $cargo, $atividade, $titulacao);
}
?>