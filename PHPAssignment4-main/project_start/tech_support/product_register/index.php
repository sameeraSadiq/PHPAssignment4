<?php
session_start();
require('../model/database.php');
include '../view/header.php';

$error_message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    
    $query = "SELECT * FROM customers WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();

    if ($customer) {
        
        $_SESSION['customerID'] = $customer['customerID'];
        $_SESSION['name'] = $customer['firstName'] . ' ' . $customer['lastName'];
        header("Location: register_product.php"); 
        exit;
    } else {
        $error_message = "Invalid email address. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
</head>
<body>
    <h1>SportsPro Technical Support</h1>
    <h2>Customer Login</h2>
    
    <?php if (!empty($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="index.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>

<?php include '../view/footer.php'; ?>