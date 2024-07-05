<?php
// Nastavení hlavičky pro JSON výstup
header('Content-Type: application/json');
// Kontrola, zda soubor 'deleted_data.csv' existuje
$deletedFile = 'deleted_data.csv';
if (file_exists($deletedFile)) {
    // Načtení obsahu souboru
    $lines = file($deletedFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // Pole pro ukládání smazaných dat ve formátu JSON
    $deletedData = [];

    // Zpracování řádků CSV souboru
    foreach ($lines as $line) {
        // Rozdělení řádku podle středníku s ignorováním prázdných řádků
        $data = explode(';', $line);

        // Pokud je řádek označen jako hlavička, přeskočíme ho
        if ($data[0] === 'DateTime' && count($data) === 5) {
            continue;
        }

        // Odstranění uvozovek z pole DateTime, pokud jsou přítomny
        $dateTime = trim($data[0], '"');

        // Přidání řádku jako asociativního pole do pole smazaných dat
        $deletedData[] = [
            'DateTime' => $dateTime,
            'High temperature' => isset($data[1]) ? floatval($data[1]) : 0,
            'Low temperature' => isset($data[2]) ? floatval($data[2]) : 0,
            'Normal high temperature' => isset($data[3]) ? floatval($data[3]) : 0,
            'Normal low temperature' => isset($data[4]) ? floatval($data[4]) : 0
        ];
    }

    // Výstup ve formátu JSON
    echo json_encode($deletedData, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['message' => 'Soubor se smazanými daty neexistuje.']);
}
?>
