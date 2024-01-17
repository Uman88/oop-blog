<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Widgets\AlertWidget;
use App\Models\User;

class UserController extends Controller
{
    public function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = check_input($_POST['name']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = check_input($_POST['password']);

            $check_email = User::getInstance()->where('email', $email)->findOne();

            if ($email == isset($check_email[3])) {
                AlertWidget::setFlash('warning', 'Такой email уже существует');
            } else {
                $password_hash = crypt($password, PASSWORD_BCRYPT);

                $array_data = [
                    'name' => $name,
                    'password' => $password_hash,
                    'email' => $email
                ];

                if (User::getInstance()->insert($array_data) == $this->true) {
                    AlertWidget::setFlash('success', 'Вы зарегистрированы!');
                    return $this->redirect('/user/login');
                }
            }
        }

        if (isset($_SESSION['user'])) {
            return $this->redirect('/');
        }

        return $this->render('user/registration');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = check_input($_POST['password']);

            $password_hash = crypt($password, PASSWORD_BCRYPT);

            $check_user = User::getInstance()->andWhere('email', $email, 'password', $password_hash)->findOne();

            if ($check_user == $this->true) {
                $_SESSION['user'] = [
                    'id' => $check_user[0],
                    'name' => $check_user[1],
                    'email' => $check_user[3],
                    'role' => $check_user[4],
                ];

                if ($_SESSION['user']['email'] == ADMIN) {
                    return $this->redirect('/admin/index');
                }
            } elseif (isset($check_user[3]) != $email && isset($check_user[2]) != $password_hash) {
                AlertWidget::setFlash('danger', 'Вы ввели не правильно почту или пароль!');
                return $this->redirect('/user/login');
            }
        }

        if (isset($_SESSION['user'])) {
            return $this->redirect('/');
        }

        return $this->render('user/login');
    }


    public function profile()
    {
        if (isset($_SESSION['user']['email']) != ADMIN) {
            return $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_SESSION['user']['id'];
            $password = check_input($_POST['password']);
            $repeat_password = check_input($_POST['repeat-password']);

            if ($password === $repeat_password) {
                $password_hash = crypt($password, PASSWORD_BCRYPT);

                if (User::getInstance()->where('id', $id)->update(['password' => $password_hash]) == $this->true) {
                    AlertWidget::setFlash('success', 'Пароль изменен!');
                }
            } else {
                AlertWidget::setFlash('danger', 'Пароли не совпадают!');
            }
        }

        return $this->render('/user/profile');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /user/login');
    }
}