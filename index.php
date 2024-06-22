<!DOCTYPE html>
<html lang="cs">
<head>
    <!-- Deklarace a nastavení -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Odkaz na externí CSS pro stylizaci -->
    <title>Data teplot</title> <!-- Název stránky -->
</head>
<body>

<div class="container"> <!-- Kontejner pro obsah stránky -->
    <h2>Zobrazení: datum - čas - teploty ve °C</h2> <!-- Nadpis -->

<!-- Tabulka pro zobrazení teplot -->
<table>
       

<?php

// PHP blok pro čtení a zpracování CSV souboru s daty teplot
$csvFile = 'data.csv'; // Cesta k CSV souboru

$fileHandle = fopen($csvFile, 'r'); // Otevření souboru pro čtení

if ($fileHandle === false) {
     die("Nelze otevřít soubor: $csvFile"); // Pokud se soubor nepodaří otevřít, ukončí běh skriptu
    }

// Čtení řádků z CSV souboru a vytvoření řádků tabulky
while (($row = fgetcsv($fileHandle)) !== false) {
    echo "<tr>"; // Začátek řádku tabulky

foreach ($row as $cell) {
    $data = explode(";", $cell); // Rozdělení buňky podle oddělovače ";"

// Vytvoření buněk tabulky s převedením obsahu na bezpečný text
foreach ($data as $value) {
    echo "<td>" . htmlspecialchars($value) . "</td>";
            }
        }

    echo "</tr>"; // Uzavření řádku tabulky
    }

    fclose($fileHandle); // Uzavření souboru
?>

</table>

 <!-- Formulář pro smazání dat -->
    <h2>Smazat data</h2>
    <form action="delete.php" method="post">
        <label for="index">Vyberte záznam k odstranění:</label>
        <select id="index" name="index">

    <?php
// PHP blok pro načtení a zobrazení možností pro výběr záznamů k odstranění
    $fileHandle = fopen($csvFile, 'r'); // Otevření souboru pro čtení

    if ($fileHandle === false) {
        die("Nelze otevřít soubor: $csvFile"); // Pokud se soubor nepodaří otevřít, ukončí běh skriptu
        }

    $index = 0;
        while (($row = fgetcsv($fileHandle)) !== false) {
        echo "<option value=\"$index\">" . htmlspecialchars($row[0]) . "</option>"; // Možnost pro výběr záznamu
        $index++;
        }

        fclose($fileHandle); // Uzavření souboru
    ?>

    </select>
    <button type="submit">Smazat</button> <!-- Tlačítko pro odeslání formuláře -->
    </form>

    <!-- Formulář pro vložení nových dat -->
    <h2>Vložit data</h2>
    <form id="insertForm">
        <label for="date">Datum:</label>
        <input type="datetime-local" id="date" name="date" required><br><br>
        <label for="high_temp">Nejvyšší teplota:</label>
        <input type="number" id="high_temp" name="high_temp" step="0.01" required><br><br>
        <label for="low_temp">Nejnižší teplota:</label>
        <input type="number" id="low_temp" name="low_temp" step="0.01" required><br><br>
        <label for="normal_high_temp">Průměrná nejvyšší teplota:</label>
        <input type="number" id="normal_high_temp" name="normal_high_temp" step="0.01" required><br><br>
        <label for="normal_low_temp">Průměrná nejnižší teplota:</label>
        <input type="number" id="normal_low_temp" name="normal_low_temp" step="0.01" required><br><br>
        <button type="submit">Vložit</button> <!-- Tlačítko pro odeslání formuláře -->
    </form>

    <!-- Formulář pro výběr a aktualizaci dat -->
    <h2>Vybrat a aktualizovat data</h2>
    <form id="selectForm">
        <label for="select_index">Vyberte záznam k aktualizaci:</label>
        <select id="select_index" name="select_index">

    <?php
    // PHP blok pro načtení a zobrazení možností pro výběr záznamů k aktualizaci
        $fileHandle = fopen($csvFile, 'r'); // Otevření souboru pro čtení

        if ($fileHandle === false) {
        die("Nelze otevřít soubor: $csvFile"); // Pokud se soubor nepodaří otevřít, ukončí běh skriptu
        }

        $index = 0;
        while (($row = fgetcsv($fileHandle)) !== false) {
            echo "<option value=\"$index\">" . htmlspecialchars($row[0]) . "</option>"; // Možnost pro výběr záznamu
            $index++;
        }

        fclose($fileHandle); // Uzavření souboru
    ?>

    </select>
    <button type="submit">Vybrat</button> <!-- Tlačítko pro odeslání formuláře -->
    </form>

    <!-- Formulář pro aktualizaci vybraného záznamu -->
    <form id="updateForm" style="display:none;">
        <h2>Aktualizovat data</h2>
        <input type="hidden" id="update_index" name="update_index">
        <label for="update_date">Datum:</label>
        <input type="datetime-local" id="update_date" name="update_date" required><br><br>
        <label for="update_high_temp">Nejvyšší teplota:</label>
        <input type="number" id="update_high_temp" name="update_high_temp" step="0.01" required><br><br>
        <label for="update_low_temp">Nejnižší teplota:</label>
        <input type="number" id="update_low_temp" name="update_low_temp" step="0.01" required><br><br>
        <label for="update_normal_high_temp">Průměrná nejvyšší teplota:</label>
        <input type="number" id="update_normal_high_temp" name="update_normal_high_temp" step="0.01" required><br><br>
        <label for="update_normal_low_temp">Průměrná nejnižší teplota:</label>
        <input type="number" id="update_normal_low_temp" name="update_normal_low_temp" step="0.01" required><br><br>
        <button type="submit">Aktualizovat</button> <!-- Tlačítko pro odeslání formuláře -->
    </form>

    <div style="height: 100px;"></div>
</div>

<script src="script.js"></script> <!-- Odkaz na externí JS soubor -->

</body>
</html>