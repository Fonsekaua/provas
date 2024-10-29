<?php
 function verificarSession () {

        if(isset($_SESSION['ALUNO'])){
           return $_SESSION['ALUNO'];

        }
        else if (isset($_SESSION['ADMIN'])){
            return $_SESSION['ADMIN'];

        }
    
    
}

?>

<header>
    <h1 title="<?= $_SESSION?"Deslogar da sessão": ""?>">
        <a href="<?= $_SESSION?baseUrl('actions/api/sessionOff.php'):"" ?>">
        <?= $_SESSION?verificarSession():"HOME" ?>
        </a>
    </h1>
    <nav id="nav__header">
        <li>
        <a href="<?= $_SESSION?baseUrl('/views/perfil.php'):""?>">
        Perfil
        </a>
        </li>


        <?php if(isset($_SESSION['ADMIN'])):?>
            <li>
        <a href="<?= $_SESSION?baseUrl('/views/criarProva.php'):""?>">
        Avaliações
        </a>
        </li>   
         <?php else:?>
        <li>
        <a href="<?= $_SESSION?baseUrl('/views/prova.php'):""?>">
        Avaliações
        </a>
        </li>
         <?php endif;?>      
        <li>
        <a href="<?= $_SESSION?baseUrl('/views/resultado.php'):""?>">
        Resultados
        </a>
        </li>
        
    </nav>
</header>