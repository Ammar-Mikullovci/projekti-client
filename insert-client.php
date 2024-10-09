<?php
// Inkludo skedarin e lidhjes
include 'db.php';

// Kontrollo nëse forma është dërguar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Marrim të dhënat nga formulari
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];

    // Përgatitja e query-t për të shtuar të dhënat
    $sql = "INSERT INTO lisst (Name, Surname, Phone, Email, Adres) VALUES (:name, :surname, :phone, :email, :adres)";
    $stmt = $pdo->prepare($sql);

    // Ekzekuto query-n
    $stmt->execute([
        ':name' => $name,
        ':surname' => $surname,
        ':phone' => $phone,
        ':email' => $email,
        ':adres' => $adres
    ]);

    // Ridrejto në index.php pas futjes së suksesshme
    header("Location: index.php");
    exit();
}
?>