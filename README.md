# datasdatabase

Tento projekt weather_API_2 je API umožňující manipulaci s daty mezi klientem a serverem. Jako databáze je použita CSV databáze. API podporuje základní CRUD operace (Create, Read, Update, Delete) a vrací odpovědi ve formátu JSON.

Obsah
-	Struktura projektu
-	API endpointy
-	Popis souborů
-	Struktura databáze
-	Příručka pro vývojáře


Struktura projektu weather_API_2
├── api.php
├── CsvDatabase.php
├── data.csv
├── delete.php
├── deleted.php
├── deleted_data.csv
├── index.php
├── showInsertedData.php
├── style.css
├── script.js
└── README.md

API Endpointy

V tomto projektu jsou endpointy obsaženy v souborech api.php a delete.php. Tyto soubory obsahují logiku, která zpracovává příchozí HTTP požadavky a provádí operace s databází dat.

Endpointy v souboru api.php:
URL: /api.php
Endpoint pro vkládání nových záznamů meteorologických dat do databáze:
Create (Insert)
Metoda: POST
Údaje: 
date (string): Datum meteorologických dat.
high_temp (float): Nejvyšší teplota.
low_temp (float): Nejnižší teplota.
normal_high (float): Nejvyšší průměrná teplota.
normal_low (float): Nejnižší průměrná teplota.
Funkcí je obsluha POST požadavků a vkládání nových záznamů do databáze.

Read (Select)
Metoda: GET
Endpoint vrací všechny existující záznamy meteorologických dat uložených v databázi.
Funkcí je získání a vrácení všech záznamů z databáze ve formátu JSON pole.

Update
Metoda: PUT
Zde endpoint aktualizuje existující záznam o meteorologických datech v databázi podle zadaného indexu.
Parametry:
index (int): index záznamu, který má být aktualizován
date (string): nové datum
high_temp: nová nejvyšší teplota.
low_temp: nová nejnižší teplota.
normal_high: nová nejvyšší průměrná teplota.
normal_low: nová nejnižší průměrná teplota.
Funkcí je zpracování PUT požadavků pro aktualizaci existujících záznamů v databázi.

Endpoint v souboru delete.php:
Delete
URL: /delete.php
Metoda: POST
Zde endpoint odstraňuje záznam dat z databáze podle zadaného indexu.
Parametry:
index (int): index záznamu, který má být smazán
Funkcí je odstranění záznamu dat z databáze na základě specifikovaného indexu.

Popis souborů

soubor CsvDatabase.php
Obsahuje třídu CsvDatabase, která zajišťuje interakci s CSV soubory.
Funkce:
- insert: Vloží nová data do CSV souboru.
- getAll: Načte všechna data z CSV souboru.
- update: Aktualizuje záznam v CSV souboru.
- delete: Odstraní záznam z CSV souboru a přesune ho do deleted_data.csv.

soubor api.php
Zpracovává API požadavky na vytvoření, načtení a aktualizaci dat.
Funkce: 
Zpracovává POST, GET a PUT požadavky. Používá třídu CsvDatabase pro operace s databází.
soubor delete.php
Zpracovává požadavky na smazání záznamů z data.csv.
Funkce:
Přijímá index záznamu, který má být smazán. Přesouvá smazaný záznam do souboru deleted_data.csv.

soubor deleted.php
Zobrazuje záznamy, které byly smazány.
Funkce:
Zpracovává data ze souboru deleted_data.csv jako CSV soubor a výsledek je poskytován ve formátu JSON.

soubor data.csv
Obsahuje hlavní záznamy dat.
Struktura: Obsahuje tato data: datum, nejvyšší teplota, nejnižší teplota, nejvyšší průměrná teplota a nejnižší průměrná teplota.

soubor deleted_data.csv
Ukládá záznamy, které byly smazány ze souboru data.csv.
Struktura je stejná jako v souboru data.csv.

soubor index.php
Hlavní rozhraní pro uživatele k vložení a zobrazení dat.
Funkce:
Poskytuje HTML formuláře pro zadávání dat.
Používá AJAX (přes script.js) pro odesílání formulářových dat.

soubor showInsertedData.php
Zobrazuje všechna vložená data.
Funkce:
Načítá data z data.csv a zobrazuje je v HTML tabulce.

soubor script.js
Přidává interaktivitu do index.php.
Funkce:
Zpracovává odesílání formuláře pomocí AJAX. Načítá a zobrazuje data z API.

soubor style.css
Poskytuje styly pro HTML prvky.

Struktura databáze
Databáze se skládá ze dvou CSV souborů, souboru data.csv a souboru deleted_data.csv.

soubor data.csv
Struktura:
Soubor data.csv obsahuje data, která jsou uspořádána do řádků. Hodnoty teplot jsou udány ve stupních Celsia.

Popis řádků:
DateTime: Datum a čas měření ve formátu ISO 8601 (YYYY-MM-DDTHH:MM)
High temperature: Nejvyšší naměřená teplota v daný den
Low temperature: Nejnižší naměřená teplota v daný den
Normal high temperature: Nejvyšší průměrná teplota pro daný den 
Normal low temperature: Nejnižší průměrná teplota pro daný den 

Každý řádek v souboru data.csv odpovídá jednomu dni a obsahuje informace o naměřených teplotách a jejich průměrných hodnotách pro udaný den.

DateTime;High temperature;Low temperature;Normal high temperature;Normal low temperature
2024-01-04T00:00;2.22;-3.33;0;-7.22
2024-01-05T00:00;3.89;-4;0;-7.78
2024-01-06T00:00;2.78;1.11;0;-7.78

soubor deleted_data.csv
Má stejnou strukturu jako soubor data.csv.

Příručka pro vývojáře
Klientská Strana: Použijte soubor index.php pro odesílání a zobrazení dat.
Serverová Strana: Přidejte nebo upravte funkce v api.php a CsvDatabase.php pro nové endpointy nebo změny v logice.
Styly: Upravte style.css pro změnu vzhledu aplikace.
4.	Testování: Důkladně testujte API endpointy pomocí nástrojů jako Postman nebo CURL.

Klientská Strana (index.php)
Na klientské straně je soubor index.php hlavním rozhraním pro uživatele, kde mohou vkládat a zobrazovat data. Klíčové body v klientské části zahrnují:

Formuláře pro zadávání dat: V index.php jsou implementovány HTML formuláře, které umožňují uživatelům zadávat data.

Použití AJAX (script.js): Pro odesílání formulářových dat bez nutnosti obnovy stránky je využíván JavaScript, konkrétně soubor script.js. Tento soubor obsahuje logiku pro asynchronní komunikaci s serverem pomocí AJAX požadavků.

Serverová Strana (api.php a CsvDatabase.php)
Na serverové straně jsou klíčové dva soubory pro manipulaci s daty:

api.php: Tento soubor obsahuje veškerou logiku pro zpracování API požadavků. Definuje endpointy pro přidávání, aktualizaci, mazání a získávání dat z databáze CSV. API poskytuje rozhraní mezi klientskou stranou a manipulací s daty.

CsvDatabase.php: Třída CsvDatabase.php poskytuje přístup k databázi uložené ve formátu CSV. Obsahuje metody pro načítání dat z data.csv, ukládání nových záznamů, mazání záznamů a aktualizaci existujících dat v CSV souboru.

Struktura databáze (data.csv)
Databáze je uložena ve formátu CSV v souboru data.csv. Struktura tohoto souboru je následující:

Sloupce:
DateTime: Datum a čas meteorologických dat ve formátu YYYY-MM-DDTHH
(např. 2024-01-01T00:00).
High temperature: Nejvyšší naměřená teplota v daný den (např. 20.0).
Low temperature: Nejnižší naměřená teplota v daný den (např. -5.0).
Normal high temperature: Normální nejvyšší teplota pro daný den (např. 18.0).
Normal low temperature: Normální nejnižší teplota pro daný den (např. 5.0).
Každý řádek v souboru data.csv představuje jeden záznam o meteorologických datech.

Styly (styles.css)
Soubor styles.css definuje vizuální podobu aplikace, včetně barev, velikostí písma, rozložení prvků a dalších vizuálních aspektů. Zde můžete upravovat vzhled všech prvků na stránce podle designových požadavků a uživatelských preferencí.

Testování
Testování přímo v prohlížeči pomocí localhost URL
1. Zobrazení všech dat (API endpoint pro načítání dat)
Otevřete webový prohlížeč a zadejte URL vašeho localhost a cesty k vašemu API endpointu. Například:
http://localhost/weather_API_2/api.php
Stiskněte Enter pro odeslání požadavku.
Prohlížeč zobrazí odpověď od serveru, která by měla obsahovat všechny data ve formátu JSON.
2. Zobrazení smazaných dat (API endpoint pro načítání smazaných dat)
Pro zobrazení smazaných dat opět zadávejte do adresního řádku:
http://localhost/weather_API_2/deleted.php
Stejně jako v předchozím případě nahraďte jméno složky skutečným názvem adresáře, v tomto případě weather_API_2.
Stiskněte Enter pro odeslání požadavku.
Prohlížeč zobrazí odpověď od serveru obsahující smazaná data ve formátu JSON.






