<?php

namespace App\Models;

use App\Core\Model;
use App\Core\SingletonTrait;

class User extends Model
{
    use SingletonTrait;

    public $table = 'users';
}