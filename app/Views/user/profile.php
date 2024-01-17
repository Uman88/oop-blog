<?php

use App\Widgets\MetaWidget;
use App\Widgets\AlertWidget;

MetaWidget::setTitle('Редактирования профиля');
echo AlertWidget::getFlash('alert', 'message');
?>
<div class="mb-5">
    <h1>Редактирования профиля</h1>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <form action="/user/profile" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Почта</label>
            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                   value="<?= $_SESSION['user']['email']; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Новый пароль</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputRepeatPassword" class="form-label">Подтвердите пароль</label>
            <input type="password" name="repeat-password" class="form-control" id="exampleInputRepeatPassword" required>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>

</div>