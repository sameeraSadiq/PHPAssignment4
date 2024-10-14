<?php
session_start();
require('../model/database.php');
include '../view/header.php';


if (!isset($_SESSION['customerID'])) {
    header("Location: index.php");
    exit;
}

$customerID = $_SESSION['customerID'];
$productCode = $_POST['productCode'];


$query = "INSERT INTO registrations (customerID, productCode, registrationDate) VALUES (:customerID, :productCode, NOW())";
$statement = $db->prepare($query);
$statement->bindValue(':customerID', $customerID);
$statement->bindValue(':productCode', $productCode);

if ($statement->execute()) {
    echo "Product ($productCode) was registered successfully.";
} else {
    echo "Failed to register the product.";
}
?>

<?php include '../view/footer.php'; ?>