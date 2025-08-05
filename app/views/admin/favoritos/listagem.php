<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container">
<h3 class="mb-4">📋 Lista de Favoritos</h3>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach ($favoritos as $favorito): ?>
      <div class="col">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <p class="card-text mb-1"><strong>Nome do Cliente:</strong> <?= $favorito['nome_cliente']; ?></p>
            <p class="card-text mb-1"><strong>Nome do Imovel:</strong> <?= $favorito['nome_imovel']; ?></p>
            <p class="card-text mb-1">
            <p class="card-text mb-1"><strong>Data:</strong> <?= $favorito['data_favorito']; ?></p>
          </div>
          <div class="card-footer bg-white border-0 text-center">
            <div class="mb-2">
            </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

