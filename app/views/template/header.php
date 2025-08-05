<header class="header">
    <div class="site_header">
        <nav class="header-menu-nav">
            <a href="<?= URL_BASE; ?>" class="homelogo">
                <div class="img_logo">

                    <img src="<?= URL_BASE; ?>assets/img/logo_nova2.1.png" alt="">

                    <p>Tanamão<br><strong>Imóveis</strong></p>

                </div>
            </a>
            <ul>
                <li class="ativo">
                    <a href="<?= URL_BASE ?>home" class="ativo">Inicio</a>
                </li>

                <li class="menu-item">

                    <a href="<?= URL_BASE ?>imovel">Comprar</a>

                </li>

                <li class="menu-item">
                    <a href="<?= URL_BASE ?>sobre" class="menu-toggle">Alugar</a>
                </li>
                <li class="menu-item">
                    <a href="<?= URL_BASE ?>sobre" class="menu-toggle">Sobre</a>
                </li>
                <li class="menu-perfil">
                    <?php if (isset($_SESSION['tipo'])): ?>
                        <div class="dropdown">
                            <a href="#">
                                <i class="bx bx-user"></i> <?= explode(' ', $_SESSION['tipo_nome'])[0]; ?> ▾
                            </a>
                            <div class="dropdown-content">
                                <a href="<?= URL_BASE ?>dash">Perfil</a>

                                <a href="<?= URL_BASE ?>login/sair">Sair</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="#" id="openLoginModal">Login</a>
                    <?php endif; ?>
                </li>

                <div id="modalContainer"></div>

            </ul>

        </nav>
    </div>
</header>