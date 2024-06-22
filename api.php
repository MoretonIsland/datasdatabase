<?php

/* Funkce pro načtení dat z CSV souboru */
function loadData() {
$csvFile = 'data.csv'; // Cesta k CSV souboru
$fileHandle = fopen($csvFile, 'r'); // Otevření souboru pro čtení
if ($fileHandle === false) {
die("Nelze otevřít soubor: $csvFile"); // Ukončení skriptu, pokud soubor nelze otevřít
}

$data = []; // Inicializace pole pro uchování dat
$headers = fgetcsv($fileHandle, 0, ';'); // Načtení hlavičky (první řádek jako hlavička)
while (($row = fgetcsv($fileHandle, 0, ';')) !== false) { // Čtení dat po řádcích.
$rowData = []; // Pole pro uchování dat jednoho řádku
foreach ($headers as $index => $header) {
$rowData[$header] = $row[$index]; // Přiřazení hodnot k příslušným hlavičkám
}
$data[] = $rowData; // Přidání řádku dat do celkového pole dat
}
fclose($fileHandle); // Zavření souboru
return $data; // Vrácení načtených dat
}

/* Funkce pro uložení dat do CSV souboru */
function saveData($data) {
$csvFile = 'data.csv'; // Cesta k CSV souboru
$fileHandle = fopen($csvFile, 'w'); // Otevření souboru pro zápis
if ($fileHandle === false) {
die("Nelze otevřít soubor: $csvFile"); // Ukončení skriptu, pokud soubor nelze otevřít
}

fputcsv($fileHandle, array_keys($data[0]), ';'); // Zápis hlavičky do CSV souboru

foreach ($data as $row) {
fputcsv($fileHandle, $row, ';'); // Zápis dat do CSV souboru
}
fclose($fileHandle); // Zavření souboru
}

// Zpracování GET požadavku pro zobrazení všech dat
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['index'])) {
// Načtení a zobrazení všech dat ve formátu JSON
$data = loadData(); // Načtení dat z CSV souboru
header('Content-Type: application/json'); // Nastavení hlavičky odpovědi na JSON
echo json_encode($data); // Převod dat do JSON formátu a jejich výstup
exit; // Ukončení skriptu
}

// Zpracování POST požadavku pro vložení nebo aktualizaci dat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Zpracování vkládání nových dat
if (isset($_POST['date'], $_POST['high_temp'], $_POST['low_temp'], $_POST['normal_high_temp'], $_POST['normal_low_temp'])) {
// Příprava nových dat pro vložení
$newData = [
'DateTime' => $_POST['date'], // Datum a čas záznamu
'High temperature' => $_POST['high_temp'], 
'Low temperature' => $_POST['low_temp'],
'Normal high temperature' => $_POST['normal_high_temp'], 
'Normal low temperature' => $_POST['normal_low_temp'] 
];

$data = loadData(); // Načtení stávajících dat
$data[] = $newData; // Přidání nových dat do pole
saveData($data); // Uložení aktualizovaných dat do CSV souboru
echo json_encode(['message' => 'Data byla úspěšně vložena']); // Výstup - zpráva
exit; // Ukončení skriptu
}

// Zpracování aktualizace existujících dat
if (isset($_POST['update_index'], $_POST['update_date'], $_POST['update_high_temp'], $_POST['update_low_temp'], $_POST['update_normal_high_temp'], $_POST['update_normal_low_temp'])) {
// Příprava indexu a dat pro aktualizaci
$updateIndex = $_POST['update_index']; // Index aktualizovaného záznamu
$updatedData = [
'DateTime' => $_POST['update_date'], // Datum a čas záznamu
'High temperature' => $_POST['update_high_temp'], 
'Low temperature' => $_POST['update_low_temp'], 
'Normal high temperature' => $_POST['update_normal_high_temp'], 
'Normal low temperature' => $_POST['update_normal_low_temp'] 
];

$data = loadData(); // Načtení stávajících dat
if (isset($data[$updateIndex])) {
// Kontrola existence záznamu pro aktualizaci
$data[$updateIndex] = $updatedData; // Aktualizace dat na zadaném indexu
saveData($data); // Uložení aktualizovaných dat do CSV souboru
echo json_encode(['message' => 'Data byla úspěšně aktualizována']); // Výstup - zprávy
exit; // Ukončení skriptu
} else {
echo json_encode(['message' => 'Index pro aktualizaci nenalezen']); // Výstup - zpráva
exit; // Ukončení skriptu
}
}
}

// Zpracování GET požadavku pro výběr dat k aktualizaci pomocí indexu
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['index'])) {
// Načtení a zobrazení konkrétního záznamu ve formátu JSON
$index = $_GET['index']; // Index vybraného záznamu
$data = loadData(); // Načtení dat z CSV souboru
if (isset($data[$index])) {
// Kontrola existence záznamu
echo json_encode($data[$index]); // Převod záznamu do JSON formátu a jeho výstup
} else {
echo json_encode(['message' => 'Záznam nenalezen']); // Výstup - zpráva
}
exit; // Ukončení skriptu
}

?>