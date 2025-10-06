<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculator with DB</title>
</head>
<body>

<h2>Simple Calculator (with DB Save)</h2>

<form method="post" action="">
    <input type="number" name="num1" step="any" required placeholder="Enter first number"> <br><br>

    <input type="number" name="num2" step="any" required placeholder="Enter second number"> <br><br>

    <select name="operation">
        <option value="add">Add (+)</option>
        <option value="subtract">Subtract (-)</option>
        <option value="multiply">Multiply (×)</option>
        <option value="divide">Divide (÷)</option>
    </select> <br><br>

    <input type="submit" name="calculate" value="Calculate">
</form>

<?php
if (isset($_POST['calculate'])) {
    // Get form values
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];
    $result = null;

    // Perform calculation
    switch ($operation) {
        case "add":
            $result = $num1 + $num2;
            break;
        case "subtract":
            $result = $num1 - $num2;
            break;
        case "multiply":
            $result = $num1 * $num2;
            break;
        case "divide":
            if ($num2 == 0) {
                echo "<h3 style='color:red;'>Cannot divide by zero!</h3>";
                $result = null;
            } else {
                $result = $num1 / $num2;
            }
            break;
        default:
            echo "<h3>Invalid operation.</h3>";
    }

    // Show result
    if ($result !== null) {
        echo "<h3>Result: $result</h3>";

        // Connect to database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "calculator_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Save to DB
        $stmt = $conn->prepare("INSERT INTO calculations (num1, num2, operation, result) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ddsd", $num1, $num2, $operation, $result);

        if ($stmt->execute()) {
            echo "<p>Calculation saved to database!</p>";
        } else {
            echo "<p style='color:red;'>Failed to save calculation: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

</body>
</html>
