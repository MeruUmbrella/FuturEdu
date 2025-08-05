<div class="card">
    <div class="card-header">
        <h3 class="card-title">Adicionar Novo Proprietário</h3>
    </div>
    <div class="card-body">
        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>
        <form action="<?= URL_BASE ?>proprietario/adicionar" method="POST" enctype="multipart/form-data">

            <div class="form-group mb-3">
                <label for="foto_proprietario">Foto (opcional)</label>
                <input type="file" id="foto_proprietario" name="foto_proprietario" class="form-control" accept="image/*">
            </div>

            <div class="form-group mb-3">
                <label>Nome</label>
                <input type="text" name="nome_proprietario" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email_proprietario" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Senha</label>
                <input type="password" name="senha_proprietario" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>CEP</label>
                <input type="text" name="cep_proprietario" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Endereço</label>
                <input type="text" name="endereco_proprietario" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Complemento</label>
                <input type="text" name="complemento_proprietario" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Bairro</label>
                <input type="text" name="bairro_proprietario" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Estado</label>
                <input type="text" name="estado_proprietario" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Documento de Identidade</label>
                <input type="text" name="doc_identidade_proprietario" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>CPF</label>
                <input type="text" name="cpf_proprietario" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="<?= URL_BASE ?>proprietario/listar" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
