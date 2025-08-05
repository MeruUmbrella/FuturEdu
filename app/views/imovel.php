<?php require_once('template/head.php'); ?>

<?php require_once('template/header.php'); ?>

<body class="pgcomprar">

    <section class="secfiltro">
        <div class="site-filtro">
            <div class="infofiltro">
                <form id="filtroForm" method="GET" action="<?= URL_BASE ?>imovel">
                    <div class="filtro-barra">

                        <!-- Localização (fictício por enquanto) -->
                        <div class="icone-local">
                            📍 <span>Qualquer lugar em São Paulo, SP</span>
                        </div>

                        <!-- Dropdown COMPRAR -->
                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuTipo')">Comprar</div>
                            <div class="dropdown-menu" id="menuTipo">
                                <a href="<?= URL_BASE ?>Imovel" class="botao">Todos</a>
                                <a href="<?= URL_BASE ?>Imovel?tipo=aluguel" class="botao">Alugar</a>
                                <a href="<?= URL_BASE ?>Imovel?tipo=venda" class="botao">Comprar</a>
                            </div>
                        </div>

                        <!-- Simulações dos demais botões com dropdowns -->
                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuValor')">Valor do imóvel</div>
                            <div class="dropdown-menu" id="menuValor">
                                <button name="valor" value="0-10000000">Até R$ 1.000</button>
                                <button name="valor" value="1000-5000">R$ 1.000 - R$ 5.000</button>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuCondominio')">Condomínio + IPTU</div>
                            <div class="dropdown-menu" id="menuCondominio">
                                <button name="condominio" value="sim">Simular</button>
                                <button name="condominio" value="nao">Ignorar</button>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuTipoImovel')">Tipos de imóvel</div>
                            <div class="dropdown-menu" id="menuTipoImovel">
                                <button name="tipo_imovel" value="apartamento">Apartamento</button>
                                <button name="tipo_imovel" value="casa">Casa</button>
                                <button name="tipo_imovel" value="kitnet">Kitnet</button>

                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuQuartos')">1+ quartos</div>
                            <div class="dropdown-menu" id="menuQuartos">
                                <button name="quartos" value="1">1+ quarto</button>
                                <button name="quartos" value="2">2+ quartos</button>
                                <button name="quartos" value="3">3+ quartos</button>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuVagas')">Vagas de garagem</div>
                            <div class="dropdown-menu" id="menuVagas">
                                <button name="vagas" value="1">1 vaga</button>
                                <button name="vagas" value="2">2 vagas</button>
                                <button name="vagas" value="3">3+ vagas</button>
                            </div>
                        </div>


                        <div class="dropdown">
                            <div class="dropdown-button" onclick="toggleDropdown('menuComodidade')">Comodidade</div>
                            <div class="dropdown-menu" id="menuComodidade">
                                <button type="submit" name="piscina_imovel" value="1">Piscina</button>
                                <button type="submit" name="academia_imovel" value="1">Academia</button>
                                <button type="submit" name="salao_festas_imovel" value="1">Salão de Festas</button>
                                <button type="submit" name="churrasqueira_imovel" value="1">Churrasqueira</button>
                                <button type="submit" name="quadra_esportes_imovel" value="1">Quadra de Esportes</button>
                                <button type="submit" name="espaco_gourmet_imovel" value="1">Espaço Gourmet</button>
                                <button type="submit" name="brinquedoteca_imovel" value="1">Brinquedoteca</button>
                                <button type="submit" name="playground_imovel" value="1">Playground</button>
                                <button type="submit" name="portaria_24h_imovel" value="1">Portaria 24h</button>
                                <button type="submit" name="seguranca_imovel" value="1">Segurança</button>
                                <button type="submit" name="bicicletario_imovel" value="1">Bicicletário</button>
                                <button type="submit" name="elevador_imovel" value="1">Elevador</button>
                                <button type="submit" name="vaga_visitante_imovel" value="1">Vaga para Visitante</button>
                                <button type="submit" name="gerador_energia_imovel" value="1">Gerador de Energia</button>
                            </div>
                        </div>


                        <!-- Botões de ações -->
                        <button type="button" class="filtro-botao">Mais filtros</button>
                        <button type="button" class="filtro-botao">🔔 Criar alerta de imóvel</button>

                    </div>
                </form>


                <script>
                    function toggleDropdown(id) {
                        const dropdowns = document.querySelectorAll('.dropdown-menu');
                        dropdowns.forEach(menu => {
                            if (menu.id === id) {
                                menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
                            } else {
                                menu.style.display = 'none';
                            }
                        });
                    }

                    // Fecha dropdowns ao clicar fora
                    window.addEventListener('click', function(e) {
                        if (!e.target.classList.contains('dropdown-button')) {
                            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                                menu.style.display = 'none';
                            });
                        }
                    });
                </script>

            </div>


            <!-- Filtros aplicados aparecem aqui -->
            <div id="filtrosAtivos" class="flex flex-wrap gap-2 mt-4 px-4"></div>



    </section>
    <section class="secimoveis">
        <div class="site">
            <div class="insertimovel">

                <?php if (!empty($mensagem)): ?>
                    <div class="alerta-vazio" style="color:red; font-weight:bold; margin:20px 0;">
                        <?= $mensagem ?>
                    </div>
                <?php endif; ?>

                <?php
                // Supondo que $favoritos é um array com ids de imóveis favoritados pelo cliente logado
                $favoritos = $favoritos ?? [];
                ?>

                <?php foreach ($imoveis as $linha): ?>
                    <?php
                    $link = $this->gerarLinkImovel($linha['id_imovel'], $linha['nome_imovel']);
                    $isFavorito = in_array($linha['id_imovel'], $favoritos);
                    ?>

                    <div class="cartao-imovel">
                        <!-- ÍCONE DE FAVORITAR -->
                        <a href="#" class="btn-favorito" onclick="favoritarImovel(event, '<?= $linha['id_imovel'] ?>', <?= $isFavorito ? 'true' : 'false' ?>)">
                            <?php if ($isFavorito): ?>
                                <i class="fas fa-heart"></i>
                            <?php else: ?>
                                <i class="far fa-heart"></i>
                            <?php endif; ?>
                        </a>

                        <!-- Toast de notificação -->
                        <div id="toast-favorito" class="toast-favorito" style="display:none;">
                            <i class="fas fa-heart"></i> <span id="toast-msg"></span>
                        </div>

                        <!-- IMAGEM -->
                        <img src="<?= URL_BASE ?>upload/imovel/<?= $linha['url_foto_imovel'] ?>" alt="<?= $linha['nome_imovel']; ?>">

                        <!-- INFORMAÇÕES DO IMÓVEL -->
                        <div class="prop">
                            <div class="imovel-info">
                                <div class="info-item">
                                    <i class="bi bi-house-door-fill"></i>
                                    <span class="info-text"><?= $linha['nome_imovel']; ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="bi bi-tag-fill"></i>
                                    <span class="info-text"><?= $linha['tipo_anuncio_imovel']; ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span class="info-text"><?= $linha['endereco_imovel']; ?></span>
                                </div>
                                <div class="info-item preco">
                                    <i class="bi bi-currency-dollar"></i>
                                    <span class="info-text preco-valor">R$ <?= number_format($linha['preco_imovel'], 2, ',', '.'); ?></span>
                                </div>
        
                            </div>
                        </div>

                        <!-- BOTÃO VER MAIS -->
                        <a href="<?= URL_BASE ?>imovel/detalhe/<?= $link ?>" class="overlay">Ver Mais</a>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </section>




    <?php require_once('template/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/slick.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/lity.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/wow.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/animacao.js"></script>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filtrosAtivosContainer = document.getElementById("filtrosAtivos");

        // Recupera os parâmetros da URL
        const urlParams = new URLSearchParams(window.location.search);

        // Mostra os filtros já ativos ao carregar
        urlParams.forEach((valor, nome) => {
            mostrarFiltro(nome, valor);
        });

        // Ao clicar em um filtro (botão)
        document.querySelectorAll(".dropdown-menu button").forEach((botao) => {
            botao.addEventListener("click", function(e) {
                e.preventDefault();

                const nome = this.name;
                const valor = this.value;

                // Atualiza os parâmetros da URL
                urlParams.set(nome, valor);
                atualizarURL(urlParams);
            });
        });

        // Cria e mostra o filtro aplicado visualmente
        function mostrarFiltro(nome, valor) {
            const tag = document.createElement("div");
            tag.className = "bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm flex items-center gap-2";
            tag.innerHTML = `
                ${nome.replace(/_/g, ' ')}: <strong>${valor}</strong>
                <button type="button" class="text-orange-600 font-bold" data-remove="${nome}">×</button>
            `;
            filtrosAtivosContainer.appendChild(tag);

            // Botão para remover filtro
            tag.querySelector(`[data-remove='${nome}']`).addEventListener("click", () => {
                urlParams.delete(nome);
                atualizarURL(urlParams);
            });
        }

        // Redireciona com os filtros atualizados
        function atualizarURL(params) {
            const novaURL = window.location.pathname + '?' + params.toString();
            window.location.href = novaURL;
        }
    });
</script>


<style>
    #filtrosAtivos div {
        display: inline-flex;
        align-items: center;
        background: #fef3c7;
        color: #92400e;
        padding: 5px 10px;
        border-radius: 20px;
        margin-right: 8px;
        margin-bottom: 8px;
        font-size: 14px;
    }

    #filtrosAtivos button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        margin-left: 6px;
    }
    
</style>

<script>
function favoritarImovel(e, idImovel, isFavorito) {
    e.preventDefault();
    var toast = document.getElementById('toast-favorito');
    var msg = document.getElementById('toast-msg');
    msg.innerText = isFavorito ? 'Removido dos favoritos!' : 'Adicionado aos favoritos!';
    toast.style.display = 'flex';
    toast.classList.add('show');
    setTimeout(function() {
        toast.classList.remove('show');
        toast.style.display = 'none';
        window.location.href = '<?= URL_BASE ?>/favorito/toggle/' + idImovel;
    }, 1200);
}
</script>