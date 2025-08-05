<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Imóvel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
    height: auto !important;
    min-height: 100vh;
    overflow-x: hidden;
    overflow-y: auto;
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 1200px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255,255,255,0.1) 10px,
                rgba(255,255,255,0.1) 20px
            );
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .form-content {
            padding: 50px;
        }

        .section {
            margin-bottom: 40px;
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .section:nth-child(1) { animation-delay: 0.1s; }
        .section:nth-child(2) { animation-delay: 0.2s; }
        .section:nth-child(3) { animation-delay: 0.3s; }
        .section:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #3498db;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, #3498db, #2980b9);
        }

        .image-upload-container {
            position: relative;
            width: 100%;
            height: 300px;
            border: 3px dashed #bdc3c7;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            overflow: hidden;
        }

        .image-upload-container:hover {
            border-color: #3498db;
            background: linear-gradient(45deg, #e3f2fd, #bbdefb);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(52, 152, 219, 0.2);
        }

        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .upload-placeholder {
            text-align: center;
            color: #95a5a6;
        }

        .upload-placeholder i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafbfc;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-1px);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
        }

        .characteristics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .char-item {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 15px;
            border-radius: 12px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .char-item:hover {
            border-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(52, 152, 219, 0.15);
        }

        .char-item label {
            font-size: 0.9rem;
            color: #5a6c7d;
            margin-bottom: 5px;
            text-transform: capitalize;
        }

        .char-item input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
        }

        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .resource-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .resource-item:hover {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            transform: translateX(5px);
        }

        .resource-item input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
            accent-color: #3498db;
        }

        .resource-item label {
            font-size: 0.95rem;
            color: #34495e;
            cursor: pointer;
            text-transform: capitalize;
            margin: 0;
        }

        .textarea-container {
            position: relative;
        }

        .form-textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 1rem;
            font-family: inherit;
            resize: vertical;
            min-height: 120px;
            background: #fafbfc;
            transition: all 0.3s ease;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .submit-container {
            text-align: center;
            padding: 30px 0;
            border-top: 1px solid #e1e8ed;
            margin-top: 30px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(52, 152, 219, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(52, 152, 219, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .main-info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 768px) {
            .main-info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .characteristics-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
            
            .resources-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .form-content {
                padding: 20px;
            }
        }

        .required {
            color: #e74c3c;
        }

        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.85rem;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-home"></i> Cadastro de Imóvel</h1>
            <p>Preencha as informações do seu imóvel com cuidado e precisão</p>
        </div>

        <form class="needs-validation" method="POST" action="<?= URL_BASE ?>imovel/adicionarImovelProprietario" enctype="multipart/form-data">
            <input type="hidden" name="id_proprietario" value="<?= $_SESSION['tipo_id'] ?>">
            
            <div class="form-content">
                <!-- Seção Principal -->
                <div class="section">
                    <h2 class="section-title"><i class="fas fa-info-circle"></i> Informações Principais</h2>
                    <div class="main-info-grid">
                        <div class="image-upload-container" onclick="document.getElementById('url_foto_imovel').click()">
                            <img id="img-preview" class="image-preview" style="display: none;" alt="Preview">
                            <div id="upload-placeholder" class="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p><strong>Clique para adicionar foto</strong></p>
                                <p>JPG, PNG ou GIF (máx. 10MB)</p>
                            </div>
                            <input type="file" id="url_foto_imovel" name="url_foto_imovel" accept="image/*" style="display: none;">
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nome_imovel">Nome do Imóvel <span class="required">*</span></label>
                                <input type="text" name="nome_imovel" class="form-control" id="nome_imovel" required placeholder="Ex: Apartamento Vista Mar">
                            </div>

                            <div class="form-group">
                                <label for="tipo_anuncio_imovel">Tipo do Anúncio <span class="required">*</span></label>
                                <select name="tipo_anuncio_imovel" id="tipo_anuncio_imovel" class="form-control form-select" required>
                                    <option value="" selected disabled>Selecione o tipo</option>
                                    <option value="Venda">🏷️ Venda</option>
                                    <option value="Aluguel">🏠 Aluguel</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_tipo_imovel">Tipo do Imóvel <span class="required">*</span></label>
                                <select name="id_tipo_imovel" id="id_tipo_imovel" class="form-control form-select" required>
                                    <option value="" selected disabled>Selecione o tipo</option>
                                    <option value="1">🏢 Apartamento</option>
                                    <option value="2">🏡 Casa</option>
                                    <option value="3">🏠 Kitnet</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="valor_imovel">Valor (R$) <span class="required">*</span></label>
                                <input type="number" name="preco_imovel" class="form-control" required step="0.01" min="100" placeholder="0,00">
                            </div>

                            <div class="form-group">
                                <label for="endereco_imovel">Endereço <span class="required">*</span></label>
                                <input type="text" name="endereco_imovel" class="form-control" id="endereco_imovel" required placeholder="Rua, Avenida...">
                            </div>

                            <div class="form-group">
                                <label for="bairro_imovel">Bairro <span class="required">*</span></label>
                                <input type="text" name="bairro_imovel" class="form-control" id="bairro_imovel" required placeholder="Nome do bairro">
                            </div>

                            <div class="form-group">
                                <label for="cep_imovel">CEP <span class="required">*</span></label>
                                <input type="text" name="cep_imovel" class="form-control" id="cep_imovel" required placeholder="00000-000">
                            </div>

                            <div class="form-group">
                                <label for="estado_imovel">Estado <span class="required">*</span></label>
                                <input type="text" name="estado_imovel" class="form-control" id="estado_imovel" required placeholder="Ex: São Paulo">
                            </div>

                            <div class="form-group">
                                <label for="complemento_imovel">Complemento</label>
                                <input type="text" name="complemento_imovel" class="form-control" id="complemento_imovel" placeholder="Apto, Bloco, etc.">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Características -->
                <div class="section">
                    <h2 class="section-title"><i class="fas fa-list-ul"></i> Características do Imóvel</h2>
                    <div class="characteristics-grid">
                        <?php
                        $camposQtd = [
                            "quartos" => "🛏️",
                            "suites" => "🛁",
                            "banheiros" => "🚿",
                            "salas" => "🛋️",
                            "cozinhas" => "🍳",
                            "varandas" => "🌅",
                            "lavanderias" => "👕",
                            "escritorios" => "💼",
                            "despensas" => "📦",
                            "closets" => "👗",
                            "piscinas" => "🏊",
                            "churrasqueiras" => "🔥",
                            "saloes_festas" => "🎉",
                            "playgrounds" => "🎪",
                            "academias" => "💪",
                            "saunas" => "♨️",
                            "cinema" => "🎬",
                            "espacos_gourmet" => "🍽️",
                            "bibliotecas" => "📚",
                            "espacos_pets" => "🐕",
                            "elevadores" => "🛗",
                            "vagas_garagem" => "🚗",
                            "jardins" => "🌿",
                            "hall_social" => "🏛️",
                            "depositos" => "📦"
                        ];
                        foreach ($camposQtd as $campo => $emoji) {
                            $label = ucfirst(str_replace('_', ' ', $campo));
                            echo '<div class="char-item">
                                <label>' . $emoji . ' ' . $label . '</label>
                                <input type="number" name="qtd_' . $campo . '" class="form-control" min="0" value="0">
                              </div>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Recursos -->
                <div class="section">
                    <h2 class="section-title"><i class="fas fa-shield-alt"></i> Recursos e Acessibilidade</h2>
                    <div class="resources-grid">
                        <?php
                        $recursos = [
                            "cameras_seguranca" => "📹",
                            "cerca_eletrica" => "⚡",
                            "portaria_24h" => "🏢",
                            "interfone" => "📞",
                            "wifi" => "📶",
                            "paineis_solares" => "☀️",
                            "gerador_emergencia" => "🔋",
                            "rampa_acesso" => "♿",
                            "banheiro_acessivel" => "🚻",
                            "sinalizacao_braile" => "👆"
                        ];
                        foreach ($recursos as $recurso => $emoji) {
                            $label = ucfirst(str_replace('_', ' ', $recurso));
                            echo '<div class="resource-item">
                                <input type="checkbox" name="possui_' . $recurso . '" value="1" id="' . $recurso . '">
                                <label for="' . $recurso . '">' . $emoji . ' ' . $label . '</label>
                              </div>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="section">
                    <h2 class="section-title"><i class="fas fa-file-alt"></i> Descrição Detalhada</h2>
                    <div class="textarea-container">
                        <textarea name="descricao_imovel" class="form-textarea" id="descricao_imovel" rows="6" placeholder="Descreva seu imóvel de forma detalhada. Mencione localização, acabamentos, vista, proximidade a comércios, transporte público, etc. Uma boa descrição atrai mais interessados!" required></textarea>
                    </div>
                </div>

                <!-- Botão de Envio -->
                <div class="submit-container">
                    <button class="btn-submit" type="submit">
                        <i class="fas fa-plus-circle"></i> Criar Anúncio
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Preview da imagem
        document.getElementById('url_foto_imovel').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('img-preview');
                    const placeholder = document.getElementById('upload-placeholder');
                    
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        // Máscara para CEP
        document.getElementById('cep_imovel').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/^(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });

        // Animação suave para as seções
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeIn 0.6s ease-out forwards';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section').forEach(section => {
            observer.observe(section);
        });

        // Validação em tempo real
        document.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
            field.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.style.borderColor = '#27ae60';
                } else {
                    this.style.borderColor = '#e74c3c';
                }
            });
        });

        // Formatação do valor monetário
        document.querySelector('input[name="preco_imovel"]').addEventListener('input', function(e) {
            let value = parseFloat(e.target.value);
            if (!isNaN(value)) {
                // Adicionar formatação se necessário
            }
        });

        // Efeito de hover nos checkboxes
        document.querySelectorAll('.resource-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (e.target.tagName !== 'INPUT') {
                    const checkbox = this.querySelector('input[type="checkbox"]');
                    checkbox.checked = !checkbox.checked;
                }
            });
        });

        // Animação no submit
        document.querySelector('.btn-submit').addEventListener('click', function(e) {
            // Validação básica antes do envio
            const form = document.querySelector('form');
            if (!form.checkValidity()) {
                e.preventDefault();
                
                // Scrollar para o primeiro campo inválido
                const firstInvalid = form.querySelector(':invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            } else {
                // Animação de sucesso
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Criando...';
                this.disabled = true;
            }
        });
    </script>
</body>
</html>