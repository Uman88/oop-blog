<?php

use App\Widgets\MetaWidget;

MetaWidget::setTitle('Главная страница');

?>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

    <?php foreach ($data['posts'] as $main)  : ?>
        <div class="col">
            <div class="card">
                <?php if (empty($main[6])): ?>
                    <img src="<?= IMAGES; ?>placeholder_600x400.svg" class="img-thumbnail" width="120px" alt="...">
                <?php else: ?>
                    <img src="<?= UPLOADS . $main[6]; ?>" class="img-thumbnail" width="420px" alt="...">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= mb_strimwidth($main[3], 0, 35, " ..."); ?></h5>
                    <p class="card-text"><?= mb_strimwidth($main[5], 0, 75, " ..."); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="/post/view?id=<?= $main[0]; ?>" class="btn btn-sm btn-outline-secondary">
                                Читать далее
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <small class="text-body-secondary"><?= date('Y-m-d', $main[8]); ?></small>
                    <small class="text-body-secondary"><?= $main[7]; ?> просмотров</small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="mt-4">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php for ($p = 1; $p <= $data['total_page']; $p++) : ?>
                <li class="page-item">
                    <a class="page-link" href="/site/index?page=<?= $p; ?>"><?= $p; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>