<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>VW | Veículos e Transporte</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="assets/img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/styleindexADM.css">
    <script src="https://kit.fontawesome.com/3b62c538ea.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    require "acesso.php";

    $pdo = mysqlconnect();

    $cont = 0;
    $tabela = "";
    $tipo = "";
    $stmt;
    $configTela = $_GET["codTela"];
    if ($configTela == 1) {
        $tabela = "analiserefinanciamento";
    } else if ($configTela == 2) {
        $tabela = "pedido";
        $tipo = "compra";
    } else if ($configTela == 3) {
        $tabela = "pedido";
        $tipo = "troca";
    }

    if ($configTela == 1) {
        try {
            $sql = <<<SQL
                SELECT id_chamado, nome, email, dataNascimento, telefone, cnh, CPF, Marca, Modelo, anoFab, anoMod, placa
                FROM analiserefinanciamento
            SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
        $cont = $stmt->rowCount();
    } else {
        if ($tipo == "compra") {
            try {
                $sql = <<<SQL
                    SELECT id_chamado, nome, email, dataNascimento, telefone, cnh, tipoCompra, CarroComprado, CPF
                    FROM pedido
                    WHERE tipoCompra = ?
                SQL;
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$tipo]);

            } catch (Exception $e) {
                exit($e->getMessage());
            }
        } else if ($tipo == "troca") {
            try {
                $sql = <<<SQL
                    SELECT id_chamado, nome, email, dataNascimento, telefone, cnh, tipoCompra, CarroComprado, CPF, Marca, Modelo, anoFab, anoMod, placa
                    FROM pedido
                    WHERE tipoCompra = 'troca'
                SQL;
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
            } catch (Exception $e) {
                exit($e->getMessage());
            }
        }
        $cont = $stmt->rowCount();
    }
    ?>

    <header id="admin-header">
        <a class="navbar-brand" href="indexADM.html">
            <img src="assets/img/Logo VW.png" width="220" height="50">
        </a>
        <h1>Pedidos Feitos<span class="badge badge-secondary">
                <?php echo $cont; ?>
            </span></h1>
    </header>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="indexADM.html">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
        </ol>
    </nav>

    <main>
        <?php
        while ($row = $stmt->fetch()) {
            $id = htmlspecialchars($row['id_chamado']);
            $nome = htmlspecialchars($row['nome']);
            $email = htmlspecialchars($row['email']);
            $dataNascimento = htmlspecialchars($row['dataNascimento']);
            $telefone = htmlspecialchars($row['telefone']);
            $cnh = htmlspecialchars($row['cnh']);
            $CPF = htmlspecialchars($row['CPF']);
            if ($tabela != "analiserefinanciamento"){   
                $tipoCompra = htmlspecialchars($row['tipoCompra']);
                $carroComprado = htmlspecialchars($row['CarroComprado']);
            }

            if($tipo != "compra"){
                $marca = htmlspecialchars($row['Marca']);
                $modelo = htmlspecialchars($row['Modelo']);
                $anoMod = htmlspecialchars($row['anoMod']);
                $anoFab = htmlspecialchars($row['anoFab']);
                $preco = htmlspecialchars($row['placa']);
            }
            

            $carro = "";
            if ($tabela == "analiserefinanciamento"){ $carroComprado = 0;}
            if (intval($carroComprado) > 0) {
                $stmt2;
                try {
                    $sql = <<<SQL
                            SELECT marca, modelo, anoMod
                            FROM carro
                            WHERE id = ?
                        SQL;
                    $stmt2 = $pdo->prepare($sql);
                    $stmt2->execute([$carroComprado]);
                } catch (Exception $e) {
                    exit($e->getMessage());
                }
                while ($row2 = $stmt2->fetch()) {
                    $marcaCarro = htmlspecialchars($row2['marca']);
                    $modeloCarro = htmlspecialchars($row2['modelo']);
                    $anoModCarro = htmlspecialchars($row2['anoMod']);

                    $carro = $marcaCarro ." ". $modeloCarro ." ". $anoModCarro;
                }
            }

            echo <<<HTML
                <div id="admin-container">
                    <section class="admin-section">
                        <h2>Pedido $id</h2>
                        <div class="main-text">
                            <h3>Dados Cliente</h3>
                            <p>Nome: $nome</p>
                            <p>E-mail: $email</p>
                            <p>Data de Nascimento: $dataNascimento</p>
                            <p>Telefone: $telefone</p>
                            <p>CNH: $cnh</p>
                            <p>CPF: $CPF</p>
            HTML;

                if ($tabela == "analiserefinanciamento") {
                        echo <<<HTML
                            <h3>Carro Refinanciado</h3>
                            <p>Marca: $marca</p>
                            <p>Modelo: $modelo</p>
                            <p>Ano de Fabricação: $anoFab</p>
                            <p>Ano de Modelo: $anoMod</p>
                            <p>Preço: $preco</p>
                        HTML;
                }else{
                        echo <<<HTML
                            <h3>Carro Comprado</h3>
                            <p>Tipo de Compra: $tipoCompra</p>
                            <p>Carro Comprado: $carro</p>
                        HTML;
                }

                if($tabela == "pedido" && $tipo != "compra"){
                    echo <<<HTML
                            <h3>Carro Comprado</h3>
                            <p>Marca: $marca</p>
                            <p>Modelo: $modelo</p>
                            <p>Ano de Fabricação: $anoFab</p>
                            <p>Ano de Modelo: $anoMod</p>
                            <p>Preço: $preco</p>
                        HTML;
                }

            echo <<<HTML
                        </div>
                    </section>
                </div>
            HTML;
        }




        ?>

    </main>

    <footer id="admin-footer">
        <p>Tela de Pedidos VW Veículos</p>
        <a href="index.html">Voltar para a Página Principal</a>
    </footer>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>