<div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Lista de Proprietários</h3>
        <!-- Botão para adicionar novo proprietário -->
        <a href="<?= URL_BASE ?>proprietario/adicionar" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Novo Proprietário
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>CEP</th>
                    <th>Editar</th>
                    <th>Desativar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proprietarios as $p): ?>
                    <tr>
                        <td><img src="<?= URL_BASE ?>upload/proprietario/<?= $p['foto_proprietario'] ?>" width="60" /></td>
                        
                        <td><?= $p['nome_proprietario'] ?></td>
                        <td><?= $p['email_proprietario'] ?></td>
                        <td><?= $p['cpf_proprietario'] ?></td>
                        <td><?= $p['cep_proprietario'] ?></td>
                        <td><a href="<?= URL_BASE ?>proprietario/editar/<?= $p['id_proprietario'] ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                        <td style="text-align: center;">
    <input class="form-check-input toggle-status" type="checkbox" role="switch"
        data-id="<?= $p['id_proprietario'] ?>"
        <?= $p['status_proprietario'] === 'ATIVO' ? 'checked' : '' ?>>
</td>
                        <td><a href="<?= URL_BASE ?>proprietario/excluir/<?= $p['id_proprietario'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')"><i class="bi bi-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
document.querySelectorAll('.toggle-status').forEach(input => {
    input.addEventListener('change', function() {
        const id = this.dataset.id;
        const status = this.checked ? 'Ativo' : 'Desativado';

        fetch('<?= URL_BASE ?>proprietario/atualizarStatus', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_proprietario: id,
                status_proprietario: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.sucesso) {
                alert('Erro ao atualizar status');
                this.checked = !this.checked; // reverte se falhar
            }
        })
        .catch(() => {
            alert('Erro de comunicação');
            this.checked = !this.checked;
        });
    });
});
</script>

