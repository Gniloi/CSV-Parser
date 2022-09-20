<?php

declare(strict_types=1);

namespace App;

class DBParser extends DBModel
{
    protected array $data;
    protected array $totals;
    protected float $totalPages;

    public function getTransactions(): array
    {
        return $this->data;
    }

    public function getTotals(): array
    {
        return $this->totals;
    }

    public function parseDB(int $start, int $end)
    {
        $query = 'SELECT date, checkNumber, description, amount, namedCurrency FROM transactions ORDER BY id LIMIT ' . $start . ',' . $end;

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        $this->data = $stmt->fetchALL();

        return $this->data;
    }

    public function getTotalPages(int $perPage): float
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM transactions');

        $stmt->execute();

        $entries = $stmt->fetchColumn();

        $this->totalPages = ceil($entries / $perPage);

        return $this->totalPages;
    }
}
