<?php 

include "../db_actions.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $dados = json_decode(file_get_contents("php://input"),true);
    $tabela = $dados['tabela'];
    $nome = $dados['nome'];
    $email = $dados['email'];
    $senha = $dados['senha'];

    if(uploadLogin($tabela,$nome,$email,$senha)){
        $login = true;
        $mensagem = "Bem-vindo $nome !";
    
    }else{
        $login = false;
        $mensagem = "Não foi possivel fazer seu login...";
    }

    echo json_encode([
        "login" => $login,
        "mensagem" => $mensagem
    ]);
}