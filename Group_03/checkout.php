<?php
// Include database connection
include('db_conn.php');

// Initialize variables for error and success messages
$error = '';
$success = '';

// Check if the user is logged in (you can adjust this based on your session management)
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Process the checkout form if it is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from form
    $full_name = trim($_POST['full_name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $postal_code = trim($_POST['postal_code']);
    $phone_number = trim($_POST['phone_number']);
    $payment_method = $_POST['payment_method'];

    // Validate inputs
    if (empty($full_name) || empty($address) || empty($city) || empty($postal_code) || empty($phone_number) || empty($payment_method)) {
        $error = "All fields are required.";
    } else {
        // Sanitize input to prevent SQL injection
        $full_name = mysqli_real_escape_string($dbc, $full_name);
        $address = mysqli_real_escape_string($dbc, $address);
        $city = mysqli_real_escape_string($dbc, $city);
        $postal_code = mysqli_real_escape_string($dbc, $postal_code);
        $phone_number = mysqli_real_escape_string($dbc, $phone_number);

        // Get user ID from session (assuming the user is logged in)
        $user_id = $_SESSION['user_id'];

        // Example: Insert order into database (you would normally create an orders table)
        $query = "INSERT INTO orders (user_id, full_name, address, city, postal_code, phone_number, payment_method) 
                  VALUES ('$user_id', '$full_name', '$address', '$city', '$postal_code', '$phone_number', '$payment_method')";

        if (mysqli_query($dbc, $query)) {
            $success = "Your order has been placed successfully!";
        } else {
            $error = "Error placing order. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Alloy Wheel Products</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header Section -->
  <header class="header">
    <div class="logo">
      <img src="images/logo.jpg" alt="Alloy Wheel Logo">
      <h1>Alloy Wheel</h1>
    </div>
    <nav>
      <a href="index.php">HOME</a>
      <a href="login.php">LOGIN/SIGNUP</a>
      <a href="cart.php">CART</a>
    </nav>
  </header>

  <!-- Checkout Form Section -->
  <main class="checkout-main">
    <h2>Checkout</h2>

    <?php if ($error): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
      <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form action="checkout.php" method="POST">
      <label for="full_name">Full Name</label>
      <input type="text" name="full_name" id="full_name" required>

      <label for="address">Address</label>
      <input type="text" name="address" id="address" required>

      <label for="city">City</label>
      <input type="text" name="city" id="city" required>

      <label for="postal_code">Postal Code</label>
      <input type="text" name="postal_code" id="postal_code" required>

      <label for="phone_number">Phone Number</label>
      <input type="text" name="phone_number" id="phone_number" required>

      <label for="payment_method">Payment Method</label>
      <select name="payment_method" id="payment_method" required>
        <option value="">Select Payment Method</option>
        <option value="Credit Card">Credit Card</option>
        <option value="PayPal">PayPal</option>
        <option value="Bank Transfer">Bank Transfer</option>
      </select>

      <button type="submit">Place Order</button>
    </form>
  </main>

  <!-- Footer Section -->
  <footer class="footer">
    <p>© 2024 AlloyWheels.com All Rights Reserved</p>
  </footer>

</body>
</html>
