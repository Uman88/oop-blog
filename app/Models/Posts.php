<?php

namespace App\Models;

use App\Core\Model;
use App\Core\SingletonTrait;

class Posts extends Model
{
    use SingletonTrait;

    public $table = 'posts';
}