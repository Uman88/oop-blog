<div class="row row-cols-1">
    <div class="mt-4">
        <h1><?= $data[3]; ?></h1>
    </div>

    <?php if (empty($data[6])): ?>
        <img src="<?= IMAGES; ?>placeholder_600x400.svg" width="120px" alt="...">
    <?php else: ?>
        <img src="<?= UPLOADS . $data[6]; ?>" width="1300px" alt="...">
    <?php endif; ?>

    <div class="card-body mt-4">
        <p class="card-text"><?= $data[5]; ?></p>
    </div>
</div>
