<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <h3 class="mb-4">❤️ Meus Favoritos</h3>

    <?php if (!empty($imoveis)): ?>
        <div class="row">
            <?php foreach ($imoveis as $imovel): ?>
                <div style="width: 1000px;" class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="<?= URL_BASE ?>upload/imovel/<?= $imovel['url_foto_imovel']; ?>" 
                             class="card-img-top" 
                             alt="<?= $imovel['nome_imovel']; ?>" 
                             style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body">
                            <p class="card-title"><?= $imovel['nome_imovel']; ?></p>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-map-marker-alt"></i> <?= $imovel['bairro_imovel']; ?>, <?= $imovel['complemento_imovel']; ?>
                            </p>
                            <p class="card-text"><?= mb_strimwidth($imovel['descricao_imovel'], 0, 80, "..."); ?></p>
                            <p class="card-text fw-bold text-success">
                                R$ <?= number_format($imovel['preco_imovel'], 2, ',', '.'); ?>
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="<?= URL_BASE ?>imovel/detalhe/<?= $this->gerarLinkImovel($imovel['id_imovel']); ?>" 
                               class="btn btn-primary">
                                <i class="fas fa-eye"></i> Ver Detalhes
                            </a>
                            <a href="<?= URL_BASE ?>favorito/remover/<?= $imovel['id_imovel']; ?>" 
                               class="btn btn-outline-danger">
                                <i class="fas fa-heart-broken"></i> Remover
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            Você ainda não favoritou nenhum imóvel.
        </div>
    <?php endif; ?>
</div>
