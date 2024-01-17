<?php

namespace App\Widgets;

class MetaWidget
{
    public static $title;

    /**
     * Получаем тайтл
     *
     * @param $title
     * @return void
     */
    public static function setTitle($title)
    {
        self::$title = $title;
    }

    /**
     * Выводим тайтл
     *
     * @return mixed
     */
    public static function getTitle()
    {
        return self::$title;
    }
}