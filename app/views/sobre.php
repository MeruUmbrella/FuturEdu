<?php require_once('template/head.php'); ?>
<?php require_once('template/header.php'); ?>

<body id="sobre">
    <div class="overlay">


        <section class="secsobre" class="bg-gray-100 py-16">
            <div class="container mx-auto px-6 md:px-12 lg:px-24">
                <div class="text-center mb-12 caixa1 " data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Sobre Nós</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Conheça mais sobre nossa missão, valores e o que nos motiva a fazer a diferença todos os dias.
                    </p>
                </div>
                <div class="timeline">
                    <!-- <div class="linha"></div> -->
                    <div class="md:w-1/  space-y-6">
                        <div class="flex flex-col md:flex-row justify-between gap-8 text-left">
                            <!-- Quem somos -->
                            <div class="md:w-1/2 caixa2 esquerda" data-aos="fade-up" data-aos-delay="800">
                                <h3 class=" text-2xl font-semibold mb-2">Quem somos</h3>
                                <p>
                                    Somos uma equipe apaixonada por tecnologia e inovação, comprometida em entregar soluções que transformam ideias em realidade digital.
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Nosso propósito -->
                    <div class="caixa3 direita" data-aos="fade-up" data-aos-delay="1000">
                        <h3 class=" text-2xl font-semibold mb-2">Nosso propósito</h3>
                        <p>
                            Ajudar pessoas e empresas a crescerem no ambiente digital com sites rápidos, bonitos e que realmente funcionam.
                        </p>
                    </div>

                    <div class="caixa2 esquerda" data-aos="fade-up" data-aos-delay="1200">
                        <h3>Missão</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo facilis quibusdam ipsam sint distinctio veniam repellendus velit doloremque quisquam aliquam?</p>
                    </div>

                    <div class="caixa3 direita" data-aos="fade-up" data-aos-delay="600">
                        <h3>Visão</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo facilis quibusdam ipsam sint distinctio veniam repellendus velit doloremque quisquam aliquam?</p>
                    </div>
                    <div class="caixa2 esquerda " data-aos="fade-up" data-aos-delay="600">
                        <h3>Valores</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo facilis quibusdam ipsam sint distinctio veniam repellendus velit doloremque quisquam aliquam?</p>
                    </div>
                    <div class="caixa3 direita foto" data-aos="fade-up" data-aos-delay="600">
                        <h3>Nossa equipe</h3>
                        <img src="<?= URL_BASE ?>assets/img/imovel1_1.jpg" alt="">
                    </div>
                </div>
            </div>

            <!-- Botão abaixo centralizado -->

    </div>
    </div>

    </section>


    </div>
    <script src=" https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js">
    </script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/slick.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/lity.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/wow.min.js"></script>
    <script src="<?= URL_BASE; ?>assets/js/animacao.js"></script>

</body>

</html>


<?php require_once('template/footer.php'); ?>