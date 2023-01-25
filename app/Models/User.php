<?php

namespace App\Models;

class User extends DB
{
    protected $table = 'users';
    public function __construct()
    {
        parent::__construct();
        $this->creatTable($this->table,"ip VARCHAR(255) NOT Null, username VARCHAR(30) NOT Null, email VARCHAR(100) NOT NULL, password text NOT NULL");
    }

}

