<h1 class="mb-4">Категория: <?= $data[1]; ?></h1>

<a href="/admin/categories" class="btn btn-secondary mb-4">Назад</a>

<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">id</th>
        <th scope="col">Название</th>
        <th scope="col">Алиас</th>
        <th scope="col">Вид ссылки</th>
    </tr>
    </thead>
    <tbody>
    <?php $count = 1; ?>
    <tr>
        <th scope="row"><?= $count++; ?></th>
        <td><?= $data[0]; ?></td>
        <td><?= $data[1]; ?></td>
        <td><?= $data[2]; ?></td>
        <td><?= 'http://' . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR . $data[2]; ?></td>
    </tr>
    </tbody>
</table>