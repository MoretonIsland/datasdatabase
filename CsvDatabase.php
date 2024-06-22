<?php

// Třída CsvDatabase slouží k práci s daty uloženými v CSV souboru.
class CsvDatabase {
    // Cesta k hlavnímu CSV souboru
    private $filePath;

    // Cesta k souboru pro smazaná data.
    private $deletedFilePath;

    // Konstruktor třídy CsvDatabase
    public function __construct($filePath, $deletedFilePath) {
        $this->filePath = $filePath; // Cesta k hlavnímu CSV souboru
        $this->deletedFilePath = $deletedFilePath; // Cesta k souboru pro smazaná data
    }

    // Načtení dat z hlavního CSV souboru
    public function loadData() {
        $fileHandle = fopen($this->filePath, 'r');
        if ($fileHandle === false) {
            throw new Exception("Nelze otevřít soubor: $this->filePath"); // Pokud se nepodaří otevřít soubor pro čtení
        }

        $data = [];
        while (($row = fgetcsv($fileHandle)) !== false) {
            // Rozdělení řádku podle oddělovače a uložení do pole dat
            $data[] = explode(";", $row[0]);
        }
        fclose($fileHandle);
        return $data;
    }

    // Uložení dat do hlavního CSV souboru
    public function saveData($data) {
        $fileHandle = fopen($this->filePath, 'w');
        if ($fileHandle === false) {
            throw new Exception("Nelze otevřít soubor pro zápis: $this->filePath"); // Když se nepodaří otevřít soubor pro zápis
        }

        foreach ($data as $row) {
            // Uložení každého řádku do CSV souboru jako řetězec oddělený středníkem
            fputcsv($fileHandle, [implode(";", $row)]);
        }
        fclose($fileHandle);
    }

    // Uložení dat do souboru pro smazaná data
    // Smazaná data k uložení
    public function saveDeletedData($data) {
        $fileHandle = fopen($this->deletedFilePath, 'a');
        if ($fileHandle === false) {
            throw new Exception("Nelze otevřít soubor pro zápis: $this->deletedFilePath"); // Pokud se nepodaří otevřít soubor pro zápis
        }

        foreach ($data as $row) {
            // Uložení každého řádku do souboru pro smazaná data jako řetězec oddělený středníkem
            fputcsv($fileHandle, [implode(";", $row)]);
        }
        fclose($fileHandle);
    }

    // Vložení nových dat do hlavního CSV souboru
   
    public function insertData($newData) {
        $data = $this->loadData();
        $data[] = $newData;
        $this->saveData($data);
    }

    // Smazání dat na zadaném indexu z hlavního CSV souboru a uložení dat do souboru pro smazaná data
    // $index Index dat k smazání
    public function deleteData($index) {
        $data = $this->loadData();
        if (isset($data[$index])) {
            $deletedData = $data[$index];
            unset($data[$index]);
            $this->saveData(array_values($data));
            $this->saveDeletedData([$deletedData]);
        }
    }

    // Výběr a vrácení dat na zadaném indexu z hlavního CSV souboru
    // $index Index dat k výběru
    public function selectData($index) {
        $data = $this->loadData();
        if (isset($data[$index])) {
            return $data[$index];
        }
        return null; // Data na zadaném indexu nebo null, pokud index neexistuje
    }

    // Aktualizace dat na zadaném indexu v hlavním CSV souboru
    // $index Index dat k aktualizaci
    public function updateData($index, $updatedData) {
        $data = $this->loadData();
        if (isset($data[$index])) {
            $data[$index] = $updatedData; // Aktualizovaná data
            $this->saveData($data);
        }
    }
}

?>
