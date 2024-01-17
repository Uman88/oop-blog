<h1 class="mb-4">Пост: <?= $data[3]; ?></h1>

<a href="/admin/posts" class="btn btn-secondary mb-4">Назад</a>

<table class="table table-dark table-hover">
    <tr>
        <td class="w-25 fw-bolder">id</td>
        <td><?= $data[0]; ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">Изображение</td>
        <?php if (empty($data[6])) : ?>
            <td><img src="<?= IMAGES; ?>placeholder_600x400.svg" class="img-thumbnail" width="120px" alt="..."></td>
        <?php else : ?>
            <td><img src="<?= UPLOADS . $data[6]; ?>" class="img-thumbnail" width="120px" alt="..."></td>
        <?php endif; ?>
    </tr>
    <tr>
        <td class="fw-bolder">Название</td>
        <td><?= $data[3]; ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">ЧПУ</td>
        <td><?= $data[4]; ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">Описание</td>
        <td><?= $data[5]; ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">Статус</td>
        <td><?= $data[2] == 1 ? '<span class="text-success">Опубликован</span>' : '<span class="text-danger">Черновик</span>' ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">Категория</td>
        <td><?= $data[11]; ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">Промотры</td>
        <td><?= $data[7]; ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">Дата создания</td>
        <td><?= date('Y-m-d H:i:s', $data[8]); ?></td>
    </tr>
    <tr>
        <td class="fw-bolder">Дата обновления</td>
        <td><?= date('Y-m-d H:i:s', $data[9]); ?></td>
    </tr>
</table>