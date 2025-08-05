<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100vh;
            padding: 2rem;
            position: relative; /* importante para o posicionamento absoluto do botão sair */
        }

        h1 {
            margin-bottom: 2.5rem;
            font-weight: 600;
            color: #343a40;
        }

        .btn-opcao {
            width: 220px;
            height: 220px;
            border-radius: 1.25rem;
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            color: white;
            margin: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-opcao i {
            font-size: 4.5rem;
            margin-bottom: 0.75rem;
        }

        .btn-perfil {
            background: linear-gradient(45deg, #0095ad, #00f2fe);
        }

        .btn-favoritos {
            background: linear-gradient(45deg, #e78a4d, #f1b715);
        }

        .btn-opcao:hover, .btn-opcao:focus {
            transform: translateY(-6px);
            box-shadow: 0 18px 36px rgba(0, 0, 0, 0.25);
            text-decoration: none;
            outline: none;
        }

        .btn-voltar {
            margin-top: 2rem;
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }

        .btn-sair {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            z-index: 1000;
        }

        @media (max-width: 576px) {
            .btn-opcao {
                width: 150px;
                height: 150px;
                font-size: 1rem;
            }

            .btn-opcao i {
                font-size: 3rem;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- Botão de sair no topo direito -->
    <a href="<?= URL_BASE ?>home" class="btn btn-danger btn-sair">
        <i class="bi bi-box-arrow-right"></i> Sair
    </a>

    <div class="d-flex justify-content-center flex-wrap">
        <a href="<?= URL_BASE ?>cliente/perfilCliente" class="btn-opcao btn-perfil" role="button" aria-label="Meu Perfil">
            <i class="bi bi-person-circle" aria-hidden="true"></i>
            Meu Perfil
        </a>
        <a href="<?= URL_BASE ?>cliente/meusFavoritos" class="btn-opcao btn-favoritos" role="button" aria-label="Favoritos">
            <i class="bi bi-bookmark-heart" aria-hidden="true"></i>
            Favoritos
        </a>
    </div>

    <div class="row mt-5">
        <?php
        if (isset($conteudo)) {
            $this->carregarViews($conteudo, $dados);
        } else {
            echo '<h2>Bem-vindo ào seu Perfil!</h2>';
        }
        ?>
    </div>
</body>

</html>
