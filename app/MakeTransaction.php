<?php

declare(strict_types=1);

namespace App;

use App\CurrencyModifier;

class MakeTransaction
{
    static function calculateTotals(array $data): array
    {
        $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

        foreach ($data as $transaction) {
            $totals['netTotal'] += $transaction['amount'];

            if ($transaction['amount'] >= 0) {
                $totals['totalIncome'] += $transaction['amount'];
            } else {
                $totals['totalExpense'] += $transaction['amount'];
            }
        }

        foreach ($totals as $key => $value) {
            $totals[$key] = (new CurrencyModifier)->modify($value, $data[0]['namedCurrency']);
        }

        return $totals;
    }

    static function make(array $transactions): array
    {
        foreach ($transactions as $transaction) {
            ['date' => $date, 'checkNumber' => $checkNumber, 'description' => $description, 'amount' => $amount, 'namedCurrency' => $namedCurrency] = $transaction;

            $amount = (new CurrencyModifier)->modify($amount, $namedCurrency);;

            $date = date('M d, Y', strtotime($date));

            $data[] = [
                'date' => $date,
                'checkNumber' => $checkNumber,
                'description' => $description,
                'amount' => $amount,
            ];
        }

        return $data;
    }
}
