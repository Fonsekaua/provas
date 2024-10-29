<?php 
include "db.php";
function selecionarTabela($nome){
    global $pdo;
    $consulta = $pdo->query("SELECT * FROM $nome");
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function uploadLogin($tabela, $nome, $email, $senha) {
    global $pdo;

    // Consulta SQL para selecionar o usuário com verificação sensível a maiúsculas/minúsculas
    // Corrigido: Removido o segundo "WHERE"
    $consulta = "SELECT * FROM $tabela WHERE BINARY nome = :nome AND BINARY email = :email";

    // Preparar a consulta
    $db = $pdo->prepare($consulta);
    
    // Associar os parâmetros ":nome" e ":email" com as respectivas variáveis
    $db->bindParam(":nome", $nome);
    $db->bindParam(":email", $email);
    
    // Executar a consulta
    $db->execute();
    
    // Verificar se o usuário foi encontrado
    if ($db->rowCount() > 0) {
        // Buscar o registro do usuário
        $usuarioData = $db->fetch(PDO::FETCH_ASSOC);

        // Verificar se a senha fornecida corresponde ao hash armazenado
        if (password_verify($senha, $usuarioData['senha'])) {
            // Senha correta, retorna os dados do usuário
            return $usuarioData;
        } else {
            // Senha incorreta
            return false;
        }
    } else {
        // Usuário não encontrado
        return false;
    }
}



function uploadRegistro($tabela,$nome,$email,$senha) {
    global $pdo; // Usa a conexão global com o banco de dados

    // Criptografa a senha usando bcrypt
    $senhaCripto = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara a consulta SQL para inserir o usuário e a senha criptografada
    $consulta = "INSERT INTO $tabela (nome, email, senha) VALUES (:nome, :email, :senha)";
    $db = $pdo->prepare($consulta);

    // Vincula os parâmetros da consulta
    $db->bindParam(":nome", $nome);
    $db->bindParam(":email", $email);
    $db->bindParam(":senha", $senhaCripto);

    // Executa a consulta
    $db->execute();

    // Retorna TRUE se pelo menos uma linha foi inserida, FALSE se não
    return $db->rowCount() > 0;
}
