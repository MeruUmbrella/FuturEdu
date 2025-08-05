<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<div class="card card-info card-outline mb-4">

    <div class="card-header">
        <div class="card-title">Editar as Informações do Usuario</div>
    </div>

    <form class="needs-validation" method="POST" action="<?= URL_BASE ?>cliente/editarCliente/<?= $carregarDadosCliente['id_cliente'] ?>" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row g-3">

            <div class="col-md-4">
                    <img id="img-form" src="<?= URL_BASE ?>uploads/cliente/<?= $carregarDadosCliente['foto_cliente'] ?>"
                        alt="Foto do cliente" style="width: 100%; cursor: pointer;" title="Clique na imagem para selecionar uma foto para o cliente.">

                    <input type="file" id="foto_cliente" name="foto_cliente" accept="image/*" style="display: none;">

                </div>

                <div class="col-md-8">

                    <div style="font-weight: 650;" class="row g-3">


                    <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Nome do Usuario: </label>
                            <input type="text" name="nome_cliente" class="form-control" id="nome_cliente" value="<?= $carregarDadosCliente['nome_cliente'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Email do Usuario: </label>
                            <input type="text" name="email_cliente" class="form-control" id="email_cliente" value="<?= $carregarDadosCliente['email_cliente'] ?>"aria-label="Default select example">
                            </input>
                        </div>
                        <div class="col-md-8">
                            <label for="validationCustom02" class="form-label">Senha Usuario: </label>
                            <div class="input-group">
                                <input type="password" name="senha_cliente" class="form-control" id="senha_cliente" value="<?= $carregarDadosCliente['senha_cliente']?>" required="">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword" >
                                    <i class="fa fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom02" class="form-label">CEP Usuario: </label>
                            <input type="text" name="cep_cliente" class="form-control" id="cep_cliente"  value="<?= $carregarDadosCliente['cep_cliente']?>" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Bairro: </label>
                            <input type="text" name="bairro_cliente" class="form-control" id="bairro_cliente"  value="<?= $carregarDadosCliente['bairro_cliente']?>" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Endereço: </label>
                            <input type="text" name="endereco_cliente" class="form-control" id="endereco_cliente"  value="<?= $carregarDadosCliente['endereco_cliente']?>" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Estado: </label>
                            <input type="text" name="estado_cliente" class="form-control" id="estado_cliente" value="<?= $carregarDadosCliente['estado_cliente']?>" required="">
                        </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div style="justify-content: end; display: flex;" class="card-footer">
            <button style="width: 100px; background: #0dcaf0;; color: white;" class="btn btn-info" type="submit">editar</button>
        </div>
        <!--end::Footer-->
    </form>

     <script>
        document.addEventListener('DOMContentLoaded', function() {

            const visualizarImg = document.getElementById('img-form');
            const arquivo = document.getElementById('foto_cliente');

            visualizarImg.addEventListener('click', function() {
                // alert("cliquei na img")
                // console.log("clique img")
                arquivo.click();
            });

            arquivo.addEventListener('change', function() {

                if (arquivo.files && arquivo.files[0]) {

                    let render = new FileReader()
                    render.onload = function(e) {
                        visualizarImg.src = e.target.result
                    }

                    render.readAsDataURL(arquivo.files[0])

                }

            })

        })
    
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('senha_cliente');
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

        // document.getElementById('cep_usuario').addEventListener('blur', function() {
        //     const cep = this.value.replace(/\D/g, '');
        //     if (cep.length === 8) {
        //         fetch(`https://viacep.com.br/ws/${cep}/json/`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (!data.erro) {
        //                     document.getElementById('logradouro').value = data.logradouro || '';
        //                     document.getElementById('bairro').value = data.bairro || '';
        //                     document.getElementById('cidade').value = data.localidade || '';
        //                     document.getElementById('estado').value = data.uf || '';
        //                 } else {
        //                     alert('CEP não encontrado.');
        //                 }
        //             })
        //             .catch(error => {
        //                 console.error('Erro ao buscar o CEP:', error);
        //                 alert('Erro ao buscar o CEP.');
        //             });
        //     } else {
        //         alert('CEP inválido.');
        //     }
        // });
    
    </script> 
    <!--end::Form-->
</div>