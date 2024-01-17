<a href="/admin/posts" class="btn btn-secondary mb-4">Назад</a>

<div class="row row-cols-1 ">
    <form action="/admin/createPost" method="post" enctype="multipart/form-data">
        <label class="form-label">Превью</label>
        <div class="mb-3">
            <img src="<?= IMAGES; ?>placeholder_600x400.svg" class="img-thumbnail" width="432px" alt="...">
            <input type="file" name="preview" id="upload" hidden>
            <div class="clearfix mt-2 d-grid col-4">
                <label for="upload" class="btn btn-primary mb-1">Выбрать превью</label>
                <!--                <input type="submit" name="download-preview" value="Загрузить" class="btn btn-success">-->
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" name="status" type="checkbox" role="switch"
                       id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">Выбрать статус</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Категория</label>
            <select name="category" class="form-select" aria-label="Default select example">
                <?php foreach ($data as $key => $value) : ?>
                    <option value="<?= $value[0]; ?>"><?= $value[1]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputTitle" class="form-label">Название</label>
            <input type="text" name="title" class="form-control" id="exampleInputTitle"
                   value="">
        </div>
        <div class="mb-3">
            <label for="exampleInputUrl" class="form-label">ЧПУ</label>
            <input type="text" name="slug" class="form-control" id="exampleInputUrl"
                   value="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                      rows="20"></textarea>
        </div>
        <button type="submit" name="save_post" class="btn btn-success">Сохранить</button>
    </form>
</div>