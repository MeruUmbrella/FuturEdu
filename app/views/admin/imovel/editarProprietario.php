
<div class="card card-info card-outline mb-4">

    <div class="card-header">
        <div class="card-title">Inserir um novo Imóvel</div>
    </div>

    <form class="needs-validation" method="POST" action="<?= URL_BASE ?>imovel/meusImoveis/<?= $carregarDadosImovel['id_imovel'] ?>" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row g-3">   

                <div class="col-md-4">
                    <img id="img-form" src="<?= URL_BASE ?>uploads/imovel/<?= $carregarDadosImovel['url_foto_imovel'] ?>"
                        alt="Foto do imóvel" style="width: 100%; cursor: pointer;" title="Clique na imagem para selecionar uma foto para o imóvel.">

                    <input type="file" id="url_foto_imovel" name="url_foto_imovel" accept="image/*" style="display: none;">

                </div>

                <div class="col-md-8">

                    <div style="font-weight: 650;" class="row g-3">

                        <div class="col-md-6">
                            <label for="nome_imovel" class="form-label">Nome do Imóvel: </label>
                            <input type="text" name="nome_imovel" class="form-control" id="nome_imovel" value="<?= $carregarDadosImovel['nome_imovel'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nivel_imovel" class="form-label">Tipo do anuncio</label>
                            <select name="tipo_anuncio_imovel" id="tipo_anuncio_imovel" class="form-select" required>
                                <option selected>Selecione o tipo</option>
                                <option value="Venda">Venda</option>
            
                                <option value="Aluguel">Aluguel</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="endereco_imovel" class="form-label">Endereço do Imovel</label>
                            <input type="text" name="endereco_imovel" class="form-control" value="<?= $carregarDadosImovel['endereco_imovel'] ?>" id="endereco_imovel" required>
                        </div>
                        <div class="col-md-2">
                            <label for="bairroimovel" class="form-label">Bairro do Imovel </label>
                            <input type="text" name="bairro_imovel" class="form-control" value="<?= $carregarDadosImovel['bairro_imovel'] ?>" id="bairro_imovel" required>
                        </div>
                        <div class="col-md-2">
                            <label for="status_imovel" class="form-label">Status do Imovel </label>
                            <select name="status_imovel" id="status_imovel" class="form-select" aria-label="Default select example">
                                <option selected><?= $carregarDadosImovel['status_imovel'] ?></option>
                                <option value="Disponivel">Disponível</option>
                                <option value="Indisponivel">Indisponível</option>
                     
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cep_imovel" class="form-label">CEP</label>
                            <input type="text" name="cep_imovel" class="form-control" value="<?= $carregarDadosImovel['cep_imovel'] ?>" id="cep_imovel" required>
                        </div>
                        <div class="col-md-4">
                            <label for="complemento_imovel" class="form-label">Complemento</label>
                            <input type="text" name="complemento_imovel" class="form-control" value="<?= $carregarDadosImovel['complemento_imovel'] ?>" id="complemento_imovel" required step="0.01" min="100">
                        </div>
                        <div class="col-md-4">
                            <label for="estado_imovel" class="form-label">Estado</label>
                            <input type="text" name="estado_imovel" class="form-control" value="<?= $carregarDadosImovel['estado_imovel'] ?>" id="estado_imovel" required step="0.01" min="100">
                        </div>
                        <div class="col-md-8">
                            <label for="descricao_imovel" class="form-label">Descrição</label>
                            <textarea name="descricao_imovel" class="form-control" id="descricao_imovel" required><?= $carregarDadosImovel['descricao_imovel'] ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="valor_imovel" class="form-label">Valor: </label>
                            <input type="number" name="preco_imovel" class="form-control" value="<?= $carregarDadosImovel['preco_imovel'] ?>" id="preco_imovel" required step="0.01" min="100">
                        </div>
                    </div>

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div style="justify-content: end; display: flex;" class="card-footer">
            <button style="width: 100px; background: #0dcaf0; color: white;" class="btn btn-info" type="submit">Editar</button>
        </div>
        <!--end::Footer-->
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const visualizarImg = document.getElementById('img-form');
            const arquivo = document.getElementById('url_foto_imovel');

            visualizarImg.addEventListener('click', function () {
                arquivo.click();
            });

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
    <!--end::Form-->
</div>
