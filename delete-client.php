<?php
include 'db.php'; // Përdor emrin e skedarit të lidhjes

// Kontrollo nëse është dhënë ID
$id = $_GET['id'] ?? '';
if (!$id) {
    die('ID e klientit nuk është dhënë.');
}

// Fshi klientin nga baza e të dhënave
$stmt = $pdo->prepare("DELETE FROM lisst WHERE id = ?");
$stmt->execute([$id]);

// Redirekto në faqen e listës pas fshirjes
header('Location: index.php');
exit;
?>
