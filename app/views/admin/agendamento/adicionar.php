<div class="container my-4">
  <h3 class="mb-4"><?= isset($agendamento) ? '✏️ Editar Agendamento' : '➕ Novo Agendamento' ?></h3>
  
  <form method="post" action="<?= URL_BASE ?>agendamento/salvar">
    <input type="hidden" name="id_agendamento" value="<?= $agendamento['id_agendamento'] ?? '' ?>">

    <div class="mb-3">
      <label class="form-label">Cliente</label>
      <select name="id_cliente" class="form-select" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($clientes as $c): ?>
          <option value="<?= $c['id_cliente'] ?>" <?= (isset($agendamento) && $agendamento['id_cliente'] == $c['id_cliente']) ? 'selected' : '' ?>>
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
          <option value="<?= $p['id_proprietario'] ?>" <?= (isset($agendamento) && $agendamento['id_proprietario'] == $p['id_proprietario']) ? 'selected' : '' ?>>
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
          <option value="<?= $i['id_imovel'] ?>" <?= (isset($agendamento) && $agendamento['id_imovel'] == $i['id_imovel']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($i['nome_imovel']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Data e Hora da Visita</label>
      <input type="datetime-local" name="data_visita" class="form-control" 
             value="<?= isset($agendamento['data_visita']) ? date('Y-m-d\TH:i', strtotime($agendamento['data_visita'])) : '' ?>" 
             required>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status_agendamento" class="form-select" required>
        <option value="">Selecione o status</option>
        <?php
          $statusOpcoes = ["Pendente", "Confirmado", "Cancelado"];
          foreach ($statusOpcoes as $status) {
            $selected = (isset($agendamento) && $agendamento['status_agendamento'] == $status) ? 'selected' : '';
            echo "<option value=\"$status\" $selected>$status</option>";
          }
        ?>
      </select>
    </div>

    <button type="submit" class="btn btn-success">
      <i class="fas fa-save me-1"></i> Salvar
    </button>
    <a href="<?= URL_BASE ?>agendamento/listar" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
