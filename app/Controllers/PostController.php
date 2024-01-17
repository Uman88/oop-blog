<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Posts;

class PostController extends Controller
{
    public function view()
    {
        $id = check_input($_GET['id']) ?? null;
        $data = Posts::getInstance()->where('id', $id)->findOne();
        $setViewed = Posts::getInstance()->where('id', $id)->findOne();
        $view = $setViewed[7] += 1;
        Posts::getInstance()->where('id', $id)->update(['views' => $view]);

        return $this->render('post/view', $data);
    }
}