<a href="/admin/categories" class="btn btn-secondary mb-4">Назад</a>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <form method="post" action="/admin/create">
        <div class="mb-3">
            <label for="exampleInputTitle" class="form-label">Название</label>
            <input type="text" name="title" class="form-control" id="exampleInputTitle">
        </div>
        <div class="mb-3">
            <label for="exampleInputAlias" class="form-label">Алиас</label>
            <input type="text" name="alias" class="form-control" id="exampleInputAlias">
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>