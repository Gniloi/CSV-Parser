<?php

declare(strict_types=1);

namespace App;

use App\DBParser;

class Pegination
{
    protected array $data;
    protected float $totalPages;

    public function getTransactions(): array
    {
        $dbParser = new DBParser;

        $perPage = 26;
        $this->totalPages = $dbParser->getTotalPages($perPage);

        $pageNow = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($pageNow - 1) * $perPage;
        $end = $perPage;

        $this->data = $dbParser->parseDB($start, $end);

        return $this->data;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }
}
