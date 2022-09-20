<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Pegination;
use App\MakeTransaction;

class ViewController
{
    public function make(string $vPath): View
    {

        if ($vPath == "/") {
            return View::make('index');
        }

        if ($vPath == '/transactions') {
            $totals = [];

            $paging = new Pegination;
            $data = $paging->getTransactions();

            if (!empty($data)) {
                $totals = MakeTransaction::calculateTotals($data);
                $data = MakeTransaction::make($data);
            }

            $totalPages = $paging->getTotalPages();
        }

        return View::make($vPath, $data, $totals, $totalPages);
    }
}
