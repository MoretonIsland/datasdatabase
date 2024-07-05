<?php
// Nastavení hlavičky pro JSON výstup
header('Content-Type: application/json');

$csvFile = 'data.csv';
$fileHandle = fopen($csvFile, 'r');
if ($fileHandle === false) {
    die(json_encode(['error' => "Nelze otevřít soubor: $csvFile"]));
}

// Přečtěte všechny řádky do pole
$rows = [];
while (($row = fgetcsv($fileHandle, 0, ';')) !== false) {
    $rows[] = $row;
}
fclose($fileHandle);

// Získání posledního řádku (poslední vložená data)
$lastRow = end($rows);

if ($lastRow === false) {
    echo json_encode(['error' => 'Žádná data nebyla nalezena']);
} else {
    echo json_encode([
        'DateTIme' => $lastRow[0],
        'High temperature' => $lastRow[1],
        'Low temperature' => $lastRow[2],
        'Normal_high_temp' => $lastRow[3],
        'Normal_low_temp' => $lastRow[4]
    ], JSON_PRETTY_PRINT);
}


?>
