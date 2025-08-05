<div class="container my-4">
  <h3 class="mb-4"><?= isset($mensagem) ? '✏️ Editar Mensagem' : '➕ Nova Mensagem' ?></h3>
  <form method="post" action="<?= URL_BASE ?>mensagem/salvar">
    <input type="hidden" name="id_mensagem" value="<?= $mensagem['id_mensagem'] ?? '' ?>">

  

    <div class="mb-3">
      <label class="form-label">Cliente</label>
      <select name="id_cliente" class="form-select" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($clientes as $c): ?>
          <option value="<?= $c['id_cliente'] ?>" <?= (isset($mensagem) && $mensagem['id_cliente'] == $c['id_cliente']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($c['nome_cliente']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Proprietário</label>
      <select name="id_proprietario" class="form-select" required>
        <option value="">Selecione um proprietário</option>
        <?php foreach ($proprietarios as $p): ?>
          <option value="<?= $p['id_proprietario'] ?>" <?= (isset($mensagem) && $mensagem['id_proprietario'] == $p['id_proprietario']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['nome_proprietario']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Imóvel</label>
      <select name="id_imovel" class="form-select" required>
        <option value="">Selecione um imóvel</option>
        <?php foreach ($imoveis as $i): ?>
          <option value="<?= $i['id_imovel'] ?>" <?= (isset($mensagem) && $mensagem['id_imovel'] == $i['id_imovel']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($i['nome_imovel']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Mensagem</label>
      <textarea class="form-control" name="mensagem" rows="5" required><?= $mensagem['mensagem'] ?? '' ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">
      <i class="fas fa-save me-1"></i> Salvar
    </button>
    <a href="<?= URL_BASE ?>mensagem/listar" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
