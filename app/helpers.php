<?php

declare(strict_types=1);

function formatFromDollar(string $value) {
    $formatted = floatval(str_replace(["$", ","], "", $value));

    return $formatted;
}

function formatToDollar(int|float $number): string {
    $dollarString = (($number < 0 ? "-" : "") . "$" . number_format(abs($number), 2));

    return $dollarString;
}

function calcTotals(array $transactions): array {
    $totals = ["netTotal" => 0, "totalIncome" => 0, "totalExpense" => 0];
    foreach ($transactions as $transaction) {
        if ($transaction["Amount"] < 0) {
            $totals["totalExpense"] += $transaction["Amount"];
        } else {
            $totals["totalIncome"] += $transaction["Amount"];
        }
    }

    $totals["netTotal"] = $totals["totalIncome"] - abs($totals["totalExpense"]);

    return $totals;
}
