<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="card card-info card-outline mb-4">

    <div class="card-header">
        <div class="card-title">Editar as Informações do Proprietário</div>
    </div>

    <form class="needs-validation" method="POST" action="<?= URL_BASE ?>proprietario/editarProprietario/<?= $carregarDadosProprietario['id_proprietario'] ?>" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-4">
                    <img id="img-form" src="<?= URL_BASE ?>uploads/proprietario/<?= $carregarDadosProprietario['foto_proprietario'] ?>"
                        alt="Foto do proprietário" style="width: 100%; cursor: pointer;" title="Clique na imagem para selecionar uma foto para o proprietário.">
                    <input type="file" id="foto_proprietario" name="foto_proprietario" accept="image/*" style="display: none;">
                </div>

                <div class="col-md-8">
                    <div style="font-weight: 650;" class="row g-3">

                        <div class="col-md-6">
                            <label for="nome_proprietario" class="form-label">Nome do Proprietário: </label>
                            <input type="text" name="nome_proprietario" class="form-control" id="nome_proprietario" value="<?= $carregarDadosProprietario['nome_proprietario'] ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email_proprietario" class="form-label">Email do Proprietário: </label>
                            <input type="text" name="email_proprietario" class="form-control" id="email_proprietario" value="<?= $carregarDadosProprietario['email_proprietario'] ?>">
                        </div>

                        <div class="col-md-8">
                            <label for="senha_proprietario" class="form-label">Senha Proprietário: </label>
                            <div class="input-group">
                                <input type="password" name="senha_proprietario" class="form-control" id="senha_proprietario" value="<?= $carregarDadosProprietario['senha_proprietario']?>" required="">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fa fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="cep_proprietario" class="form-label">CEP Proprietário: </label>
                            <input type="text" name="cep_proprietario" class="form-control" id="cep_proprietario" value="<?= $carregarDadosProprietario['cep_proprietario']?>" required="">
                        </div>

                        <div class="col-md-4">
                            <label for="bairro_proprietario" class="form-label">Bairro: </label>
                            <input type="text" name="bairro_proprietario" class="form-control" id="bairro_proprietario" value="<?= $carregarDadosProprietario['bairro_proprietario']?>" required="">
                        </div>

                        <div class="col-md-4">
                            <label for="endereco_proprietario" class="form-label">Endereço: </label>
                            <input type="text" name="endereco_proprietario" class="form-control" id="endereco_proprietario" value="<?= $carregarDadosProprietario['endereco_proprietario']?>" required="">
                        </div>

                        <div class="col-md-4">
                            <label for="estado_proprietario" class="form-label">Estado: </label>
                            <input type="text" name="estado_proprietario" class="form-control" id="estado_proprietario" value="<?= $carregarDadosProprietario['estado_proprietario']?>" required="">
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div style="justify-content: end; display: flex;" class="card-footer">
            <button style="width: 100px; background: #0dcaf0; color: white;" class="btn btn-info" type="submit">Editar</button>
        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const visualizarImg = document.getElementById('img-form');
            const arquivo = document.getElementById('foto_proprietario');

            visualizarImg.addEventListener('click', function() {
                arquivo.click();
            });

            arquivo.addEventListener('change', function() {
                if (arquivo.files && arquivo.files[0]) {
                    let render = new FileReader();
                    render.onload = function(e) {
                        visualizarImg.src = e.target.result;
                    }
                    render.readAsDataURL(arquivo.files[0]);
                }
            });
        });

        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('senha_proprietario');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>

</div>
