<?php
    include ("conexao/conexao.php");
    session_start();
    if(isset($_SESSION["logado"])) header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php
        if(!isset($_GET["q"])) $_GET["q"] = "none";
        if($_GET["q"] == "wrong") echo '<span id="senha-errada">Senha ou usuario incorreto! Tente Novamente</span>';
        if($_GET["q"] == "register")
        {
            echo '';
        }
        if($_GET["q"] == "attempt")
        {
            $username = $_POST["nome"];
            $senha = password_hash($_POST["senha"], PASSWORD_BCRYPT);
            $cache = mysqli_query($conexaoSQL, "SELECT * FROM `players` WHERE nome = '$username' AND senha = '$senha'");
            if(mysqli_num_rows($cache))
            {
                $result = mysqli_fetch_array($cache);
                $_SESSION["usuario"] = $username;
                $_SESSION["logado"] = true;
                $_SESSION["admin"] = $result["adminlevel"];
                $_SESSION["funcao"] = $result["funcaoadmin"];
                $_SESSION["fxcoins"] = $result["fxcoins"];
                $_SESSION["acountid"] = $result["acountid"];
                $_SESSION["cpf"] = $result["result"];
                $_SESSION["idade"] = $result["idade"];
                $_SESSION["dinheiro"] = $result["dinheiro"];
                $_SESSION["bancoid"] = $result["banco"];
                $_SESSION["dinheirobanco"] = $result["dinheirobanco"];
                $_SESSION["sexo"] = $result["sexo"];
                $_SESSION["vida"] = $result["vida"];
                $_SESSION["organizacao"] = $result["org"];
                $_SESSION["ultimologin"] = $result["ultimologin"];
                echo "Você Logou com sucesso! Acesse <a href='./perfil.php'>Sua Conta</a> Para Ver mais status de seu personagem!";
            }
        }
        else
        {
            echo '
            <main>
                <h1>Tela de Login FLUXORJ</h1><br>
                <div class="tlogin">
                    <form method="post" action="login.php?q=attempt">
                        <Label>Usuario:</Label>
                        <input type="text" placeholder="Insira seu usuario..." name="nome" maxlength="24" minlength="4" class="les">
                        <Label>Senha:</Label>
                        <input type="password" placeholder="Insira sua senha..." name="senha" maxlength="14" minlength="4" class="les">
                        <input type="submit" value="Entrar" id="entrar">
                    </form>
                    <p>Case nao tenha uma conta <br> voce pode <a href="">se registrar</a></p>
                </div>
            </main>';
        }
    ?>
</body>
</html>