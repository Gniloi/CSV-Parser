<?php

declare(strict_types=1);

namespace App;

abstract class DBModel
{
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }
}
