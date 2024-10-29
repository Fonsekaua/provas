<?php 
include "../db_actions.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $dados = json_decode(file_get_contents("php://input"),true);
    $tabela = $dados['tabela'];
    $nome = $dados['nome'];
    $email = $dados['email'];
    $senha = $dados['senha'];

    if(strlen($nome)<3 || strlen($email) <= 10 || strlen($senha)<8){
        $registro = false;
        $mensagem = "Numero de caracteres minimo não alcançado!!!";
    }
    else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false ){
        $registro = false;
        $mensagem = "Email ultilizado é invalido para seu cadastro !!";
    }
    else{
        uploadRegistro($tabela,$nome,$email,$senha);
        $registro = true;
        $mensagem = "Usuario $nome cadastrado com sucesso!!";
    }

    echo json_encode([
        "registro" => $registro,
        "mensagem" => $mensagem
    ]);
}


/*
<br />
<b>Fatal error</b>:  Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'WHERE BINARY email = ?' at line 1 in C:\xampp\htdocs\cursos\actions\db_actions.php:16
Stack trace:
#0 C:\xampp\htdocs\cursos\actions\db_actions.php(16): PDO-&gt;prepare('SELECT * FROM  ...')
#1 C:\xampp\htdocs\cursos\actions\api\login.php(11): uploadLogin('professores', 'Matheus Do Grau', 'matheus@gmail.c...', '12345678')
#2 {main}
  thrown in <b>C:\xampp\htdocs\cursos\actions\db_actions.php</b> on line <b>16</b><br />

*/