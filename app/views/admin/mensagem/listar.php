<div class="container my-4">
  <h3 class="mb-4">📬 Lista de Mensagens</h3>
  <a href="<?= URL_BASE ?>mensagem/adicionar" class="btn btn-primary mb-3">➕ Nova Mensagem</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Proprietário</th>
        <th>Imóvel</th>
        <th>Mensagem</th>
        <th>Data de Envio</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($mensagens as $msg): ?>
        <tr>
          <td><?= $msg['id_mensagem'] ?></td>
          <td><?= htmlspecialchars($msg['nome_cliente']) ?></td>
          <td><?= htmlspecialchars($msg['nome_proprietario']) ?></td>
          <td><?= htmlspecialchars($msg['nome_imovel']) ?></td>
          <td><?= nl2br(htmlspecialchars($msg['mensagem'])) ?></td>
          <td><?= date('d/m/Y H:i', strtotime($msg['data_envio'])) ?></td>
          <td>
            <a href="<?= URL_BASE ?>mensagem/editar/<?= $msg['id_mensagem'] ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
            <a href="<?= URL_BASE ?>mensagem/excluir/<?= $msg['id_mensagem'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir esta mensagem?')">🗑️ Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>