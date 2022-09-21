<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\FileNotFoundException;

class Parser
{
    public function parseFile(int $count, array $files): array
    {
        $dataArr = [];

        for ($i = 0; $i < $count; ++$i) {
            $filePath = STORAGE_PATH . '/' . $files[$i];

            if (!file_exists($filePath)) {
                throw new FileNotFoundException();
            }

            $file = fopen($filePath, 'r');

            $dataArr[$files[$i]] = $this->getTransaction($file);

            fclose($file);
        }

        return $dataArr;
    }

    public function getTransaction($file, ?callable $transactionHandler = null): array
    {
        $dataArr = [];
        fgetcsv($file);

        while (($data = fgetcsv($file, 0, ',')) != false) {
            if ($transactionHandler != null) {
                $data = $transactionHandler($data);
            }

            $dataArr[] = $this->readTransaction($data);
        }

        return $dataArr;
    }

    public function readTransaction(array $TransactionRow): array
    {
        [$date, $checkNumber, $description, $amount] = $TransactionRow;

        $date = (string) DateFormater::formatDate($date);
        $checkNumber = (int) $checkNumber;
        $amount = (float) str_replace(['$', ','], '', $amount);

        return [
            'date' => $date,
            'checkNumber' => $checkNumber,
            'description' => $description,
            'amount' => $amount,
        ];
    }
}
