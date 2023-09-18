<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $age = $_POST["age"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];

    if (empty($name) || $age <= 0 || $height <= 0 || $weight <= 0) {
        die("Invalid input data.");
    }

   
    $targetDir = "uploads/";
    $reportFileName = basename($_FILES["report"]["name"]);
    $targetFilePath = $targetDir . $reportFileName;

    if (move_uploaded_file($_FILES["report"]["tmp_name"], $targetFilePath)) {
        
        $conn = new mysqli("localhost", "root", "", "Mreport");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $sql = "INSERT INTO user_info (name, age, height_cm, weight_kg, report_filename) VALUES ('$name', $age, $height, $weight, '$reportFileName')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error uploading file.";
    }
}
?>
