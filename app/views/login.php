<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="fechar">&times;</span>
        <h2>Bem-vindo!</h2>

        <div class="tabs">
            <button id="btnLogin" class="tab-btn active">Login</button>
            <button id="btnCadastro" class="tab-btn">Cadastro</button>
        </div>

        <form id="formLogin" class="formulario" method="POST" action="login/entrar">

            <label for="email">Usuário ou E-mail</label>
            <input type="text" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
            <!-- <button type="submit">Fechar</button> -->

        </form>

        <form id="formCadastro" class="formulario" style="display: none;" method="POST" action="<?= URL_BASE ?>login/cadastrar">
            <!-- Seleção do tipo de usuário -->
            <div class="tipo-usuario" style="margin-bottom: 10px;">
                <label>
                    <input type="radio" name="tipo_usuario" value="cliente" checked> Cliente
                </label>
                <label>
                    <input type="radio" name="tipo_usuario" value="proprietario"> Proprietário
                </label>
            </div>

            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="text" name="cpf" placeholder="CPF" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>

            <button type="submit">Cadastrar</button>
        </form>

    </div>
</div>