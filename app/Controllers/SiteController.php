<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Posts;

class SiteController extends Controller
{
    public function index()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 6;
        $offset = $limit * ($page - 1);
        $count_row = Posts::getInstance()->where('status', 1)->countRow();
        $total_page = ceil($count_row / $limit);

        $posts = Posts::getInstance()
            ->orderBy('created_at', 'desc')
            ->join('join')
            ->joinTable('category')
            ->on('posts.category_id', 'category.id')
            ->limit($limit)
            ->offset($offset)
            ->findAll();

        $data = [
            'posts' => $posts,
            'total_page' => $total_page
        ];

        return $this->render('site/index', $data);
    }

    public function about()
    {
        return $this->render('site/about');
    }

    public function contact()
    {
        return $this->render('site/contact');
    }
}