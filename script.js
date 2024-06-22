    
// JavaScript kód pro manipulaci s daty pomocí AJAX

// Po odeslání formuláře se provede vložení nových dat
document.getElementById('insertForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Zabrání přesměrování po odeslání formuláře

    // Získání dat z formuláře
    const formData = new FormData(this);
    insertData(formData); // Volání funkce pro vložení nových dat
});

// Funkce pro vložení nových dat pomocí API
function insertData(formData) {
    fetch('api.php', {
        method: 'POST',
        body: formData // Odeslání formulářových dat metodou POST
    })
    .then(response => response.json()) // Zpracování odpovědi jako JSON
    .then(data => {
        console.log('Nová data byla úspěšně vložena:', data);
        location.reload(); // Aktualizace stránky po vložení nových dat
    })
    .catch(error => console.error('Chyba při vkládání dat:', error)); // Zachycení a logování chyby
}

// Po odeslání formuláře se provede výběr dat k aktualizaci
document.getElementById('selectForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Zabrání přesměrování po odeslání formuláře

    // Získání indexu vybraného záznamu pro aktualizaci
    const selectIndex = document.getElementById('select_index').value;
    selectData(selectIndex); // Volání funkce pro výběr dat k aktualizaci
});

// Funkce pro výběr dat k aktualizaci
function selectData(index) {
    fetch(`api.php?index=${index}`) // Získání dat konkrétního záznamu pomocí indexu
    .then(response => response.json()) // Zpracování odpovědi jako JSON
    .then(data => {
        // Naplnění formuláře údaji získanými z API
        document.getElementById('updateForm').style.display = 'block'; // Zobrazení formuláře pro aktualizaci
        document.getElementById('update_index').value = index; // Nastavení skrytého pole s indexem
        document.getElementById('update_date').value = data.date; // Nastavení pole pro datum
        document.getElementById('update_high_temp').value = data.high_temp; // Nastavení pole pro nejvyšší teplotu
        document.getElementById('update_low_temp').value = data.low_temp; // Nastavení pole pro nejnižší teplotu
        document.getElementById('update_normal_high_temp').value = data.normal_high_temp; // Nastavení pole pro průměrnou nejvyšší teplotu
        document.getElementById('update_normal_low_temp').value = data.normal_low_temp; // Nastavení pole pro průměrnou nejnižší teplotu
    })
    .catch(error => console.error('Chyba při výběru dat:', error)); // Zachycení a logování chyby
}

// Po odeslání formuláře se provede aktualizace dat
document.getElementById('updateForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Zabrání přesměrování po odeslání formuláře

    // Získání dat z formuláře
    const formData = new FormData(this);
    updateData(formData); // Volání funkce pro aktualizaci dat
});

// Funkce pro aktualizaci dat pomocí API
function updateData(formData) {
    fetch('api.php', {
        method: 'POST',
        body: formData // Odeslání formulářových dat metodou POST
    })
    .then(response => response.json()) // Zpracování odpovědi jako JSON
    .then(data => {
        console.log('Data byla úspěšně aktualizována:', data);
        location.reload(); // Aktualizace stránky po aktualizaci dat
    })
    .catch(error => console.error('Chyba při aktualizaci dat:', error)); // Zachycení a logování chyby
}