<?php
include('db_conn.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$query = "
SELECT c.id AS cart_id, aw.name, aw.prize, c.quantity, aw.prize * c.quantity AS total_price 
FROM cart c 
JOIN alloy_wheels aw ON c.product_id = aw.id 
WHERE c.user_id = $user_id";
$result = mysqli_query($dbc, $query);

// Handle cart quantity update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_id'], $_POST['quantity'])) {
    $cart_id = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);
    if ($quantity > 0) {
        $update_query = "UPDATE cart SET quantity = $quantity WHERE id = $cart_id AND user_id = $user_id";
        mysqli_query($dbc, $update_query);
        header('Location: cart.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Alloy Wheel Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="images/logo.jpg" alt="Alloy Wheel Logo">
        <h1>Alloy Wheel</h1>
    </div>
    <nav>
        <a href="home.php">HOME</a>
        <a href="products.php">PRODUCTS</a>
        <a href="cart.php">CART</a>
        <a href="checkout.php">CHECKOUT</a>
    </nav>
</header>
<main class="cart-main">
    <h2>Your Cart</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>$<?php echo number_format($row['prize'], 2); ?></td>
                        <td>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="checkout.php" class="cta-button">Proceed to Checkout</a>
    <?php else: ?>
        <p>Your cart is empty. <a href="products.php">Shop now</a>.</p>
    <?php endif; ?>
</main>
<footer class="footer">
    <p>© 2024 AlloyWheels.com All Rights Reserved</p>
</footer>
</body>
</html>
