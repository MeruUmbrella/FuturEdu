<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container">
  <h3 class="mb-4">👨‍💼 Meu Perfil</h3>

  <div class="card shadow-sm">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="<?= URL_BASE ?>uploads/funcionario/<?= $funcionario['foto_funcionario'] ?>" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;" alt="Foto do Funcionário">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <p class="card-text mb-2"><strong>Nome:</strong> <?= $funcionario['nome_funcionario']; ?></p>
          <p class="card-text mb-2"><strong>Email:</strong> <?= $funcionario['email_funcionario']; ?></p>
          <p class="card-text mb-2">
            <strong>Senha:</strong>
            <span id="senha" style="display: none;"><?= $funcionario['senha_funcionario']; ?></span>
            <span id="oculto">********</span>
            <button type="button" class="btn btn-sm btn-outline-warning ms-1" onclick="toggleSenha()">
              <i class="fa fa-eye" id="icon"></i>
            </button>
          </p>
          <p class="card-text mb-2"><strong>CEP:</strong> <?= $funcionario['cep_funcionario']; ?></p>
          <p class="card-text mb-2"><strong>Bairro:</strong> <?= $funcionario['bairro_funcionario']; ?></p>
          <p class="card-text mb-2"><strong>Endereço:</strong> <?= $funcionario['endereco_funcionario']; ?></p>
          <p class="card-text mb-2"><strong>Cidade:</strong> <?= $funcionario['estado_funcionario']; ?></p>
          <p class="card-text"><strong>Status:</strong> <?= $funcionario['status_funcionario']; ?></p>
        </div>
        <div class="card-footer bg-white border-0 text-center">
          <a href="<?= URL_BASE ?>funcionario/editarFuncionario/<?= $funcionario['id_funcionario']; ?>" class="btn btn-warning px-4 py-2">
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
