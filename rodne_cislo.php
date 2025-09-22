<?php
// Funkcia na výpočet pohlavia
function zistiPohlavie($rodne_cislo) {
    $pohlavieCislo = (int)substr($rodne_cislo, 8, 1); // Tretí znak je číslo pohlavia
    return ($pohlavieCislo % 2 == 0) ? "Žena" : "Muž";
}

// Funkcia na výpočet veku
function vypocitajVek($rodne_cislo) {
    $rok = (int)substr($rodne_cislo, 0, 2); // Prvé dve číslice rodného čísla (rok)
    $mesic = (int)substr($rodne_cislo, 2, 2); // Nasledujúce dve číslice (mesiac)
    $den = (int)substr($rodne_cislo, 4, 2); // Ďalšie dve číslice (deň)

    $aktualnyDatum = new DateTime();
    $datumNarodenia = new DateTime(sprintf("20%02d-%02d-%02d", $rok, $mesic, $den));

    $interval = $aktualnyDatum->diff($datumNarodenia);
    return $interval->y; // Vráti počet rokov
}

// Skontrolujeme, či bol formulár odoslaný
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rodne_cislo = $_POST['rodne_cislo'];

    // Overenie, že rodné číslo má správny formát
    if (preg_match('/^\d{10}$/', $rodne_cislo )) {
        $pohlavie = zistiPohlavie($rodne_cislo);
        $vek = vypocitajVek($rodne_cislo);

        echo "<p>Pohlavie: $pohlavie</p>";
        echo "<p>Vek: $vek rokov</p>";
    } else {
        echo "<p style='color:red;'>Rodné číslo nie je platné. Zadajte 10-miestne číslo.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodné číslo - PHP skript</title>
</head>
<body>
<h1>Zadajte rodné číslo</h1>
<form method="POST">
    <label for="rodne_cislo">Rodné číslo:</label>
    <input type="text" id="rodne_cislo" name="rodne_cislo" pattern="\d{10}" required>
    <button type="submit">Odoslať</button>
</form>
</body>
</html>
