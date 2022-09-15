<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\DBCommitException;

class createDB extends DBModel
{
    public function create(int $count, array $files): void
    {
        $parser = new Parser;
        $data = $parser->parseFile($count, $files);

        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare('INSERT INTO transactions (date, checkNumber, description, amount, namedCurrency)
                                        VALUES (:date, :checkNumber, :description, :amount, "USD")');


            foreach ($data as $value) {
                $countData = count($value);

                for ($i = 0; $i < $countData; ++$i) {

                    $stmt->bindValue('date', $value[$i]['date']);
                    $stmt->bindValue('checkNumber', $value[$i]['checkNumber']);
                    $stmt->bindValue('description', $value[$i]['description']);
                    $stmt->bindValue('amount', $value[$i]['amount']);

                    $stmt->execute();
                }
            }

            $this->db->commit();
        } catch (\Exception) {
            if ($this->db->inTransaction()) {
                $this->db->rollback();
            }
            throw new DBCommitException;
        }
    }
}
