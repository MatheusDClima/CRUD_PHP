<?php 
    session_start();
    require('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Editar Usuário</title>
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                            if(isset($_GET['id'])){
                            $usuario_ID = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM usuarios WHERE id='$usuario_ID'";
                            $query = mysqli_query($conexao, $sql);

                            if(mysqli_num_rows($query) > 0){

                            $usuario = mysqli_fetch_array($query);

                        ?>
                        <form action="acoes.php" method="POST">
                            <input type="hidden" name="usuario_ID" value="<?=$usuario_ID?>">
                            <div class="mb-3">
                                <label class="form-label" for="nomeUsuario">Nome</label>
                                <input type="text" name="nome" value="<?= $usuario['nome'] ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>E-Mail</label>
                                <input type="email" name="email" value="<?= $usuario['email'] ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Data de Nascimento</label>
                                <input type="date" name="data_nascimento" value="<?= $usuario['data_nascimento'] ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Senha</label>
                                <input type="password" name="senha" class="form-control">
                            </div>
                            <div class="mb-3">
                              <button type="submit" name="update_usuario" class="btn btn-primary">Atualizar</button>
                            </div>
                          
                        </form>
                        <?php 
                            }
                            else{
                                echo "<h5>Usuário não encontrado</h5>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>