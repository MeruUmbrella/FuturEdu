<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<body style="background-color: #dfdfdf;">


  <?php if (!empty($cliente)): ?>
    <div class="container my-5">
      <h3 style="text-align: center;" class="mb-4">👤 Meu Perfil</h3>

      <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="row g-0">
          <!-- Foto -->
          <div class="col-md-4 bg-light d-flex justify-content-center align-items-center p-4">
            <img src="<?= URL_BASE ?>uploads/cliente/<?= $cliente['foto_cliente'] ?>"
              class="img-fluid rounded-3 shadow-sm"
              style="object-fit: cover; max-height: 300px;"
              alt="Foto do Cliente">
          </div>

          <!-- Dados -->
          <div class="col-md-8 p-4">
            <div style="padding-top: 70px;" class="row mb-3">
              <div class="col-sm-6 mb-3">
                <strong>Nome:</strong> <br> <?= $cliente['nome_cliente']; ?>
              </div>
              <div class="col-sm-6 mb-3">
                <strong>Email:</strong> <br> <?= $cliente['email_cliente']; ?>
              </div>
              <div class="col-sm-6 mb-3">
                <strong>Senha:</strong> <br>
                <span id="senha" style="display: none;"><?= $cliente['senha_cliente']; ?></span>
                <span id="oculto">********</span>
                <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="toggleSenha()">
                  <i class="fa fa-eye" id="icon"></i>
                </button>
              </div>
              <div class="col-sm-6 mb-3">
                <strong>CEP:</strong> <br> <?= $cliente['cep_cliente']; ?>
              </div>
              <div class="col-sm-6 mb-3">
                <strong>Bairro:</strong> <br> <?= $cliente['bairro_cliente']; ?>
              </div>
              <div class="col-sm-6 mb-3">
                <strong>Endereço:</strong> <br> <?= $cliente['endereco_cliente']; ?>
              </div>
              <div class="col-sm-6 mb-3">
                <strong>Cidade:</strong> <br> <?= $cliente['estado_cliente']; ?>
              </div>
              <div class="col-sm-6 mb-3">
                <strong>Status:</strong> <br> <?= $cliente['status_cliente']; ?>
              </div>
            </div>

            <div style="padding-left: 75%;" class="text-center mt-4">
              <a href="<?= URL_BASE ?>cliente/editarCliente/<?= $cliente['id_cliente']; ?>"
                class="btn btn-warning rounded-pill px-4 py-2 shadow-sm">
                <i class="fas fa-edit me-2"></i> Editar Perfil
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

</body>

<?php else: ?>
  <div class="container my-5">
    <div class="alert alert-warning text-center shadow-sm rounded-3 p-4">
      <i class="fa-solid fa-triangle-exclamation fa-lg me-2"></i> Dados do cliente não encontrados.
    </div>
  </div>
<?php endif; ?>

<script>
  function toggleSenha() {
    const senhaSpan = document.getElementById("senha");
    const ocultoSpan = document.getElementById("oculto");
    const icon = document.getElementById("icon");

    if (senhaSpan.style.display === "none") {
      senhaSpan.style.display = "inline";
      ocultoSpan.style.display = "none";
      icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
      senhaSpan.style.display = "none";
      ocultoSpan.style.display = "inline";
      icon.classList.replace("fa-eye-slash", "fa-eye");
    }
  }
</script>