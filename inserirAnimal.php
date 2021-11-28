<?php
include_once 'conexao.php';

$nome = $_POST['cadNomeAnimal'];
$tipo = $_POST['cadTipoAnimal'];
$raca = $_POST['cadRacaAnimal'];
$cor = $_POST['cadCorAnimal'];



        $etec = new Etec();
        $etec->cadastrarAnimal($nome, $tipo, $raca, $cor);
 
?>