<?php
session_start();
require('../model/database.php');
include '../view/header.php';


if (!isset($_SESSION['customerID'])) {
    header("Location: index.php");
    exit;
}


$query = "SELECT * FROM products";
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Product</title>
</head>
<body>
    <h1>SportsPro Technical Support</h1>
    <h2>Register Product</h2>
    <p>Customer: <?php echo $_SESSION['name']; ?></p>

    <form action="register.php" method="post">
        <label for="productCode">Product:</label>
        <select name="productCode" id="productCode">
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['productCode']; ?>">
                    <?php echo $product['name'] . ' (Version ' . $product['version'] . ')'; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Register Product</button>
    </form>
</body>
</html>

<?php include '../view/footer.php'; ?>