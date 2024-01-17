<?php

use App\Widgets\AlertWidget;
use App\Widgets\MetaWidget;

MetaWidget::setTitle('Авторизация');
echo AlertWidget::getFlash('alert', 'message');
?>
<div class="mb-5">
    <h1>Авторизация</h1>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <form method="post" action="/user/login">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Почта</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
