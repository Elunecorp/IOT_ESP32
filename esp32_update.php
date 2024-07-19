<?php
$servername = "monorail.proxy.rlwy.net";
$dBUsername = "root";
$dBPassword = "qCIPRJQAIBRnMBkayOjXJPjoGdJopFcq";
$dBName = "railway";
$port = 39399;

$conn = new mysqli($servername, $dBUsername, $dBPassword, $dBName, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['check_LED_status'])) {
    $led_id = $_POST['check_LED_status'];
    $sql = "SELECT status, status2, status3 FROM LED_STATE WHERE id = '$led_id';";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching data: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    if ($row) {
        echo $row['status'] . ',' . $row['status2'] . ',' . $row['status3']; // Return the statuses separated by commas
    }
    mysqli_free_result($result);
}

mysqli_close($conn);
?>
