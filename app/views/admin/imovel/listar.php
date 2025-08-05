<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['mensagem']) && isset($_SESSION['tipoMsg'])) {
  $msg = $_SESSION['mensagem'];
  $tipo = $_SESSION['tipoMsg'];
  if ($tipo == 'sucesso') {

    echo '<div class="alert alert-sucess" role="alert">' . $msg . '</div>';
  } elseif ($tipo == 'erro') {
    echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
  }

  unset($_SESSION['mensagem']);
  unset($_SESSION['tipoMsg']);
}



?>


<div class="card mb-10">
  <div class="card-header">
    <h3 class="card-title">Listar Clientes</h3>

    <div class="ajusteNOVO">

      <a href="<?= URL_BASE ?>imovel/adicionar" class="btn btn-primary ">

        <i class="bi bi-clipboard2-plus-fill"></i>
        Novo Imovel

      </a>

    </div>

  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nome</th>
          <th>Preço</th>
          <th>Descrição</th>
          <th>Cep</th>
          <th>Endereço</th>
          <th>Publicar</th>
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>
      <tbody>

        <!-- linha e repetida de acordo com quanto cursos tem no banco de dados -->

        <?php foreach ($imoveis as $linha): ?>



          <tr class="align-middle">
            <td><img style="width: 100px" src="<?= URL_BASE ?>upload/imovel/<?= $linha['url_foto_imovel'] ?>" alt=""></td>
            <td> <?= $linha['nome_imovel']; ?> </td>
            <td> <?= $linha['preco_imovel']; ?> </td>
            <td> <?= $linha['descricao_imovel']; ?> </td>
            <td> <?= $linha['cep_imovel']; ?> </td>
            <td> <?= $linha['endereco_imovel']; ?> </td>
            <td style="text-align: center;" class="corpo">
                            <input
                                class="form-check-input toggle-status"
                                type="checkbox"
                                role="switch"
                                data-id="<?= $linha['id_imovel'] ?>"
                                <?= $linha['status_imovel'] === 'Disponivel' ? 'checked' : '' ?>>
                        </td>
            <!-- <td><span class="badge text-bg-danger">55%</span></td> -->

            <td><a href="<?= URL_BASE ?>imovel/editar/<?= $linha['id_imovel'] ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>

            <td><a href="#" class="btn btn-danger" onclick="abrirModalDesativar(<?= $linha['id_imovel']; ?>); return false;">
                <i class="bi bi-x-circle"></i></a></td>
          </tr>


        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="desativarCliente" tabindex="-1" role="dialog" aria-labelledby="desativarClienteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarClienteLabel">Deletar Imovel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja deletar esse imovel?</p>
        <input type="hidden" id="idImovel" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary" id="simDesativar">Sim</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.toggle-status').forEach(input => {
    input.addEventListener('change', function() {

      const id = this.dataset.id;
      const status = this.checked ? 'Disponivel' : 'Indisponivel';

      //requisição AJAX com fetch
      fetch('<?= URL_BASE ?>imovel/atualizarStatus', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id_imovel: id,
            status_imovel: status
          })

        })

        .then(response => response.json()) // Corrigido "=" para "=>"
        .then(data => {
          if (!data.sucesso) {
            alert('Erro ao atualizar status');
            this.checked = !this.checked
          }
        })
        .catch(() => { // Corrigido "cath" para "catch"
          alert('Erro de comunicação'); // Corrigido "comunicaçao" para "comunicação" (opcional, se quiser corrigir o português)
          this.checked = !this.checked;
        });

    })
  })

  // script para abrir o modal e desativar o curso
  function abrirModalDesativar(idImovel) {


    if ($('#desativarCliente').hasClass('show')) {
      return;
    }

    // ao clicar no botão SIM - pega iD
    document.getElementById('idImovel').value = idImovel
    $('#desativarCliente').modal('show');

    document.getElementById('simDesativar').addEventListener('click', function() {
      const idImovel = document.getElementById('idImovel').value

      if (idImovel) {
        desativarImovel(idImovel)
      }

    })

    //função em AJAX para realizar uma solicitação ao ControllerCurso, chamando o método desativar


    // `` usando isso, conseguimos utilizar tanto variavel quanto escrita no mesmo ligar
    function desativarImovel(idImovel) {
      fetch(`<?= URL_BASE ?>imovel/deletarImovel/${idImovel}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'

          }
        })

        .then(response => {
          //se o código de resposta não for OK - exibir ERRO

          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`)

          }
          return response.json()
        })

        .then(data => {
          // se a resposta for OK, Fechar 0 modal e atualiza a página
          if (data.sucesso) {
            console.log("Usuario desativado com sucesso!")
            $('#desativarCliente').modal('hide');
            setTimeout(() => {
              location.reload();
            }, 500) //Delay de carregamento

          } else {
            console.log("Ocorreu um erro ao desativar o usuario!")
            alert(data.mensagem)
          }

        })

        .catch(error => {
          console.error('Erro: ', error)
          alert(data.mensagem)
        })

    }

  }
</script>