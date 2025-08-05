<div class="container my-4">
  <h3 class="mb-4">📬 Lista de Agendamentos</h3>
  <a href="<?= URL_BASE ?>agendamento/adicionar" class="btn btn-primary mb-3">➕ Novo Agendamento</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Proprietário</th>
        <th>Funcionario</th>
        <th>Imóvel</th>
        <th>Data Visita</th>
        <th>Status Agendamento</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($agendamentos as $msg): ?>
        <tr>
          <td><?= $msg['id_agendamento'] ?></td>
          <td><?= htmlspecialchars($msg['nome_cliente']) ?></td>
          <td><?= htmlspecialchars($msg['nome_proprietario']) ?></td>
          <td><?= htmlspecialchars($msg['nome_imovel']) ?></td>
          <td><?= nl2br(htmlspecialchars($msg['data_visita'])) ?></td>
          <td><?= htmlspecialchars($msg['status_agendamento']) ?></td>
          <td>
            <a href="<?= URL_BASE ?>agendamento/editar/<?= $msg['id_agendamento'] ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
            <a href="<?= URL_BASE ?>agendamento/excluir/<?= $msg['id_agendamento'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir esta agendamento?')">🗑️ Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>