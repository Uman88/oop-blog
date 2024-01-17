<?php

namespace App\Models;

use App\Core\Model;
use App\Core\SingletonTrait;

class Category extends Model
{
    use SingletonTrait;

    public $table = 'category';
}