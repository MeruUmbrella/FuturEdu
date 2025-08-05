<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container">
<h3 class="mb-4">📋 Lista de Clientes</h3>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach ($clientes as $cliente): ?>
      <div class="col">
        <div class="card shadow-sm h-100">
          <img src="<?= URL_BASE ?>uploads/cliente/<?= $cliente['foto_cliente'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Foto do Cliente">
          <div class="card-body">
            <p class="card-text mb-1"><strong>Nome:</strong> <?= $cliente['nome_cliente']; ?></p>
            <p class="card-text mb-1"><strong>Email:</strong> <?= $cliente['email_cliente']; ?></p>
            <p class="card-text mb-1">
              <strong>Senha:</strong>
              <span id="senha-<?= $cliente['id_cliente']; ?>" style="display: none;"><?= $cliente['senha_cliente']; ?></span>
              <span id="oculto-<?= $cliente['id_cliente']; ?>">********</span>
              <button type="button" class="btn btn-sm btn-outline-warning ms-1" onclick="toggleSenha(<?= $cliente['id_cliente']; ?>)">
                <i class="fa fa-eye" id="icon-<?= $cliente['id_cliente']; ?>"></i>
              </button>
            </p>
            <p class="card-text mb-1"><strong>CEP:</strong> <?= $cliente['cep_cliente']; ?></p>
            <p class="card-text mb-1"><strong>Bairro:</strong> <?= $cliente['bairro_cliente']; ?></p>
            <p class="card-text mb-1"><strong>Endereço:</strong> <?= $cliente['endereco_cliente']; ?></p>
            <p class="card-text mb-1"><strong>Cidade:</strong> <?= $cliente['estado_cliente']; ?></p>
            <p class="card-text"><strong>Status:</strong> <?= $cliente['status_cliente']; ?></p>
          </div>
          <div class="card-footer bg-white border-0 text-center">
            <div class="mb-2">
              <div class="form-check form-switch d-inline-flex align-items-center">
                <input class="form-check-input toggle-status me-2" type="checkbox" data-id="<?= $cliente['id_cliente']; ?>" <?= $cliente['status_cliente'] === 'Ativo' ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold">Ativo</label>
              </div>
            </div>
            <div class="d-flex justify-content-center gap-3">
              <a href="<?= URL_BASE ?>cliente/editar/<?= $cliente['id_cliente']; ?>" class="btn btn-warning px-4 py-2">
                <i class="fas fa-edit me-1"></i> Editar
              </a>
              <a href="#" class="btn btn-danger px-4 py-2" onclick="abrirModalDesativar(<?= $cliente['id_cliente']; ?>); return false;">
                <i class="fas fa-user-slash me-1"></i> Desativar
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Modal Desativar -->
<div class="modal fade" id="desativarCliente" tabindex="-1" role="dialog" aria-labelledby="desativarClienteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarClienteLabel">Desativar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja desativar este usuário?</p>
        <input type="hidden" id="idCliente" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <button type="button" class="btn btn-danger" id="simDesativar">Sim</button>
      </div>
    </div>
  </div>
</div>

<script>
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

  document.querySelectorAll('.toggle-status').forEach(input => {
    input.addEventListener('change', function () {
      const id = this.dataset.id;
      const status = this.checked ? 'Ativo' : 'Pendente';

      fetch('<?= URL_BASE ?>cliente/atualizarStatus', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id_cliente: id, status_cliente: status })
      })
        .then(response => response.json())
        .then(data => {
          if (!data.sucesso) {
            alert('Erro ao atualizar status');
            this.checked = !this.checked;
          }
        })
        .catch(() => {
          alert('Erro de comunicação');
          this.checked = !this.checked;
        });
    });
  });

  function abrirModalDesativar(idCliente) {
    if (document.getElementById('desativarCliente').classList.contains('show')) return;

    document.getElementById('idCliente').value = idCliente;
    const modal = new bootstrap.Modal(document.getElementById('desativarCliente'));
    modal.show();

    document.getElementById('simDesativar').onclick = function () {
      desativarCliente(idCliente);
    };
  }

  function desativarCliente(idCliente) {
    fetch(`<?= URL_BASE ?>cliente/desativar/${idCliente}`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' }
    })
      .then(response => {
        if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);
        return response.json();
      })
      .then(data => {
        if (data.sucesso) {
          const modal = bootstrap.Modal.getInstance(document.getElementById('desativarCliente'));
          modal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          alert(data.mensagem);
        }
      })
      .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao desativar o usuário.');
      });
  }
</script>
