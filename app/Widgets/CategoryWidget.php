<?php

namespace App\Widgets;

use App\Models\Category;

/**
 * Class Category Widget
 */
class CategoryWidget
{
    /**
     * Получаем категории
     *
     * @return array
     */
    public static function getCategory()
    {
        return Category::getInstance()->findAll();
    }

    /**
     * Основа выпадающего списка с елементами HTML тэгами,
     * в самом списке могут быть сами категории, а также и не быть.
     * Также можно добавить дополнительную категорию, если в БД нету или ненадо было добавлять.
     * Дополнительная категория имеет такие параметры: название, ссылка, id (у последнего если есть)
     *
     * @param $label // Само название выподающего списка
     * @param $category // Вставка кататегории из БД
     * @param $title //
     * @param $link //
     * @param $id //
     * @return string
     */
    public static function dropdown($label, $category = '', $title = '', $link = '', $id = null)
    {
        if ($id == null) {
            return '
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $label . '</a>
    <ul class="dropdown-menu">'
                . $category . '
        <li>
            <a class="dropdown-item" href="' . $link . '">' . $title . '</a>
        </li>
    </ul>
</li>
';
        } else {
            return '
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $label . '</a>
    <ul class="dropdown-menu">'
                . $category .
                '
        <li>
            <a class="dropdown-item" href="' . $link . '?id=' . $id . '">' . $title . '</a>
        </li>
    </ul>
</li>
';
        }
    }

    /**
     * Вывод категорий для выподающего списка
     *
     * @return string
     */
    public static function dropdownItem()
    {
        $category = self::getCategory();

        $li = '';
        foreach ($category as $key => $value) {
            $li .= '<li><a class="dropdown-item" href="/category/index' . '?id=' . $value[0] . '">' . $value[1] . '</a></li>';
        }

        return $li;
    }


    /**
     * Вывод категорий в навбаре обычном списке, отдельно если не желаем в выпадающем списке
     *
     * @return string
     */
    public static function category()
    {
        $category = self::getCategory();

        $li = '<li><a class="nav-link active" href="/' . $category[0][2] . '/index?id=' . $category[0][0] . '">' . $category[0][1] . '</a></li>';
        $li .= '<li><a class="nav-link active" href="/' . $category[1][2] . '/index?id=' . $category[1][0] . '">' . $category[1][1] . '</a></li>';
        $li .= '<li><a class="nav-link active" href="/' . $category[2][2] . '/index?id=' . $category[2][0] . '">' . $category[2][1] . '</a></li>';
        return $li;
    }

    /**
     * Создаем выподающий список для выподающего профиля
     *
     * @param $category
     * @return string
     */
    public static function customItem($category = [])
    {
        $li = '';
        foreach ($category as $key => $value) {
            $li .= '<li><a class="dropdown-item" href="' . $value . '">' . $key . '</a></li>';
        }
        return $li;
    }
}