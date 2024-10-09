<?php
include 'db.php'; // Përdor emrin e skedarit të lidhjes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Merr të dhënat nga formulari
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['adres'] ?? '';

    // Kontrollo nëse të dhënat janë plotësuar
    if (!$name || !$surname || !$phone || !$email || !$address) {
        echo '<script>alert("Please fill out all fields."); window.history.back();</script>';
        exit;
    }

    // Kontrollo nëse klienti ekziston
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM lisst WHERE Name = ? AND Surname = ? AND Phone = ? AND Email = ? AND Adres = ?");
    $stmt->execute([$name, $surname, $phone, $email, $address]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        echo '<script>alert("Client already exists."); window.history.back();</script>';
        exit;
    }

    // Shto klientin në bazën e të dhënave
    $stmt = $pdo->prepare("INSERT INTO lisst (Name, Surname, Phone, Email, Adres) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $surname, $phone, $email, $address]);

    // Redirekto në faqen e listës
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function validateForm(event) {
            var name = document.querySelector('input[name="name"]').value;
            var surname = document.querySelector('input[name="surname"]').value;
            var phone = document.querySelector('input[name="phone"]').value;
            var email = document.querySelector('input[name="email"]').value;
            var address = document.querySelector('input[name="adres"]').value;

            if (!name || !surname || !phone || !email || !address) {
                alert('Please fill out all fields.');
                event.preventDefault(); // Stop form submission
            }
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">New Client</h2>
            <form class="d-flex flex-column align-items-center" method="post" action="new-client.php" onsubmit="validateForm(event)">
                <div class="mb-3 w-100">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name">
                </div>
                <div class="mb-3 w-100">
                    <input type="text" name="surname" class="form-control mb-2" placeholder="Surname">
                </div>
                <div class="mb-3 w-100">
                    <input type="number" name="phone" class="form-control mb-2" placeholder="Phone">
                </div>
                <div class="mb-3 w-100">
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                </div>
                <div class="mb-3 w-100">
                    <input type="text" name="adres" class="form-control mb-2" placeholder="Address">
                </div>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col text-start">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <div class="col text-end">
                            <a href="index.php" class="btn btn-secondary">Back to list</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
