<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Medical Form</title>
</head>
<body>
    <form action="process.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="age">Age:</label>
        <input type="number" name="age" required><br>

        <label for="height">Height (cm):</label>
        <input type="number" name="height" required><br>

        <label for="weight">Weight (kg):</label>
        <input type="number" name="weight" required><br>

        <label for="report">Upload Medical Report (PDF/Image):</label>
        <input type="file" name="report"><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
