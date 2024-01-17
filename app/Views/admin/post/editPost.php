<?php

use App\Widgets\AlertWidget;

echo AlertWidget::getFlash('alert', 'message');
?>
<h1 class="mb-4">Пост: <?= $data['post'][3]; ?></h1>

<a href="/admin/posts" class="btn btn-secondary mb-4">Назад</a>

<div class="row row-cols-1 ">
    <form action="/admin/editPost?id=<?= $data['post'][0]; ?>" method="post" enctype="multipart/form-data">
        <label class="form-label">Превью</label>
        <div class="mb-3">
            <?php if (empty($data['post'][6])) : ?>
                <img src="<?= IMAGES; ?>placeholder_600x400.svg" class="img-thumbnail" width="432px" alt="...">
            <?php else: ?>
                <img src="<?= UPLOADS . $data['post'][6]; ?>" class="img-thumbnail" width="432px" alt="...">
            <?php endif; ?>
            <input type="file" name="preview" id="upload" hidden>
            <?php if (empty($data['post'][6])) : ?>
                <div class="clearfix mt-2 d-grid col-4">
                    <label for="upload" class="btn btn-primary mb-1">Выбрать превью</label>
                    <input type="submit" name="download-preview" value="Загрузить" class="btn btn-success">
                </div>
            <?php else: ?>
                <div class="clearfix mt-2 d-grid col-4">
                    <a href="/admin/deletePreview?id=<?= $data['post'][0]; ?>" class="btn btn-danger">Удалить превью</a>
                </div>
            <?php endif; ?>
        </div>
    </form>

    <form method="post" action="/admin/editPost?id=<?= $data['post'][0]; ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <div class="form-check form-switch">
                <?php if ($data['post'][2] == 1) : ?>
                    <input class="form-check-input" name="status" type="checkbox" role="switch"
                           id="flexSwitchCheckChecked" checked>
                <?php else: ?>
                    <input class="form-check-input" name="status" type="checkbox" role="switch"
                           id="flexSwitchCheckChecked">
                <?php endif; ?>
                <label class="form-check-label" for="flexSwitchCheckChecked">Выбрать статус</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Категория</label>
            <select name="category" class="form-select" aria-label="Default select example">
                <option value="<?= $data['post'][1]; ?>" selected><?= $data['post'][11]; ?></option>
                <?php foreach ($data['category'] as $cat) : ?>
                    <?php if ($cat[1] != $data['post'][11]) : ?>
                        <option value="<?= $cat[0]; ?>"><?= $cat[1]; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputTitle" class="form-label">Название</label>
            <input type="text" name="title" class="form-control" id="exampleInputTitle"
                   value="<?= $data['post'][3]; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputSlug" class="form-label">ЧПУ</label>
            <input type="text" name="slug" class="form-control" id="exampleInputSlug"
                   value="<?= $data['post'][4]; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                      rows="20"><?= $data['post'][5]; ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Обновить</button>
    </form>
</div>