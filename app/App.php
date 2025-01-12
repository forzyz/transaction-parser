<?php

declare(strict_types=1);

function rowFormatting(string $row): int|float {
    $result = floatval(str_replace(["$", ","], "", $row));
    return $result;
}

function formatTransactions(array $keys, array $values): array {
    $assArray = [];

    foreach ($values as $key => $val) {
        if ($keys[$key] === "Date") {
            $assArray[$keys[$key]] = date("M j, Y", strtotime($val));
            continue;
        }

        if ($keys[$key] === "Amount") {
            $assArray[$keys[$key]] = formatFromDollar($val);
            continue;
        }

        $assArray[$keys[$key]] = $val;
    }

    return $assArray;
}

function getTransactionFiles(string $dirPath): array {
    $files = [];

    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        }

        $files[] = $dirPath . $file;
    }

    return $files;
}

function readFiles(string $filePath, ?callable $transactionHandler = null): array {
    if (!file_exists($filePath)) {
        trigger_error('File "' . $filePath . '" does not exists.', E_USER_ERROR);
    }

    $file = fopen($filePath, "r");
    $headers = [];
    $transactions = [];
    $firstIteration = true;

    while (($line = fgetcsv($file)) !== false) {
        if ($firstIteration) {
            $headers = $line;
            $firstIteration = false;
            continue;
        }

        if ($transactionHandler !== null) {
            $transactions[] = $transactionHandler($headers, $line);
            continue;
        }

        $transactions[] = $line;
    }

    fclose($file);

    return $transactions;
}
