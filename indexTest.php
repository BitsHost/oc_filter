<?php

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function subtract($a, $b)
    {
        return $a - $b;
    }

    public function multiply($a, $b)
    {
        return $a * $b;
    }

    public function divide($a, $b)
    {
        if ($b == 0) {
            throw new Exception("Division by zero.");
        }
        return $a / $b;
    }
}

$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = isset($_POST['a']) ? (float)$_POST['a'] : 0;
    $b = isset($_POST['b']) ? (float)$_POST['b'] : 0;
    $operation = $_POST['operation'] ?? 'add';

    $calc = new Calculator();

    try {
        switch ($operation) {
            case 'add':
                $result = $calc->add($a, $b);
                break;
            case 'subtract':
                $result = $calc->subtract($a, $b);
                break;
            case 'multiply':
                $result = $calc->multiply($a, $b);
                break;
            case 'divide':
                $result = $calc->divide($a, $b);
                break;
        }
    } catch (Exception $e) {
        $result = $e->getMessage();
    }
}
?>

<form method="post">
    <input type="number" step="any" name="a" required placeholder="First number" value="<?= htmlspecialchars($_POST['a'] ?? '') ?>">
    <select name="operation">
        <option value="add" <?= (($_POST['operation'] ?? '') === 'add') ? 'selected' : '' ?>>+</option>
        <option value="subtract" <?= (($_POST['operation'] ?? '') === 'subtract') ? 'selected' : '' ?>>-</option>
        <option value="multiply" <?= (($_POST['operation'] ?? '') === 'multiply') ? 'selected' : '' ?>>*</option>
        <option value="divide" <?= (($_POST['operation'] ?? '') === 'divide') ? 'selected' : '' ?>>/</option>
    </select>
    <input type="number" step="any" name="b" required placeholder="Second number" value="<?= htmlspecialchars($_POST['b'] ?? '') ?>">
    <button type="submit">Calculate</button>
</form>

<?php if ($result !== ''): ?>
    <p>Result: <?= htmlspecialchars($result) ?></p>
<?php endif; ?>