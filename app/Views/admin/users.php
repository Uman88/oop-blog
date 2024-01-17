<h1 class="mb-4">Пользователи</h1>

<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Почта</th>
        <th scope="col">Роль</th>
    </tr>
    </thead>
    <tbody>
    <?php $count = 1; foreach ($data as $key => $user) : ?>
        <tr>
            <th scope="row"><?= $count++; ?></th>
            <td><?= $user[1]; ?></td>
            <td><?= $user[3]; ?></td>
            <td><?= $user[4] == ROLE_ADMIN ? 'Админ' : 'Пользователь' ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>

</table>