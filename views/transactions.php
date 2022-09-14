<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($this->data)) : ?>
                <?php foreach ($this->data as $row) : ?>
                    <tr>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['checkNumber'] ?></td>
                        <td><?= $row['description'] ?></td>

                        <?php if (str_replace(['$'], '', $row['amount']) < 0) : ?>
                            <td style="color: red;"><?= $row['amount'] ?></td>
                        <?php endif ?>

                        <?php if (str_replace(['$'], '', $row['amount']) > 0) : ?>
                            <td style="color: green;"><?= $row['amount'] ?></td>
                        <?php endif ?>

                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <?= $this->totals['totalIncome'] ?? 0 ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <?= $this->totals['totalExpense'] ?? 0 ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td>
                    <?= $this->totals['netTotal'] ?? 0 ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>