<?php

namespace App\Widgets;

use App\Core\Session;

class AlertWidget extends Session
{
    /**
     * Принимаем месагу и тип алерта и заганяем в сессию
     *
     * @param $alert
     * @param $message
     * @return void
     */
    public static function setFlash($alert, $message)
    {
        parent::setAlert('alert', $alert);
        parent::set('message', $message);
    }

    /**
     * Из сессии получаем месагу и алерт, также формируем HTML вывод алерта с проверкой на пустоту
     *
     * @param $alert
     * @param $key
     * @return string|void
     */
    public static function getFlash($alert, $key)
    {
        if (!empty(parent::getAlert($alert))) {
            return '<div class="alert alert-' . parent::getAlert($alert) . ' alert-dismissible fade show" role="alert">'
                . parent::get($key) . parent::remove($key) . parent::remove($alert) .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
}