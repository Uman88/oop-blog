<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;
use App\Models\Posts;
use App\Models\User;
use App\Widgets\AlertWidget;

class AdminController extends Controller
{
    /**
     * Главная страница админки
     *
     * @return mixed|null
     */
    public function index()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        return $this->render('/admin/index');
    }

    /**
     * Страница пользователей
     *
     * @return mixed|null
     */
    public function users()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        $users = User::getInstance()->findAll();

        return $this->render('/admin/users', $users);
    }

    /**
     * Страница категорий
     *
     * @return mixed|null
     */
    public function categories()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        $categories = Category::getInstance()->findAll();

        return $this->render('/admin/categories', $categories);
    }

    /**
     * Страница постов
     *
     * @return mixed|null
     */
    public function posts()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
        $offset = $limit * ($page - 1);
        $count_row = Posts::getInstance()->where('status', 1)->countRow();
        $total_page = ceil($count_row / $limit);

        $posts = Posts::getInstance()
            ->join('join')
            ->joinTable('category')
            ->where('posts.category_id', 'category.id')
            ->limit($limit)
            ->offset($offset)
            ->findAll();

        $data = [
            'posts' => $posts,
            'total_page' => $total_page
        ];

        return $this->render('/admin/posts', $data);
    }

    /* Category CRUD */

    /**
     * Создания категорий
     *
     * @return mixed|null
     */
    public function create()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = check_input($_POST['title']);
            $alias = check_input($_POST['alias']);

            if (Category::getInstance()->insert(['title' => $title, 'alias' => $alias]) == $this->true) {
                AlertWidget::setFlash('success', 'Категория создана!');
                return $this->redirect('/admin/categories');
            }
        }

        return $this->render('/admin/category/create');
    }

    /**
     * Просмотр категории
     *
     * @return mixed|null
     */
    public function read()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        $id = check_input($_GET['id']) ?? null;
        $category = Category::getInstance()->where('id', $id)->findOne();

        return $this->render('/admin/category/read', $category);
    }

    /**
     * Редактирования категорий
     *
     * @return mixed|null
     */
    public function edit()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        $id = check_input($_GET['id']) ?? null;
        $category = Category::getInstance()->where('id', $id)->findOne();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = check_input($_POST['title']);
            $alias = check_input($_POST['alias']);

            if (Category::getInstance()->where('id', $id)->update(['title' => $title, 'alias' => $alias]) == $this->true) {
                AlertWidget::setFlash('success', 'Категория отредактирована!');
                return $this->redirect('/admin/categories');
            }
        }

        return $this->render('/admin/category/edit', $category);
    }

    /**
     * Удаления категорий
     *
     * @return void|null
     */
    public function deleteCategory()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = check_input($_GET['id']) ?? null;

            if (Category::getInstance()->where('id', $id)->delete() == $this->true) {
                AlertWidget::setFlash('success', 'Категория удалена!');
                return $this->redirect('/admin/categories');
            }
        }
    }

    /* Posts CRUD */

    /**
     * Создания поста
     *
     * @return mixed|null
     */
    public function createPost()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        $category = Category::getInstance()->findAll();


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_post'])) {
            $fileTMPPath = $_FILES['preview']['tmp_name'];
            $fileName = $_FILES['preview']['name'];

            $path = UPLOADS . $fileName;

            if (!is_dir(UPLOADS)) {
                mkdir(UPLOADS);
                chmod(UPLOADS, 0777);
            }

            if (isset($_POST['status']) == 'on') {
                $status = $_POST['status'] = 1;
            } else {
                $status = 0;
            }

            $category = check_input($_POST['category']);
            $title = check_input($_POST['title']);
            $slug = check_input($_POST['slug']);
            $description = check_input($_POST['description']);
            $timestamp = strtotime(date('Y-m-d H:i:s'));

            $array = [
                'status' => $status,
                'category_id' => $category,
                'title' => $title,
                'post_slug' => $slug,
                'description' => $description,
                'images' => $fileName ? $fileName : null,
                'created_at' => $timestamp,
            ];

            if (is_uploaded_file($fileTMPPath) && move_uploaded_file($fileTMPPath, $path)) {
                if (Posts::getInstance()->insert($array) == $this->true) {
                    AlertWidget::setFlash('success', 'Пост Создан!');
                    return $this->redirect("/admin/posts");
                } else {
                    AlertWidget::setFlash('danger', 'Пост не создан!');
                    return $this->redirect("/admin/post");
                }
            } else {
                if (Posts::getInstance()->insert($array) == $this->true) {
                    AlertWidget::setFlash('success', 'Пост Создан!');
                    return $this->redirect("/admin/posts");
                } else {
                    AlertWidget::setFlash('danger', 'Пост не создан!');
                    return $this->redirect("/admin/post");
                }
            }
        }

        return $this->render('/admin/post/createPost', $category);
    }

    /**
     * Промотр поста
     *
     * @return mixed|null
     */
    public function readPost()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        $id = check_input($_GET['id']) ?? null;

        $posts = Posts::getInstance()
            ->join('join')
            ->joinTable('category')
            ->on('posts.category_id', 'category.id')
            ->where('posts.id', $id)
            ->findOne();

        return $this->render('/admin/post/readPost', $posts);
    }

    /**
     * Редактирования поста
     *
     * @return mixed|null
     */
    public function editPost()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }
// Получаем id и вытаскиваем
        $id = check_input($_GET['id']) ?? null;

        $posts = Posts::getInstance()
            ->join('join')
            ->joinTable('category')
            ->on('posts.category_id', 'category.id')
            ->where('posts.id', $id)
            ->findOne();

        $category = Category::getInstance()->findAll();

        $data = [
            'post' => $posts,
            'category' => $category,
        ];

// Загрузка превью
        if ($_SERVER['REQUEST_METHOD'] == 'POST'
            && isset($_POST['download-preview'])
            && $_FILES['preview']['error'] === UPLOAD_ERR_OK) {

            $fileTMPPath = $_FILES['preview']['tmp_name'];
            $fileName = $_FILES['preview']['name'];

            $path = UPLOADS . $fileName;

            if (!is_dir(UPLOADS)) {
                mkdir(UPLOADS);
                chmod(UPLOADS, 0777);
            }

            if (is_uploaded_file($fileTMPPath) && move_uploaded_file($fileTMPPath, $path)) {
                if (Posts::getInstance()->where('id', $id)->update(['images' => $fileName]) == $this->true) {
                    AlertWidget::setFlash('success', 'Превью загружена!');
                    return $this->redirect("/admin/editPost?id=$id");
                } else {
                    AlertWidget::setFlash('danger', 'Превью не загружена!');
                    return $this->redirect("/admin/editPost?id=$id");
                }

            }
        }

// Редактирования поста
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['status']) == 'on') {
                $status = $_POST['status'] = 1;
            } else {
                $status = 0;
            }

            $category = check_input($_POST['category']);
            $title = check_input($_POST['title']);

            $slug = check_input(strtolower($_POST['slug']));
            $slug = str_replace(',', '', $slug);
            $slug = str_replace(' ', '_', $slug);

            $description = check_input($_POST['description']);
            $status = check_input($status);
            $timestamp = strtotime(date('Y-m-d H:i:s'));

            $array = [
                'status' => $status,
                'category_id' => $category,
                'title' => $title,
                'post_slug' => $slug,
                'description' => $description,
                'updated_at' => $timestamp,
            ];

            if (Posts::getInstance()->where('id', $id)->update($array) == $this->true) {
                AlertWidget::setFlash('success', 'Пост отредактирован!');
                return $this->redirect("/admin/editPost?id=$id");
            } else {
                AlertWidget::setFlash('danger', 'Ошибка! Пост не отредактирован!');
                return $this->redirect("/admin/editPost?id=$id");
            }

        }

        return $this->render('/admin/post/editPost', $data);
    }

    /**
     * Удаления поста
     *
     * @return null
     */
    public function deletePost()
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = check_input($_GET['id']);
            $post = Posts::getInstance()->where('id', $id)->findOne();

            if (Posts::getInstance()->where('id', $id)->delete() == $this->true) {
                AlertWidget::setFlash('success', 'Пост удален!');
                if (!empty($post[5])) {
                    unlink(UPLOADS . $post[5]);
                }
                return $this->redirect('/admin/posts');
            } else {
                AlertWidget::setFlash('danger', 'Пост не удален!');
                return $this->redirect('/admin/posts');
            }
        }

        return $this->redirect('/admin/posts');
    }

    /**
     * Удаления превью
     *
     * @return null
     */
    public function deletePreview($id)
    {
        if ($_SESSION['user']['email'] != ADMIN) {
            return $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = check_input($_GET['id']);
            $post = Posts::getInstance()->where('id', $id)->findOne();

            if (Posts::getInstance()->where('id', $id)->update(['images' => null]) == $this->true) {
                unlink(UPLOADS . $post[5]);
                AlertWidget::setFlash('success', 'Превью удалена!');
                return $this->redirect("/admin/editPost?id=$id");
            } else {
                AlertWidget::setFlash('danger', 'Превью не удалена!');
                return $this->redirect("/admin/editPost?id=$id");
            }
        }
    }
}