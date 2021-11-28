<?php
include_once 'conexao.php';

$nome = $_POST['nomeEquipe'];
$cpf = $_POST['cpfEquipe'];
$tel = $_POST['telEquipe'];
$end = $_POST['endEquipe'];


        $etec = new Etec();
        $etec->cadastrarAdotante($nome, $cpf, $tel, $end);
   
        


?>