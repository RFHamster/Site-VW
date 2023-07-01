<!DOCTYPE html>
<html lang="pt-br">
<html>

<head>
    <title>Login VW</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="assets/img/icon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>

<?php
    $usuario = $_POST["username"] ?? ""; 
    $senha = $_POST["password"] ?? "";
    

    if($usuario != "" && $senha != ""){
        require "acesso.php";
        $cont = 0;
        $pdo = mysqlconnect();
        try {
            $sql = <<<SQL
                SELECT user, pass
                FROM connecty
                WHERE user = :usuario AND pass = :senha
            SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'usuario' => $usuario,
                'senha' => $senha
            ]);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
        $cont = $stmt->rowCount();
        
    }
?>
<body>
    <header>
        <a href="index.html">
            <img src="assets/img/Logo VW.png" width="220" height="50">
        </a>
    </header>
    <div class="container">
        <h2>Página de Login</h2>
        <h2>ADMIN</h2>
        <form id="formLogin" name="formLogin" action="telaLogin.php" method="post">
            <div>
                <input type="text" id="username" placeholder="Usuário" name="username" required>
            </div>
            <div>
                <input type="password" id="password" placeholder="Senha" name="password" required>
            </div>
            <div class="inp">
                <button class="btn btn-secondary" id="reset" type="reset">Limpar</button>
                <button class="btn btn-primary" id="submit" type="submit">Submeter</button>
            </div>
        </form>
        <span class = "errorMSG">
            <?php
                
                if($usuario != "" && $senha != ""){
                    if($cont > 0){
                        header("Location: indexADM.html");
                        exit; 
                    }else{  
                        echo '<p>Senha Errada</p>';
                    }
                }
            ?>
        </span>
    </div>
    <footer>
        <p>Tela de login do adiministrador VW Veículos</p>
    </footer>
</body>


</html>