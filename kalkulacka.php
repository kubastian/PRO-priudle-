<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Calculator</title>
</head>
<body>

<h2>Simple Calculator</h2>

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
    $result = "";

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
                $result = "Cannot divide by zero!";
            } else {
                $result = $num1 / $num2;
            }
            break;
        default:
            $result = "Invalid operation selected.";
    }

    echo "<h3>Result: $result</h3>";
}
?>

</body>
</html>

