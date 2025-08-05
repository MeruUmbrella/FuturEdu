<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['mensagem']) && isset($_SESSION['tipoMsg'])) {
    $msg = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipoMsg'];
    if ($tipo == 'sucesso') {
        echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
    } elseif ($tipo == 'erro') {
        echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
    }

    unset($_SESSION['mensagem']);
    unset($_SESSION['tipoMsg']);
}
?>

<div class="card mb-10">
    <div class="card-header">
        <h3 class="card-title">Meus Imóveis</h3>

        <div class="ajusteNOVO">
            <a href="<?= URL_BASE ?>imovel/adicionarImovelProprietario" class="btn btn-primary">
                <i class="bi bi-clipboard2-plus-fill"></i>
                Novo Imóvel
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                 
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($imoveis as $linha): ?>
                    <tr class="align-middle">
                        <td><img style="width: 100px" src="<?= URL_BASE ?>upload/imovel/<?= htmlspecialchars($linha['url_foto_imovel']) ?>" alt=""></td>
                        <td><?= htmlspecialchars($linha['nome_imovel']); ?></td>
                        <td><?= htmlspecialchars($linha['preco_imovel']); ?></td>
                        <td><?= htmlspecialchars($linha['descricao_imovel']); ?></td>
                        <td><?= htmlspecialchars($linha['cep_imovel']); ?></td>
                        <td><?= htmlspecialchars($linha['endereco_imovel']); ?></td>
                      
                        <td><a href="<?= URL_BASE ?>imovel/editarImovelProprietario/<?= (int)$linha['id_imovel'] ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
                        <td><a href="#" class="btn btn-danger" onclick="abrirModalDesativar(<?= (int)$linha['id_imovel']; ?>); return false;">
                                <i class="bi bi-x-circle"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="desativarImovel" tabindex="-1" role="dialog" aria-labelledby="desativarImovelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="desativarImovelLabel">Deletar Imóvel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja deletar esse imóvel?</p>
                <input type="hidden" id="idImovel" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" id="simDesativar">Sim</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-status').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.dataset.id;
            const status = this.checked ? 'Disponivel' : 'Indisponivel';

            fetch('<?= URL_BASE ?>imovel/atualizarStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_imovel: id,
                        status_imovel: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.sucesso) {
                        alert('Erro ao atualizar status');
                        this.checked = !this.checked;
                    }
                })
                .catch(() => {
                    alert('Erro de comunicação');
                    this.checked = !this.checked;
                });
        });
    });

    function abrirModalDesativar(idImovel) {
        if ($('#desativarImovel').hasClass('show')) return;

        document.getElementById('idImovel').value = idImovel;
        $('#desativarImovel').modal('show');

        // Remove event listener anterior para evitar múltiplos binds
        const btnSim = document.getElementById('simDesativar');
        const novoBtnSim = btnSim.cloneNode(true);
        btnSim.parentNode.replaceChild(novoBtnSim, btnSim);

        novoBtnSim.addEventListener('click', function() {
            const id = document.getElementById('idImovel').value;
            if (idImovel) {
                desativarImovel(idImovel);
            }
        });
    }

    function desativarImovel(idImovel) {
        fetch(`<?= URL_BASE ?>imovel/deletarImovel/${idImovel}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.sucesso) {
                    $('#desativarImovel').modal('hide');
                    setTimeout(() => location.reload(), 500);
                } else {
                    alert(data.mensagem || 'Erro ao desativar imóvel.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao processar a requisição.');
            });
    }
</script>