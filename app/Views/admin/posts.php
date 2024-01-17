<?php

use App\Widgets\AlertWidget;

echo AlertWidget::getFlash('alert', 'message');
?>
<h1 class="mb-4">Посты</h1>

<a href="/admin/createPost" class="btn btn-primary mb-4">Создать пост</a>

<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Изображение</th>
        <th scope="col">Название</th>
        <th scope="col">Статус</th>
        <th scope="col">Категория</th>
        <th scope="col">Просмотры</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php $count = 1;
    foreach ($data['posts'] as $key => $post) : ?>
        <tr>
            <th scope="row"><?= $count++; ?></th>
            <?php if (empty($post[6])) : ?>
                <td><img src="<?= IMAGES; ?>placeholder_600x400.svg" class="img-thumbnail" width="120px" alt="..."></td>
            <?php else : ?>
                <td><img src="<?= UPLOADS . $post[6]; ?>" class="img-thumbnail" width="120px" alt="..."></td>
            <?php endif; ?>
            <td><?= mb_strimwidth($post[3], 0, 45, " ..."); ?></td>
            <td><?= $post[2] == 1 ? '<span class="text-success">Опубликован</span>' : '<span class="text-danger">Черновик</span>' ?></td>
            <td><?= $post[11]; ?></td>
            <td><?= $post[7]; ?></td>
            <td>
                <a href="/admin/readPost?id=<?= $post[0]; ?>" class="btn btn-secondary"><i class="bi bi-eye"></i></a>
                <a href="/admin/editPost?id=<?= $post[0]; ?>" class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
                <button type="button" class="btn btn-danger" id="del-post" data-id="<?= $post[0]; ?>"
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Вы точно хотите удалить пост?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <span id="del-link-post"></span>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php for ($p = 1; $p <= $data['total_page']; $p++) : ?>
                <li class="page-item">
                    <a class="page-link" href="/admin/posts?page=<?= $p; ?>"><?= $p; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>