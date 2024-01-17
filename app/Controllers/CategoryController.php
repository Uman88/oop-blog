<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;
use App\Models\Posts;

class CategoryController extends Controller
{
    public function index()
    {
        $id = check_input($_GET['id']);

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 6;
        $offset = $limit * ($page - 1);
        $count_row = Posts::getInstance()->andWhere('status', 1, 'category_id', $id)->countRow();
        $total_page = ceil($count_row / $limit);

        $posts = Posts::getInstance()->limit($limit)->offset($offset)->findAll();

        $data = [
            'posts' => $posts,
            'total_page' => $total_page
        ];

        return $this->render('category/index', $data);
    }
}