<?php
session_start();
include __DIR__ . "/../actions/baseUrl.php" ;
include __DIR__ . "/../actions/db.php" ;
include __DIR__ . "/../actions/db_actions.php" ;

$alunos = selecionarTabela('alunos');
$professores = selecionarTabela('professores');

foreach($alunos as $aluno){
    if(isset($_SESSION['ALUNO'])){
        if($_SESSION['ALUNO']== $aluno['nome']){
            $id = $aluno['id__aluno'];
            echo $id;
            break;
         }
    }
}
foreach($professores as $profesor){
    if(isset($_SESSION['ADMIN'])){
        if($_SESSION['ADMIN']== $profesor['nome']){
             $id = $profesor['id__professor'];
             echo $id;
            break;
         }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CURSOS</title>
    <link rel="stylesheet" href="<?= $css??""?>">
    <link rel="stylesheet" href="<?= $alternativeCSS??""?>">
</head>
<body>
    <?php include "header.php"?>
    <main>
        <?php include $content;?>
    </main>
    <?php include "footer.php"?>
</body>
<script src="<?= $js??""?>"></script>
<script src="<?= $alternativeJS??""?>"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</html>