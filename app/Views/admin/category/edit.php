<h1 class="mb-4">Категория: <?= $data[1]; ?></h1>

<a href="/admin/categories" class="btn btn-secondary mb-4">Назад</a>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <form method="post" action="/admin/edit?id=<?= $data[0] ?>">
        <div class="mb-3">
            <label for="exampleInputTitle" class="form-label">Название категории</label>
            <input type="text" name="title" class="form-control" id="exampleInputTitle" value="<?= $data[1]; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputAlias" class="form-label">Название в алиаса</label>
            <input type="text" name="alias" class="form-control" id="exampleInputAlias" value="<?= $data[2]; ?>">
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>