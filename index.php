<?php
$servername = "monorail.proxy.rlwy.net";
$dBUsername = "root";
$dBPassword = "qCIPRJQAIBRnMBkayOjXJPjoGdJopFcq";
$dBName = "railway";
$port = 39399;

// Crear la conexión usando mysqli
$conn = new mysqli($servername, $dBUsername, $dBPassword, $dBName, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_status_1'])) {
        // Actualizar el estado del LED en la base de datos a 1
        $update_sql = "UPDATE LED_STATE SET status = 1 WHERE id = 1";
        if ($conn->query($update_sql) === TRUE) {
            echo "Status updated to 1 successfully<br>";
        } else {
            echo "Error updating status: " . $conn->error . "<br>";
        }
    } elseif (isset($_POST['update_status_0'])) {
        // Actualizar el estado del LED en la base de datos a 0
        $update_sql = "UPDATE LED_STATE SET status = 0 WHERE id = 1";
        if ($conn->query($update_sql) === TRUE) {
            echo "Status updated to 0 successfully<br>";
        } else {
            echo "Error updating status: " . $conn->error . "<br>";
        }
    }
}

// SQL para seleccionar datos de la tabla LED_STATE
$sql = "SELECT * FROM LED_STATE";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - status: " . $row["status"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Control LED</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
  <form method="post" action="">
    <input type="submit" name="update_status_1" value="Update Status to 1">
    <input type="submit" name="update_status_0" value="Update Status to 0">
    <br><br>
    <a href="http://elunecorp.000.pe/esp32_update.php" target="_blank">Go to esp32_update.php</a>
  </form>
</body>
</html>
