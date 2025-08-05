<style>
  .chat-container {
    max-width: 700px;
    margin: 30px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .chat-header h3 {
    margin-bottom: 20px;
    font-weight: 700;
    color: #343a40;
  }

  .mensagens {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    max-height: 400px;
    overflow-y: auto;
    background-color: #f8f9fa;
    box-shadow: 0 4px 10px rgb(0 0 0 / 0.05);
  }

  .mensagem {
    max-width: 70%;
    margin-bottom: 12px;
    padding: 10px 15px;
    border-radius: 15px;
    position: relative;
    word-wrap: break-word;
    font-size: 1rem;
  }

  .mensagem.proprietario {
    background-color: #007bff;
    color: #fff;
    margin-left: auto;
    border-bottom-right-radius: 0;
  }

  .mensagem.cliente {
    background-color: #e9ecef;
    color: #212529;
    margin-right: auto;
    border-bottom-left-radius: 0;
  }

  .mensagem small {
    display: block;
    margin-top: 6px;
    font-size: 0.75rem;
    color:rgba(124, 102, 5, 0.79);
    font-style: italic;
  }

  textarea.form-control {
    border-radius: 8px;
    resize: vertical;
    min-height: 80px;
  }

  button.btn-success {
    border-radius: 8px;
    padding: 10px 25px;
    font-weight: 600;
  }
</style>
<?php
// Supondo que $nome_cliente esteja disponível (passado pelo controller)
?>

<div class="chat-container">
  <div class="chat-header">
    <h3>Conversa com <?= htmlspecialchars($nome_cliente) ?></h3>
  </div>

  <div class="mensagens">
    <?php if (!empty($mensagens)): ?>
      <?php foreach ($mensagens as $mensagem): 
        $classe = ($mensagem['remetente'] == 'proprietario') ? 'proprietario' : 'cliente';
        // Define o nome que aparece na conversa
        $nome_remetente = ($classe == 'proprietario') ? 'Você' : htmlspecialchars($nome_cliente);
      ?>
        <div class="mensagem <?= $classe ?>">
          <strong><?= $nome_remetente ?>:</strong> 
          <?= htmlspecialchars($mensagem['mensagem']) ?>
          <small><?= date('d/m/Y H:i', strtotime($mensagem['data_envio'])) ?></small>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center text-muted">Sem mensagens ainda.</p>
    <?php endif; ?>
  </div>

  <!-- formulário -->
</div>
