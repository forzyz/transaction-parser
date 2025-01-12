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
            <?php if (!empty($parsedData)): ?>
                <tr>
                    <?php foreach ($parsedData[0] as $key => $header): ?>
                        <th><?= $key ?></th>
                    <?php endforeach; ?>

                </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php if (!empty($parsedData)): ?>
                <?php foreach ($parsedData as $transaction): ?>
                    <tr>
                        <?php foreach ($transaction as $key => $value): ?>
                            <td>
                                <?php if ($key === "Amount" && $value < 0): ?>
                                    <span style="color: red">
                                        <?= htmlspecialchars(formatToDollar($value)) ?>
                                    </span>
                                <?php elseif ($key === "Amount"): ?>
                                    <span style="color: green">
                                        <?= htmlspecialchars(formatToDollar($value)) ?>
                                    </span>
                                <?php else: ?>
                                    <?= htmlspecialchars($value) ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <?= htmlspecialchars(formatToDollar($totals["totalIncome"]) ?? 0) ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <?= htmlspecialchars(formatToDollar($totals["totalExpense"]) ?? 0) ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td>
                    <?= htmlspecialchars(formatToDollar($totals["netTotal"]) ?? 0); ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>