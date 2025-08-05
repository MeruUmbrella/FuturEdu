<div class="container my-4">
  <h3 class="mb-4">📝 Adicionar Novo Relatório</h3>
  <form method="post" action="<?= URL_BASE ?>relatorio/salvar">
    <div class="mb-3">
      <label class="form-label">Tipo de Relatório</label>
      <input type="text" class="form-control" name="tipo_relatorio" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Dados do Relatório</label>
      <textarea class="form-control" name="dados_relatorio" rows="6" required></textarea>
    </div>

    <div class="mb-3">
  <label class="form-label">Funcionário</label>
  <select class="form-select" name="id_funcionario" required>
    <option value="">Selecione um funcionário</option>
    <?php foreach ($funcionarios as $func): ?>
      <option value="<?= $func['id_funcionario'] ?>">
        <?= htmlspecialchars($func['nome_funcionario']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

    <button type="submit" class="btn btn-success">
      <i class="fas fa-save me-1"></i> Salvar Relatório
    </button>
    <a href="<?= URL_BASE ?>relatorio/listar" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>