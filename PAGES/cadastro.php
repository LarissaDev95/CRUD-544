<?php
    require '../Classes/usuario.php';
    $usuario = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 class="titulo-pagina">CADASTRO DE USUÁRIO</h2>
    <a href="listar.php"><button>LISTAR</button></a>
    
    <form method="post">
        <input type="text" name="nome" id="" class="input-form" placeholder="Digite o seu nome.">
        <input type="email" name="email" id="" class="input-form" placeholder="Digite o seu email.">
        <input type="tel" name="telefone" id="" class="input-form" placeholder="Digite o seu telefone.">
        <input type="password" name="senha" id="" class="input-form" placeholder="Digite a sua senha.">
        <input type="password" name="confSenha" id="" class="input-form" placeholder="Confirme sua senha.">
        <input type="submit" value="CADASTRAR">
        <p>Já é cadastrado? Clique <a href="login-php">Aqui</a> para acessar.</p>
    </form>
    <?php
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $senha = $_POST['senha'];
            $confSenha = $_POST['confSenha'];

            if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha))
            {
                $usuario->conectar("crud544","localhost","root","");

                if($usuario->msgErro == "")
                {
                    if($senha == $confSenha)
                    { 
                        if($usuario->cadastrarUsuario($nome, $email, $telefone, $senha))
                        {
                            ?>
                                <div class="msg-usuario">
                                    <p>Usuário cadastrado com sucesso</p>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                                <div class="msg-usuario">
                                    <p>Usuário já cadastrado</p>
                                </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <div class="msg-usuario">
                                <p>Senha e confirmação de senha não correspondem</p>
                            </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-usuario">
                            <p>Erro de conexão com o banco.</p>
                        </div>
                    <?php
                    echo "Erro: " . $usuario->msgErro;
                }
            }
            else
            {
                ?>
                    <div class="msg-usuario">
                        <p>Preencha todos os campos!</p>
                    </div>
                <?php
            }
        }
    ?>
</body>
</html>
