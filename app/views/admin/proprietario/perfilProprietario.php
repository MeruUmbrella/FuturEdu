<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container">
  <h3 class="mb-4">👤 Meu Perfil</h3>

  <div class="card shadow-sm">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="<?= URL_BASE ?>uploads/cliente/<?= $proprietario['foto_proprietario'] ?>" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;" alt="Foto do proprietario">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <p class="card-text mb-2"><strong>Nome:</strong> <?= $proprietario['nome_proprietario']; ?></p>
          <p class="card-text mb-2"><strong>Email:</strong> <?= $proprietario['email_proprietario']; ?></p>
          <p class="card-text mb-2">
            <strong>Senha:</strong>
            <span id="senha" style="display: none;"><?= $proprietario['senha_proprietario']; ?></span>
            <span id="oculto">********</span>
            <button type="button" class="btn btn-sm btn-outline-warning ms-1" onclick="toggleSenha()">
              <i class="fa fa-eye" id="icon"></i>
            </button>
          </p>
          <p class="card-text mb-2"><strong>CEP:</strong> <?= $proprietario['cep_proprietario']; ?></p>
          <p class="card-text mb-2"><strong>Bairro:</strong> <?= $proprietario['bairro_proprietario']; ?></p>
          <p class="card-text mb-2"><strong>Endereço:</strong> <?= $proprietario['endereco_proprietario']; ?></p>
          <p class="card-text mb-2"><strong>Cidade:</strong> <?= $proprietario['estado_proprietario']; ?></p>
          <p class="card-text"><strong>Status:</strong> <?= $proprietario['status_proprietario']; ?></p>
        </div>
        <div class="card-footer bg-white border-0 text-center">
          <a href="<?= URL_BASE ?>proprietario/editarproprietario/<?= $proprietario['id_proprietario']; ?>" class="btn btn-warning px-4 py-2">
            <i class="fas fa-edit me-1"></i> Editar
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleSenha() {
    const senhaSpan = document.getElementById("senha");
    const ocultoSpan = document.getElementById("oculto");
    const icon = document.getElementById("icon");

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
