<?php
// Import třídy CsvDatabase z externího souboru 'CsvDatabase.php'
require_once 'CsvDatabase.php';

// Kontrola, zda je požadavek HTTP POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání indexu záznamu, který má být smazán, z POST dat (předpokládá se, že index je předán z formuláře)
    $index = $_POST['index'];

    // Vytvoření instance třídy CsvDatabase s názvem souboru 'data.csv' a 'deleted_data.csv'
    $csvDatabase = new CsvDatabase('data.csv', 'deleted_data.csv');

    // Volání metody deleteData třídy CsvDatabase pro smazání záznamu podle zadaného indexu
    $csvDatabase->deleteData($index);

    // Smazání bylo úspěšné
    echo "<p>Záznam byl úspěšně smazán.</p>";
    // Zobrazení tlačítka pro návrat na hlavní stránku
    echo '<a href="index.php"><button>Home</button></a>';
} else {
    // Pokud není požadavek POST, zobrazí se chybová zpráva
    echo "<p>Chyba: Neplatný požadavek.</p>";
}
?>
