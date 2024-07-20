<?php
    session_start();
    require 'conexao.php';

    if(isset($_POST['create_usuario'])){
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
        $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
        $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)) : '';

        $sql = "INSERT INTO usuarios (nome, email, data_nascimento, senha) VALUES ('$nome', '$email', '$data_nascimento', '$senha')";

        $result = mysqli_query($conexao, $sql);

        if($result) {
            if (mysqli_affected_rows($conexao) > 0) {
                $_SESSION['mensagem'] = 'Usuário criado com sucesso';
            } else {
                $_SESSION['mensagem'] = 'Usuário não foi criado';
            }
        } else {
            $_SESSION['mensagem'] = 'Erro na consulta: ' . mysqli_error($conexao);
        }
        
        header('Location: index.php');
        exit;
        
    }

    if(isset($_POST['update_usuario'])){
        $usuario_ID = mysqli_real_escape_string($conexao, $_POST['usuario_ID']);

        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
        $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));

        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', data_nascimento = '$data_nascimento'";

        if(!empty($senha)){
            $sql .= ", senha='" . password_hash($senha, PASSWORD_DEFAULT) ."'";
        }

        $sql .= "WHERE id = '$usuario_ID'";

        mysqli_query($conexao, $sql);

            if (mysqli_affected_rows($conexao) > 0) {
                $_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
                header('Location: index.php');
                exit;
            } else {
                $_SESSION['mensagem'] = 'Usuário não foi atualizado';
                header('Location: index.php');
                exit;
            }
                    
    }

    if(isset($_POST['delete_usuario'])){
        $usuario_ID = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);
        //echo $usuario_ID;exit;
        $sql = "DELETE FROM usuarios WHERE id = '$usuario_ID'";

        mysqli_query($conexao, $sql);

        if(mysqli_affected_rows($conexao) > 0){
            $_SESSION['message'] = 'Usuário deletado com sucesso';
            header('location: index.php');
            exit;
        } else {
            $_SESSION['message'] = 'Usuário não foi deletado';
            header('location: index.php');
            exit;

        }
    }
?>