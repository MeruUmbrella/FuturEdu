<div class="container my-4">
  <h3 class="mb-4">✏️ Editar Relatório</h3>
  <form method="post" action="<?= URL_BASE ?>relatorio/salvarEdicao">
    <input type="hidden" name="id_relatorio" value="<?= $relatorio['id_relatorio']; ?>">

    <div class="mb-3">
      <label class="form-label">Tipo de Relatório</label>
      <input type="text" class="form-control" name="tipo_relatorio" value="<?= $relatorio['tipo_relatorio']; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Dados do Relatório</label>
      <textarea class="form-control" name="dados_relatorio" rows="6" required><?= $relatorio['dados_relatorio']; ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">
      <i class="fas fa-save me-1"></i> Salvar Alterações
    </button>
    <a href="<?= URL_BASE ?>relatorio/listar" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>