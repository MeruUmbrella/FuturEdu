<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container my-4">
  <h3 class="mb-4 text-center">📋 Lista de Relatórios</h3>
  <a href="<?= URL_BASE ?>relatorio/adicionar" class="btn btn-primary">
      <i class="fas fa-plus me-1"></i> Novo Relatório
    </a>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach ($relatorio as $rel): ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <p class="card-text mb-1"><strong>Relatório #</strong> <?= $rel['id_relatorio']; ?></p>
            <p class="card-text mb-1"><strong>Tipo:</strong> <?= $rel['tipo_relatorio']; ?></p>
            <p class="card-text mb-1"><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($rel['data_geracao_relatorio'])); ?></p>
            <p class="card-text mb-1"><strong>Conteúdo:</strong><br><?= nl2br($rel['dados_relatorio']); ?></p>
            <p class="card-text mb-0"><strong>Gerado por:</strong> <?= $rel['nome_funcionario']; ?></p>
            <p class="card-text mb-0"><strong>status do Relatório:</strong> <?= $rel['status_relatorio']; ?></p>
          </div>
          <div class="card-footer bg-white border-top-0 d-flex justify-content-center gap-3">
            <a href="<?= URL_BASE ?>relatorio/editar/<?= $rel['id_relatorio']; ?>" class="btn btn-sm btn-warning px-3">
              <i class="fas fa-edit me-1"></i> Editar
            </a>

            <a href="#"class="btn btn-sm btn-danger px-3" onclick="abrirModalDesativar(<?= $rel['id_relatorio']; ?>); return false;">
              <i class="fas fa-trash-alt me-1"></i> Desativar
            </a>

            <a href="#"class="btn btn-sm btn-danger px-3" onclick="abrirModalDesativar(<?= $rel['id_relatorio']; ?>); return false;">
              <i class="fas fa-trash-alt me-1"></i> Desativar
            </a>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


<!-- Modal Desativar -->
<div class="modal fade" id="desativarRelatorio" tabindex="-1" role="dialog" aria-labelledby="desativarRelatorioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarRelatorioLabel">Excluir Relatório</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir esse Relatório?</p>
        <input type="hidden" id="idRelatorio" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary" id="simDesativar">Sim</button>
      </div>
    </div>
  </div>
</div>




<script>

  // script para abrir o modal e desativar o curso
  function abrirModalDesativar(idRelatorio) {


    if ($('#desativarRelatorio').hasClass('show')) {
      return;
    }

    // ao clicar no botão SIM - pega iD
    document.getElementById('idRelatorio').value = idRelatorio
    $('#desativarRelatorio').modal('show');

    document.getElementById('simDesativar').addEventListener('click', function() {
      const idRelatorio = document.getElementById('idRelatorio').value

      if (idRelatorio) {
        desativarRelatorio(idRelatorio)
      }

    })

    //função em AJAX para realizar uma solicitação ao ControllerCurso, chamando o método desativar


    // `` usando isso, conseguimos utilizar tanto variavel quanto escrita no mesmo ligar
    function desativarRelatorio(idRelatorio) {
      fetch(`<?= URL_BASE ?>relatorio/desativar/${idRelatorio}`, {
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
            console.log("Relatorio excluido com sucesso!")
            $('#desativarRelatorio').modal('hide');
            setTimeout(() => {
              location.reload();
            }, 500) //Delay de carregamento

          } else {
            console.log("Ocorreu um erro ao excluir o Relatorio!")
            alert(data.mensagem)
          }

        })

        .catch(error => {
          console.error('Erro: ', error)
          alert(data.mensagem)
        })

    }

  }

  function toggleSenha(id) {
    const senhaSpan = document.getElementById(`senha-${id}`);
    const ocultoSpan = document.getElementById(`oculto-${id}`);
    const icon = document.getElementById(`icon-${id}`);

    if (senhaSpan.style.display === "none") {
      senhaSpan.style.display = "inline";
      ocultoSpan.style.display = "none";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      senhaSpan.style.display = "none";
      ocultoSpan.style.display = "inline";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }
</script>