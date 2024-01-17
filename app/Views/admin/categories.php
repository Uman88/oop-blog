<?php

use App\Widgets\AlertWidget;

echo AlertWidget::getFlash('alert', 'message');
?>
<h1 class="mb-4">Категории</h1>

<a href="/admin/create" class="btn btn-success mb-4">Создать категорию</a>

<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
        <th scope="col">Сылка</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php $count = 1;
    foreach ($data as $key => $cat) : ?>
        <tr>
            <th scope="row"><?= $count++; ?></th>
            <td><?= $cat[1]; ?></td>
            <td id="cat-name"><?= $cat[2]; ?></td>
            <td class="text-center">
                <a href="/admin/read?id=<?= $cat[0]; ?>" class="btn btn-secondary"><i class="bi bi-eye"></i></a>
                <a href="/admin/edit?id=<?= $cat[0]; ?>" class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
                <button type="button" class="btn btn-danger" id="del-cat" data-id="<?= $cat[0]; ?>"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-trash3"></i>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Вы точно хотите удалить категорию?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <span id="del-link-category"></span>
            </div>
        </div>
    </div>
</div>