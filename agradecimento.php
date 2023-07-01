<!DOCTYPE html>
<html lang="pt-br">
<html>

<head>
    <title>VW | Veículos e Transporte</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="assets/img/icon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>

<body>
    <header>
        <a href="index.html">
            <img src="assets/img/Logo VW.png" width="220" height="50">
        </a>
    </header>
    <div class="container">
        <h2>Muito Obrigado pela Atenção!</h2>
        <?php
            $carroComprado = isset($_GET["codCarro"]) ? $_GET["codCarro"] : "";

            $nome = $_POST["nome"] ?? "";
            $email = $_POST["email"] ?? "";
            $dataNasc = $_POST["dataNasc"] ?? "";
            $telefone = $_POST["telefone"] ?? "";
            $cnh = $_POST["cnh"] ?? "";
            $tipoCompra = $_POST["tipo"] ?? "";
            $cpf = $_POST["cpf"] ?? "";

            $marca = $_POST["marca"] ?? "";
            $modelo = $_POST["modelo"] ?? "";
            $anoFab = $_POST["anoFab"] ?? "";
            $anoMod = $_POST["anoMod"] ?? "";
            $placa = $_POST["placa"] ?? "";

            require "acesso.php";

            $pdo = mysqlconnect();
            try{
                if($carroComprado>0){
                    $sql = <<<SQL
                        INSERT INTO pedido (`nome`, `email`, `dataNascimento`, `telefone`, `cnh`, `tipoCompra`, `CarroComprado`, `CPF`, `Marca`, `Modelo`, `anoFab`, `anoMod`, `placa`)
                        VALUES (? , ?, ? , ?, ? , ?, ? , ?, ? , ?, ? , ?, ?)
                    SQL;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nome, $email, $dataNasc, $telefone, $cnh, $tipoCompra, $carroComprado, $cpf, $marca, $modelo, $anoFab, $anoMod, $placa]);
                }else{
                    $sql = <<<SQL
                        INSERT INTO analiserefinanciamento (`nome`, `email`, `dataNascimento`, `telefone`, `cnh`, `CPF`, `Marca`, `Modelo`, `anoFab`, `anoMod`, `placa`)
                        VALUES (? , ?, ? , ?, ? , ?, ? , ?, ? , ?, ?)
                    SQL;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nome, $email, $dataNasc, $telefone, $cnh, $cpf, $marca, $modelo, $anoFab, $anoMod, $placa]);
                }
            }catch(Exception $e){
                echo "<h3>Ocorreu um erro ao contabilizar sua solicitação! <br> Volte ao menu e tente novamente!</h3>";
                exit('Falha inesperada: ' . $e->getMessage());
            }
            echo "<h3>Obrigado pelo contato! <br> Aguarde que um vendedor nosso entrará em contato!</h3>";

        ?>
        <a href="index.html">Voltar ao Menu</a>
    </div>
    <footer>
        <p>Tela de confirmação de formulário VW Veículos</p>
    </footer>
</body>


</html>