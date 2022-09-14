<?php

declare(strict_types=1);

namespace App;

class DateFormater
{
    static function formatDate(string $date): string
    {
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d');
        return $date;
    }
}
