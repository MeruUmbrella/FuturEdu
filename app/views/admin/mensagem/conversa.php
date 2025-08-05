<h2>Conversa</h2>
<div class="chat-box" style="
    max-width: 600px;
    height: 400px;
    overflow-y: auto;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #f9f9f9;
    font-family: Arial, sans-serif;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
">
    <?php foreach($mensagens as $msg): 
        $isProprietario = ($msg['id_proprietario'] == $_SESSION['tipo_id']);
        $senderName = $isProprietario ? 'Você' : 'Cliente';
        $bubbleColor = $isProprietario ? '#007bff' : '#6c757d'; // azul e cinza
        $textColor = '#fff';
        $alignStyle = $isProprietario ? 'flex-end' : 'flex-start';
    ?>
    <div style="
        display: flex;
        justify-content: <?= $alignStyle ?>;
        margin-bottom: 12px;
    ">
        <div style="
            max-width: 70%;
            background-color: <?= $bubbleColor ?>;
            color: <?= $textColor ?>;
            padding: 10px 14px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            word-wrap: break-word;
        ">
            <strong><?= $senderName ?>:</strong><br>
            <?= htmlspecialchars($msg['mensagem']) ?><br>
            <small style="font-size: 0.75rem; color: #d1d1d1; margin-top: 4px; display: block;">
                <?= date('d/m/Y H:i', strtotime($msg['data_envio'])) ?>
            </small>
        </div>
    </div>
    <?php endforeach; ?>
</div>
