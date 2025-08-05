<?php require_once('template/head.php'); ?>

<body>
    
    <div class="banner_img">
        <?php require_once('template/header.php'); ?>


        <section class="banner">
            <h2>A procura de um lugar... <strong>Tanamão!</strong></h2>


            <form method="GET" action="<?= URL_BASE ?>Imovel">
                <div class="filtro-container">
                    <input type="text" name="busca" class="filtro-input" placeholder="Digite sua pesquisa...">

                    <div class="filtro-botao-container">
                        <button type="submit" class="filtro-botao-pesq"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg></button>
                    </div>
                </div>
            </form>



        </section>

    </div>
    <section class="hero-section">

        <div class="container-main">
            <div class="content-wrapper">
                <h1 class="main-title">Comprar um imóvel para chamar de lar</h1>

                <div class="description-box">
                    <p class="subtitle">
                        Na <span class="brand-highlight">Tanamão Imóveis</span>, garantimos uma experiência segura e sem
                        complicações na compra ou venda do seu imóvel, com assessoria especializada
                        e análise detalhada de toda a documentação.
                    </p>
                </div>

                <a href="#imoveis" class="cta-button">
                    Ver Casas à Venda
                </a>
            </div>

            <div class="image-showcase">
                <div class="property-card">
                    <div class="property-image">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Casa Moderna de Luxo">

                        <div class="property-overlay">
                            <a href="#detalhe" class="overlay-button">
                                Saiba Mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="homes-section">
        <div class="container">
            <div class="section-intro">
                <p class="section-subtitle">Ofertas Especiais</p>
                <h2 class="section-title">Encontre o <span class="highlight">lar dos seus sonhos</span></h2>
                <p class="section-description">
                    Oportunidades únicas para você realizar o sonho da casa própria.
                    Imóveis selecionados com condições especiais e localização privilegiada.
                </p>
            </div>

            <div class="properties-grid">
                <?php
                $count = 0;
                foreach ($imoveis as $imovel):
                    if ($count++ >= 4) break;
                ?>
                    <div class="home-card">
                        <a href="<?= URL_BASE ?>imovel/detalhes/<?= $imovel['id_imovel'] ?>">
                            <div class="home-image">
                                <img class="home-photo" src="<?= URL_BASE ?>upload/imovel/<?= $imovel['url_foto_imovel'] ?>" alt="<?= $imovel['nome_imovel'] ?>">
                                <div class="offer-tag">Oferta</div>
                            </div>
                        </a>
                        <div class="home-content">
                            <p class="home-location"><?= htmlspecialchars($imovel['bairro_imovel']) ?></p>
                            <h3 class="home-title"><?= htmlspecialchars($imovel['nome_imovel']) ?></h3>
                            <div class="home-price">R$ <?= number_format($imovel['preco_imovel'], 2, ',', '.') ?></div>
                            <p class="home-address"><?= $imovel['endereco_imovel'] ?> - <?= $imovel['estado_imovel'] ?></p>

                            <div class="home-features">
                                <div class="feature-item">
                                    <span class="feature-icon icon-bed"></span>
                                    <span><?= $imovel['qtd_quartos'] ?? 0 ?> Quartos</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon icon-car"></span>
                                    <span><?= $imovel['qtd_vagas_garagem'] ?? 0 ?> Garagens</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon icon-shower"></span>
                                    <span><?= $imovel['qtd_suites'] ?? 0 ?> Suítes</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon icon-area"></span>
                                    <span><?= $imovel['qtd_banheiros'] ?? 0 ?> Banheiros</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>



    <section class="intereses">
        <div>
            <img src="<?= URL_BASE; ?>assets/img/imovel2_1.jpg" alt="">
            <a href="#">Comprar ou alugar em São Miguel</a>

        </div>
        <div>
            <img src="<?= URL_BASE; ?>assets/img/imovel1_2.jpg" alt="">
            <a href="#">Apartamentos em Guarulhos</a>

        </div>
        <div>
            <img src="<?= URL_BASE; ?>assets/img/imovel4_1.jpg" alt="">
            <a href="#">Casa para chamar de sua</a>

        </div>
    </section>

    <section class="contato">
        <div class="site">
            <div class="informacoes">
                <h3>Fale Conosco</h3>

                <?php if (!empty($_SESSION['msg_contato'])): ?>
                    <div class="alerta-vazio" style="color:green; font-weight:bold; margin:10px 0;">
                        <?= $_SESSION['msg_contato'];
                        unset($_SESSION['msg_contato']); ?>
                    </div>
                <?php endif; ?>

                <form style="display: contents;" method="post" action="<?= URL_BASE ?>home/enviarContato">
                    <input type="text" name="nome" placeholder="Nome" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="tel" name="telefone" placeholder="Telefone">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" placeholder="" required></textarea>
                    <button type="submit" class="btn-enviar">Enviar</button>
                </form>
            </div>
            <div class="contate">
                <h3>Nossos Contatos</h3>
                <p><a href="#">Email: tanamaoimoveis@gmail.com</a></p>
                <p><a href="#">Telefone: (55+) 11 96588-8821</a></p>
            </div>
        </div>
    </section>

    <?php require_once('template/footer.php'); ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/slick.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/lity.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/wow.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/animacao.js"></script>

</body>

</html>