<?php
$servername = "monorail.proxy.rlwy.net";
$dBUsername = "root";
$dBPassword = "qCIPRJQAIBRnMBkayOjXJPjoGdJopFcq";
$dBName = "railway"; // Cambiado a 'railway'
$port = 39399;

// Crear la conexión usando mysqli
$conn = new mysqli($servername, $dBUsername, $dBPassword, $dBName, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// HASTA AQUI TODO BIEN, CONECTA EL PROGRAMA



// Inicializar la variable para almacenar el estado del LED
$led_status = null;

// Leer el estado del LED desde la base de datos
if (isset($_POST['check_LED_status'])) {   //El nombre es elegido al azar nomas  con ese nombre sacaremos la info de la base de datos 
    // = $_POST['check_LED_status'];  
    $sql = "SELECT status FROM LED_STATE WHERE id = '1';";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error fetching data: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    if ($row) {
        $led_status = $row['status']; // Obtener el valor crudo de status
    } else {
        $led_status = "No data found"; //Si no puede leer el valor de $led_status imprime NO DATA FOUND 
    }
}
/*
// Actualizar el estado del LED en la base de datos
if (isset($_POST['toggle_LED'])) {
    $led_id = $_POST['toggle_LED'];  
    $sql = "SELECT * FROM LED_STATE WHERE id = 1;";   //Filtrar las filas que cumplan con cierto criterio. En este caso, se especifica que se deben seleccionar las filas donde el valor del campo id sea igual al valor de la variable $led_id.
    $result = $conn->query($sql);

    if (!$result) {
        die("Error fetching data: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    if ($row) {
        $new_status = ($row['status'] == 0) ? 1 : 0; // Cambiar el estado
        $update = $conn->query("UPDATE LED_STATE SET status = '$new_status' WHERE id = '$led_id';");

        if (!$update) {
            die("Error updating data: " . $conn->error);
        }

        $led_status = $new_status; // Asignar el nuevo valor de status
    } else {
        $led_status = "No data found";
    }
}
*/
// Cerrar la conexión
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
    <input type="submit" name="check_LED_status" value="Check LED Status">
    <input type="submit" name="toggle_LED" value="Toggle LED Status">
    <br><br>
    <p>Current LED Status: <?php echo htmlspecialchars($led_status); ?></p> <!-- Mostrar el valor crudo de status -->
    <a href="index.php">Go back to index.php</a> <!-- Enlace para regresar a index.php -->
  </form>
</body>
</html>
