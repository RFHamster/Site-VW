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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styleCat.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.html">
                <img src="assets/img/Logo VW.png" width="220" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="#navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="comprar.php">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="refinanciar.html">Refinanciar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="atendimento.html">Atendimento</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
        </ol>
    </nav>

    <main>
        <section class="serviços">
            <div class="margin">
                <h2>CATÁLOGO</h2>
            </div>
            <div class="container-fluid vender text-center margin">
                <div class="container">
                    <div class="row">
                        <?php
                        require "acesso.php";
                        $pdo = mysqlConnect();

                        try {
                            $sql = <<<SQL
                                        SELECT id, marca, modelo, anoMod, preco, caminhoIMG, descricao
                                        FROM carro
                                    SQL;
                            $stmt = $pdo->query($sql);
                        } catch (Exception $e) {
                            exit($e->getMessage());
                        }

                        while ($row = $stmt->fetch()) {
                            $id = htmlspecialchars($row['id']);
                            $marca = htmlspecialchars($row['marca']);
                            $modelo = htmlspecialchars($row['modelo']);
                            $anoMod = htmlspecialchars($row['anoMod']);
                            $preco = htmlspecialchars($row['preco']);
                            $caminhoIMG = htmlspecialchars($row['caminhoIMG']);
                            $descricao = htmlspecialchars($row['descricao']);

                            $stringH = "formCompra.php?codProd=" . $id;
                            echo <<<HTML
                                    <div class="col-md-4">
                                        <div class="content">
                                            <a href="$stringH">
                                                <img src="$caminhoIMG" width="320" height="280">
                                                <h4>$marca $modelo $anoMod</h4>
                                                <h5>R$ $preco</h5>
                                                <h5>$descricao</h5>
                                            </a>
                                        </div>
                                    </div>
                                    HTML;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <footer class="container-fluid bg-footer marginb">
        <div class="container-fluid marginb">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5>COMPRAR OU VENDER</h5>
                        <h6><a href="comprar.php">Carros usados ou seminovos</a></h6>
                        <h6><a href="comprar.php">Motos usadas ou seminovas</a></h6>
                        <h6><a href="comprar.php">Vender o seu veículo</a></h6>
                    </div>
                    <div class="col-md-3">
                        <h5>SERVIÇOS</h5>
                        <h6>
                            <a href="comprar.php">Trocar o seu carro</a>
                        </h6>
                        <h6>
                            <a href="refinanciar.html">Refinanciar</a>
                        </h6>
                        <h6>
                            <a href="telaLogin.php">Página do ADM</a>
                        </h6>
                    </div>
                    <div class="col-md-3">
                        <h5>AJUDA</h5>
                        <h6>
                            <a href="atendimento.html">Atendimento</a>
                        </h6>
                        <h6>
                            <a href="atendimento.html">Como comprar</a>
                        </h6>
                        <h6>
                            <a href="atendimento.html">Como vender</a>
                        </h6>
                        <h6>
                            <a href="atendimento.html">Sobre nós</a>
                        </h6>
                        <a href="http://www.planalto.gov.br/ccivil_03/leis/l8078compilado.htm" target="_blank">
                            <h6>Código de Defesa do Consumidor</h6>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <h5>PARCEIROS</h5>
                        <h6>
                            <a href="https://www.omni.com.br/" target="_blank">
                                Omni Financeira
                            </a>
                        </h6>
                        <h6>
                            <a href="https://www.bv.com.br/" target="_blank">
                                BV Financeira
                            </a>
                        </h6>
                        <h6>
                            <a href="https://www.bancopan.com.br/" target="_blank">
                                Pan Financeira
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>