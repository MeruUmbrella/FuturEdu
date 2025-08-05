<div class="card">
    <div class="card-header">
        <h3 class="card-title">Editar Proprietário</h3>
    </div>
    <div class="card-body">
    <form action="<?= URL_BASE ?>proprietario/editar/<?= $proprietario['id_proprietario'] ?>" method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
        <div class="col-md-4">
            <label>Foto Atual</label><br>
            <img id="img-form" src="<?= URL_BASE ?>upload/proprietario/<?= $proprietario['foto_proprietario'] ?>" alt="Foto do Proprietário" style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
        </div>
        <div class="col-md-8">
            <label for="foto_proprietario">Nova Foto (opcional)</label>
            <input type="file" id="foto_proprietario" name="foto_proprietario" class="form-control" accept="image/*">
        </div>
    </div>


            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome_proprietario" class="form-control" value="<?= $proprietario['nome_proprietario'] ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email_proprietario" class="form-control" value="<?= $proprietario['email_proprietario'] ?>" required>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha_proprietario" class="form-control" value="<?= $proprietario['senha_proprietario'] ?>" required>
            </div>

            <div class="form-group">
                <label>CEP</label>
                <input type="text" name="cep_proprietario" class="form-control" value="<?= $proprietario['cep_proprietario'] ?>">
            </div>

            <div class="form-group">
                <label>Endereço</label>
                <input type="text" name="endereco_proprietario" class="form-control" value="<?= $proprietario['endereco_proprietario'] ?>">
            </div>

            <div class="form-group">
                <label>Complemento</label>
                <input type="text" name="complemento_proprietario" class="form-control" value="<?= $proprietario['complemento_proprietario'] ?>">
            </div>

            <div class="form-group">
                <label>Bairro</label>
                <input type="text" name="bairro_proprietario" class="form-control" value="<?= $proprietario['bairro_proprietario'] ?>">
            </div>

            <div class="form-group">
                <label>Estado</label>
                <input type="text" name="estado_proprietario" class="form-control" value="<?= $proprietario['estado_proprietario'] ?>">
            </div>

            <div class="form-group">
                <label>Documento de Identidade</label>
                <input type="text" name="doc_identidade_proprietario" class="form-control" value="<?= $proprietario['doc_identidade_proprietario'] ?>">
            </div>

            <div class="form-group">
                <label>CPF</label>
                <input type="text" name="cpf_proprietario" class="form-control" value="<?= $proprietario['cpf_proprietario'] ?>">
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="<?= URL_BASE ?>proprietario/listar" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const visualizarImg = document.getElementById('img-form');
        const arquivo = document.getElementById('foto_proprietario');

        arquivo.addEventListener('change', function () {
            if (arquivo.files && arquivo.files[0]) {
                let render = new FileReader();
                render.onload = function (e) {
                    visualizarImg.src = e.target.result;
                };
                render.readAsDataURL(arquivo.files[0]);
            }
        });
    });
</script>

