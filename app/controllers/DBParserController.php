<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Parser;

class DBParserController
{
    static function parseDB(): array
    {
        $data = (new Parser)->parseDB();
        if (empty($data)) {
            $data = [];
        }

        return $data;
    }
}
