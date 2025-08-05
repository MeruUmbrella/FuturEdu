<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    /* Container geral */
    .chat-container {
        max-width: 700px;
        margin: 2rem auto;
    }

    /* Área das mensagens */
    .chat-messages {
        height: 400px;
        overflow-y: auto;
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.375rem; /* arredondado */
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    /* Balões de mensagem */
    .msg-bubble {
        display: inline-block;
        padding: 0.6rem 1rem;
        border-radius: 15px;
        max-width: 70%;
        font-size: 0.95rem;
        line-height: 1.3;
        word-wrap: break-word;
    }

    /* Mensagens do cliente alinhadas à direita e azul */
    .msg-cliente {
        background-color: #0d6efd;
        color: white;
        border-bottom-right-radius: 0;
    }

    /* Mensagens do proprietário alinhadas à esquerda e cinza claro */
    .msg-proprietario {
        background-color: #e9ecef;
        color: #212529;
        border-bottom-left-radius: 0;
    }

    /* Container da mensagem para alinhamento */
    .msg-row {
        margin-bottom: 1rem;
    }

    /* Data da mensagem */
    .msg-timestamp {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    /* Formulário envio */
    .chat-form {
        margin-top: 1rem;
    }

    .chat-input {
        flex-grow: 1;
    }
</style>

<div class="container chat-container">
    <h3 class="mb-4">
        <i class="fas fa-comments"></i> Conversa com o Proprietário
    </h3>

    <div class="card shadow-sm">
        <div class="card-body chat-messages">
            <?php if (!empty($mensagens)) : ?>
                <?php foreach ($mensagens as $mensagem) : ?>
                    <div class="msg-row d-flex <?= ($mensagem['remetente'] === 'cliente') ? 'justify-content-end' : 'justify-content-start'; ?>">
                        <div class="msg-bubble <?= ($mensagem['remetente'] === 'cliente') ? 'msg-cliente' : 'msg-proprietario'; ?>">
                            <?= htmlspecialchars($mensagem['mensagem']); ?>
                            <div class="msg-timestamp text-end">
                                <?= date('d/m/Y H:i', strtotime($mensagem['data_envio'])); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-info mb-0">
                    Nenhuma mensagem nesta conversa ainda.
                </div>
            <?php endif; ?>
        </div>

        <div class="card-footer">
            <form action="<?= URL_BASE ?>mensagem/enviar" method="POST" class="d-flex gap-2 chat-form">
                <input type="hidden" name="id_imovel" value="<?= $id_imovel; ?>">
                <input type="hidden" name="id_proprietario" value="<?= $id_proprietario; ?>">
                <input type="hidden" name="id_cliente" value="<?= $id_cliente; ?>">
                <input type="hidden" name="remetente" value="cliente">

                <input type="text" name="mensagem" class="form-control chat-input" placeholder="Digite sua mensagem..." required autocomplete="off">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button>
            </form>
        </div>
    </div>
</div>
