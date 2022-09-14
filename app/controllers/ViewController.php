<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\MakeTransaction;


class ViewController
{
    public function make(string $vPath, array $data = [], $totals = []): View
    {

        if ($vPath == "/") {
            return View::make('index');
        }

        if ($vPath == "/transactions") {
            $transactions = DBParserController::parseDB();

            $data = MakeTransaction::make($transactions);
            $totals = MakeTransaction::calculateTotals($transactions);
        }

        return View::make($vPath, $data, $totals);
    }
}
