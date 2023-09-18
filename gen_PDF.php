<?php
require_once('tcpdf/tcpdf.php');

if (isset($_GET["name"])) {
    $name = $_GET["name"];

    $conn = new mysqli("localhost", "root", "", "Mreport");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user_info WHERE name = '$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 10, 'User Information', 0, 1, 'C');
        $pdf->Cell(0, 10, '', 0, 1); 

        $pdf->Cell(0, 10, 'Name: ' . $row["name"], 0, 1);
        $pdf->Cell(0, 10, 'Age: ' . $row["age"], 0, 1);
        $pdf->Cell(0, 10, 'Height (cm): ' . $row["height_cm"], 0, 1);
        $pdf->Cell(0, 10, 'Weight (kg): ' . $row["weight_kg"], 0, 1);

        $pdf->Output('user_info.pdf', 'D');
    } else {
        echo "User not found.";
    }

    $conn->close();
}
?>
