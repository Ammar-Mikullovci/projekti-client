<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5" >
    <h1 class="text-center mb-4 ml-50">Client List</h1>
   <div class="d-flex justify-content-center"> <a href="new-client.php" class="btn btn-success mb-3 ">Add New Client</a></div>

    <?php
    include 'db.php'; 

    $stmt = $pdo->query("SELECT * FROM lisst");

    if ($stmt->rowCount() > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>Name</th><th>Surname</th><th>Phone</th><th>Email</th><th>Address</th><th>Actions</th></tr></thead>';
        echo '<tbody>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = htmlspecialchars($row['id'] ?? '');
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Surname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Phone']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Adres']) . '</td>';
            echo '<td>';
            echo '<a href="edit-client.php?id=' . $id . '" class="btn btn-primary btn-sm">Edit</a> ';
            echo '<a href="delete-client.php?id=' . $id . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this client?\');">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p class="text-center">No records found.</p>';
    }
    ?>

</div>

</body>
</html>
