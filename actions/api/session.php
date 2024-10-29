<?php 
session_start();
include "../db_actions.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $dados = json_decode(file_get_contents("php://input"),true);
    $tabela = $dados['tabela'];
    $nome = $dados['nome'];
    if($tabela == "professores"){ 
        $_SESSION['ADMIN'] = $nome;
        $session  = true;
        $mensagem = "Sessão ADMIN " . $_SESSION['ADMIN'] . " feita com sucesso";
    }
    else if($tabela == "alunos"){ 
        $_SESSION['ALUNO'] = $nome;
        $session  = true;
        $mensagem = "Sessão ALUNO " . $_SESSION['ALUNO'] . " feita com sucesso";
    }
    else {
        $session = false;
        $mensagem = 'não foi possivel fazer sessão...';
    }



    echo json_encode([
        "session" => $session,
        "mensagem" => $mensagem
    ]);
}