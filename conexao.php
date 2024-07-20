<?php
    define('SERVIDOR', 'LOCALHOST');
    define('USUARIO', 'root');
    define('SENHA', '');
    define('DB', 'praticando_crud');

    $conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
?>