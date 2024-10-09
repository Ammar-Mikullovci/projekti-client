<?php
include 'db.php'; // Përdor emrin e skedarit të lidhjes

// Kontrollo nëse është dhënë ID
$id = $_GET['id'] ?? '';
if (!$id) {
    die('ID e klientit nuk është dhënë.');
}

// Merr të dhënat e klientit nga baza e të dhënave
$stmt = $pdo->prepare("SELECT * FROM lisst WHERE id = ?");
$stmt->execute([$id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
    die('Klienti nuk u gjet.');
}

// Kontrollo nëse është dërguar forma për përditësim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $adres = $_POST['adres'] ?? '';

    // Përditëso të dhënat në bazën e të dhënave
    $stmt = $pdo->prepare("UPDATE lisst SET Name = ?, Surname = ?, Phone = ?, Email = ?, Adres = ? WHERE id = ?");
    $stmt->execute([$name, $surname, $phone, $email, $adres, $id]);

    

    // Redirekto në faqen e listës pas përditësimit
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Sigurohu që forma të jetë e qendrës dhe e rregulluar */
        .form-container {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Client</h2>
    <div class="form-container">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($client['Name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Surname</label>
                <input type="text" id="surname" name="surname" class="form-control" value="<?php echo htmlspecialchars($client['Surname']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($client['Phone']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($client['Email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="adres" class="form-label">Address</label>
                <input type="text" id="adres" name="adres" class="form-control" value="<?php echo htmlspecialchars($client['Adres']); ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary mb-3">Update</button>
                <a href="index.php" class="btn btn-secondary mb-3">Back to list</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
