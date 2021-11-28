<?php

$nome = $_POST['nomeEquipe'];
$cargo = $_POST['cpfEquipe'];
$atividade = $_POST['telEquipe'];
$titulacao = $_POST['endEquipe'];
$id = $_POST['id'];





if (isset($_POST["editar"])) {
    $editar = "editar";
    include 'conexao.php';
    $etec = new Etec();
    $etec->excluirEditarAdotante($editar, $id, $nome, $cargo, $atividade, $titulacao);
} else if (isset($_POST["excluir"])) {
    $excluir = "excluir";
    include 'conexao.php';
    $etec = new Etec();
    $etec->excluirEditarAdotante($excluir, $id, $nome, $cargo, $atividade, $titulacao);
}
?>